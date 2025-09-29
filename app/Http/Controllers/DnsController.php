<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Dnsmon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Logging;
use App\Models\Group;
use GuzzleHttp\Promise;

class DnsController extends Controller
{

public function dnsMon()
{
    if (!Gate::allows('access-permission', '61')) {
        return redirect('/main')->with('access_denied', true);
    }

    $domains = Dnsmon::with('group', 'user')
        ->where('id_group', auth()->user()->id_group)
        ->get();

   $results = [];

foreach ($domains->chunk(30) as $chunk) {
    $promises = [];

    // buat request async tapi jangan di cache dulu
    foreach ($chunk as $domain) {
        if ($domain->vendor === 'RESELLER_CAMP') {
            $promises[$domain->id] = Http::withBasicAuth(env('RESELLER_CAMP_USER'), env('RESELLER_CAMP_KEY'))
                ->async()
                ->get("https://api.liqu.id/v1/domains/{$domain->id_domain}?fields=all");
        } elseif ($domain->vendor === 'RESELLER_CLUB') {
            $promises[$domain->id] = Http::async()->get("https://test.httpapi.com/api/domains/details-by-name.json", [
                'auth-userid' => env('RESELLER_CLUB_USERID'),
                'api-key' => env('RESELLER_CLUB_KEY'),
                'domain-name' => $domain->name_domain,
                'options' => 'All'
            ]);
        }
    }

    $responses = \GuzzleHttp\Promise\Utils::settle($promises)->wait();

    foreach ($chunk as $domain) {
        $res = $responses[$domain->id] ?? null;

        $apiData = Cache::remember('dnsmon_'.$domain->vendor.'_'.$domain->id, now()->addMinutes(10), function() use ($res, $domain) {
            $data = ['vendor' => $domain->vendor, 'owner_type' => $domain->owner_type ?? null];

            if ($res && $res['state'] === 'fulfilled') {
                $response = $res['value'];
                $api = $response->json();

                if ($domain->vendor === 'RESELLER_CAMP') {
                    $data = [
                        'domain_name' => $api['domain_name'] ?? null,
                        'expiry_date' => $api['expiry_date'] ?? null,
                        'order_status' => $api['order_status'] ?? null,
                        'suspended' => isset($api['suspended']) ? ($api['suspended'] ? 'true' : 'false') : null,
                        'owner_type' => $domain->owner_type ?? null,
                        'vendor' => 'RESELLER_CAMP',
                    ];
                } elseif ($domain->vendor === 'RESELLER_CLUB') {
                    $expiryTimestamp = $api['endtime'] ?? null;
                    $data = [
                        'domain_name' => $domain->name_domain,
                        'expiry_date' => $expiryTimestamp ? date('Y-m-d H:i:s', $expiryTimestamp) : null,
                        'order_status' => $api['currentstatus'] ?? null,
                        'suspended' => $api['paused'] ?? null,
                        'owner_type' => $domain->owner_type ?? null,
                        'vendor' => 'RESELLER_CLUB'
                    ];
                }
            } elseif ($res && $res['state'] === 'rejected') {
                $data['error'] = $res['reason'];
            }

            return $data;
        });

        // cek expiring
        $expiryDate = $apiData['expiry_date'] ?? null;
        $isExpiring = false;
        if ($expiryDate) {
            $timestamp = strtotime($expiryDate);
            $threeMonthsLater = strtotime('+3 months');
            $aMonthLater = strtotime('+1 month');

            if ($timestamp <= $aMonthLater) {
                $isExpiring = "1bulan";
            } elseif ($timestamp <= $threeMonthsLater) {
                $isExpiring = "3bulan";
            }
        }

        $results[] = [
            'api' => $apiData,
            'is_expiring' => $isExpiring,
        ];
    }
}


    // urutkan berdasarkan expiry_date
    usort($results, function ($a, $b) {
        $dateA = isset($a['api']['expiry_date']) ? strtotime($a['api']['expiry_date']) : PHP_INT_MAX;
        $dateB = isset($b['api']['expiry_date']) ? strtotime($b['api']['expiry_date']) : PHP_INT_MAX;
        return $dateA <=> $dateB;
    });

    return view('index-dnsmon-lists', [
        'title_url' => 'DNS MONITORING',
        'active' => 'list-dns',
        'title_menu' => 'DNS',
        'title_submenu' => 'DNS MONITORING',
        'var_show' => $results
    ]);
}


    public function dnsMonAdd(Request $post_add_dnsmon){
        
        $var_data = Validator::make($post_add_dnsmon->all(), [
            'txt_vendor' => 'required',
            'txt_domain_id' => 'required_if:txt_vendor,RESELLER_CAMP|integer',
            'txt_domain_name' => 'required_if:txt_vendor,RESELLER_CLUB',
            'txt_id_group' => 'required',
            'txt_id_user' => 'required',
            'txt_owner_type' => 'required',
        ],[
            'txt_vendor.required' => 'Vendor name is required',
            'txt_domain_id.required_if' => 'Domain ID is required for vendor Reseller Camp',
            'txt_domain_id.integer' => 'Domain ID must a valid integer',
            'txt_domain_name.required_if' => 'Domain Name is Required for vendor Reseller Club',
            'txt_id_group.required' => 'sometimes required',
            'txt_id_user.required' => 'somesimtes required',
            'txt_owner_type.required' => 'Owner Type is required'
        ]);


        if ( $post_add_dnsmon->txt_vendor == 'RESELLER_CAMP' ){
            $var_data->after(function($var_data) use ($post_add_dnsmon) {
                $vendor = $post_add_dnsmon->txt_vendor;
                $domain_id = $post_add_dnsmon->txt_domain_id;

                $existDomainId = DB::table('table_dns_mon')
                    ->where('vendor', $vendor)
                    ->where('id_domain', $domain_id)
                    ->exists();
                if($existDomainId) {
                    $var_data->errors()->add('txt_vendor', 'Data already exist');
                }
            });
            if( $var_data->fails() ){
                return redirect(route('dnsmon.lists'))
                ->withErrors($var_data)
                ->withInput();
            }else{
                $var_data_valid = $var_data->validated();
                $response = Http::withBasicAuth(env('RESELLER_CAMP_USER'), env('RESELLER_CAMP_KEY'))
                        ->get("https://api.liqu.id/v1/domains/{$var_data_valid['txt_domain_id']}?fields=all");
                if ($response->successful()) {
                    $name_group = Group::where('id', $var_data_valid['txt_id_group'])->pluck('name_group');
                    Dnsmon::create([
                        'id_domain' => $var_data_valid['txt_domain_id'],
                        'vendor' => $var_data_valid['txt_vendor'],
                        'id_group' => $var_data_valid['txt_id_group'],
                        'id_user' => $var_data_valid['txt_id_user'],
                        'owner_type' => $var_data_valid['txt_owner_type'],
                    ]);
                    Logging::create([
                        'action_by' => auth()->user()->email,
                        'category_action' => 'Add DNS Monitoring',
                        'status' => 'Success',
                        'ip_address' => request()->ip(),
                        'agent' => request()->header('User-Agent'),
                        'details' => 'Success add new domain_id=' . $var_data_valid['txt_domain_id'] .  ' , on vendor='. $var_data_valid['txt_vendor'] . ' Group=' . $name_group,
                        'id_group' => auth()->user()->id_group,
                    ]); 
                    return redirect(route('dnsmon.lists'))->with('success', 'Add new domain successfully');
                } else {
                    return redirect(route('dnsmon.lists'))->with('failed', 'Data not found on Reseller Camp');
                }
            }
        }else if ($post_add_dnsmon->txt_vendor == 'RESELLER_CLUB') {
            $var_data->after(function($var_data) use ($post_add_dnsmon) {
                $vendor = $post_add_dnsmon->txt_vendor;
                $domain_name = $post_add_dnsmon->txt_domain_name;

                $existDomainName = DB::table('table_dns_mon')
                    ->where('vendor', $vendor)
                    ->where('name_domain', $domain_name)
                    ->exists();

                if($existDomainName) {
                    $var_data->errors()->add('txt_vendor', 'Data already exist');
                }
            });
            if( $var_data->fails() ){
                return redirect(route('dnsmon.lists'))
                ->withErrors($var_data)
                ->withInput();
            }else{
                $var_data_valid = $var_data->validated();
                $response = Http::get("https://test.httpapi.com/api/domains/details-by-name.json", [
                    'auth-userid' => env('RESELLER_CLUB_USERID'),
                    'api-key' => env('RESELLER_CLUB_KEY'),
                    'domain-name' => $var_data_valid['txt_domain_name'],
                    'options' => 'All'
                ]);
                if ($response->successful()) {
                    $name_group = Group::where('id', $var_data_valid['txt_id_group'])->pluck('name_group');
                    Dnsmon::create([
                        'name_domain' => $var_data_valid['txt_domain_name'],
                        'vendor' => $var_data_valid['txt_vendor'],
                        'id_group' => $var_data_valid['txt_id_group'],
                        'id_user' => $var_data_valid['txt_id_user'],
                        'owner_type' => $var_data_valid['txt_owner_type'],
                    ]);
                    Logging::create([
                        'action_by' => auth()->user()->email,
                        'category_action' => 'Add DNS Monitoring',
                        'status' => 'Success',
                        'ip_address' => request()->ip(),
                        'agent' => request()->header('User-Agent'),
                        'details' => 'Success add new domain_name=' . $var_data_valid['txt_domain_name'] .  ' , on vendor='. $var_data_valid['txt_vendor'] . ' Group=' . $name_group,
                        'id_group' => auth()->user()->id_group,
                    ]); 
                    return redirect(route('dnsmon.lists'))->with('success', 'Add new domain successfully');
                }else{
                    return redirect(route('dnsmon.lists'))->with('failed', 'Data not found on Reseller Club');
                }
            }
        }  
        
    }
}
