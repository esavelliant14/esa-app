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

class DnsController extends Controller
{

    // public function dnsMon(){
    //     if (!Gate::allows('access-permission' , '61')) {
    //         return redirect('/main')->with('access_denied', true);
    //     }

    //     // Ambil semua row dari table dnsmon
    //     $domains = Dnsmon::all();

    //     $results = [];
    //     foreach ($domains as $domain) {
    //         $apiData = null;

    //         if ($domain->vendor === 'RESELLER_CAMP') {
    //             // API RESELLER_CAMP
    //             $url = "https://api.liqu.id/v1/domains/{$domain->id_domain}?fields=all";
    //             $response = Http::withBasicAuth(
    //                 env('RESELLER_CAMP_USER'),
    //                 env('RESELLER_CAMP_KEY')
    //             )->get($url);

    //             if ($response->successful()) {
    //                 $api = $response->json();
    //                 $apiData = [
    //                     'domain_name' => $api['domain_name'] ?? null,
    //                     'expiry_date' => $api['expiry_date'] ?? null,
    //                     'order_status' => $api['order_status'] ?? null,
    //                     'suspended' => $api['suspended'] ?? null,

    //                 ];
    //             } else {
    //                 $apiData = ['error' => $response->body()];
    //             }

    //         } elseif ($domain->vendor === 'RESELLER_CLUB') {
    //             // API RESELLER_CLUB
    //             $url = "https://test.httpapi.com/api/domains/details-by-name.json";
    //             $response = Http::get($url, [
    //                 'auth-userid' => env('RESELLER_CLUB_USERID'),
    //                 'api-key' => env('RESELLER_CLUB_KEY'),
    //                 'domain-name' => $domain->domain, // asumsinya kolom id = domain-name untuk club
    //                 'options' => 'All'
    //             ]);

    //             if ($response->successful()) {
    //                 $api = $response->json();
    //                 $expiryTimestamp = $api['endtime'] ?? null;
    //                 $apiData = [
    //                     'domain_name' => $domain->domain,
    //                     'expiry_date' => $expiryTimestamp ? date('Y-m-d H:i:s', $expiryTimestamp) : null,
    //                     'order_status' => $api['currentstatus'] ?? null,
    //                     'suspended' => $api['paused'] ?? null,
    //                 ];
    //             } else {
    //                 $apiData = ['error' => $response->body()];
    //             }

    //         } else {
    //             $apiData = ['error' => "Vendor {$domain->vendor} tidak dikenali."];
    //         }

    //         $results[] = [
    //             'api'   => $apiData,
    //         ];
    //     }
    //     dd($results);
    //     // return view('index-dnsmon-lists', [
    //     //     'title_url' => 'DNS MONITORING',
    //     //     'active' => 'list-dns',
    //     //     'title_menu' => 'DNS',
    //     //     'title_submenu' => 'DNS MONITORING',
    //     //     'domains' => $results // kita kirim data ke view
    //     // ]);
    // }
    public function dnsMon()
    {
        if (!Gate::allows('access-permission' , '61')) {
            return redirect('/main')->with('access_denied', true);
        }

        // ambil semua domain
        $domains = Dnsmon::where('id_group', auth()->user()->id_group)->get();;

        $results = [];
        foreach ($domains as $domain) {

            // bikin key cache unik per vendor+id_domain/domain
            $cacheKey = 'dnsmon_'.$domain->vendor.'_'.$domain->id;

            $apiData = Cache::remember($cacheKey, now()->addMinutes(1), function () use ($domain) {
                // isi function ini persis seperti API call kamu sekarang
                if ($domain->vendor === 'RESELLER_CAMP') {
                    $url = "https://api.liqu.id/v1/domains/{$domain->id_domain}?fields=all";
                    $response = Http::withBasicAuth(
                        env('RESELLER_CAMP_USER'),
                        env('RESELLER_CAMP_KEY')
                    )->get($url);

                    if ($response->successful()) {
                        $api = $response->json();
                        return [
                            'domain_name' => $api['domain_name'] ?? null,
                            'expiry_date' => $api['expiry_date'] ?? null,
                            'order_status' => $api['order_status'] ?? null,
                            'suspended' => isset($api['suspended']) ? ($api['suspended'] ? 'true' : 'false') : null,
                            'vendor' => 'RESELLER_CAMP',
                        ];
                    }

                    return ['error' => $response->body()];
                }

                if ($domain->vendor === 'RESELLER_CLUB') {
                    $url = "https://test.httpapi.com/api/domains/details-by-name.json";
                    $response = Http::get($url, [
                        'auth-userid' => env('RESELLER_CLUB_USERID'),
                        'api-key' => env('RESELLER_CLUB_KEY'),
                        'domain-name' => $domain->name_domain,
                        'options' => 'All'
                    ]);

                    if ($response->successful()) {
                        $api = $response->json();
                        $expiryTimestamp = $api['endtime'] ?? null;
                        return [
                            'domain_name' => $domain->name_domain,
                            'expiry_date' => $expiryTimestamp ? date('Y-m-d H:i:s', $expiryTimestamp) : null,
                            'order_status' => $api['currentstatus'] ?? null,
                            'suspended' => $api['paused'] ?? null,
                            'vendor' => 'RESELLER_CLUB'
                        ];
                    }

                    return ['error' => $response->body()];
                }

                return ['error' => "Vendor {$domain->vendor} tidak dikenali."];
            });

            $expiryDate = $apiData['expiry_date'] ?? null;
            $isExpiring = false;
            if ($expiryDate) {
                $timestamp = strtotime($expiryDate);
                $threeMonthsLater = strtotime('+3 months');
                $aMonthLater = strtotime('+1 month');

                if ($timestamp <= $aMonthLater) {
                    $isExpiring = "1bulan";
                }
                elseif ($timestamp <= $threeMonthsLater){
                    $isExpiring = "3bulan";
                }
                
            }

            $results[] = [
                'api' => $apiData,
                'is_expiring' => $isExpiring,
            ];
        }

        usort($results, function ($a, $b) {
            $dateA = isset($a['api']['expiry_date']) ? strtotime($a['api']['expiry_date']) : PHP_INT_MAX;
            $dateB = isset($b['api']['expiry_date']) ? strtotime($b['api']['expiry_date']) : PHP_INT_MAX;
            return $dateA <=> $dateB;
        });
        // dd($results); 
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
        ],[
            'txt_vendor.required' => 'Vendor name is required',
            'txt_domain_id.required_if' => 'Domain ID is required for vendor Reseller Camp',
            'txt_domain_id.integer' => 'Domain ID must a valid integer',
            'txt_domain_name.required_if' => 'Domain Name is Required for vendor Reseller Club',
            'txt_id_group.required' => 'sometimes required',
            'txt_id_user.required' => 'somesimtes required',
        ]);


        if ( $post_add_dnsmon->txt_vendor == 'RESELLER_CAMP' ){
            $var_data->after(function($var_data) use ($post_add_dnsmon) {
                $vendor = $post_add_dnsmon->txt_vendor;
                $domain_id = $post_add_dnsmon->txt_domain_id;
                $domain_name = $post_add_dnsmon->txt_domain_name;

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
                $name_group = Group::where('id', $var_data_valid['txt_id_group'])->pluck('name_group');
                    Dnsmon::create([
                        'id_domain' => $var_data_valid['txt_domain_id'],
                        'vendor' => $var_data_valid['txt_vendor'],
                        'id_group' => $var_data_valid['txt_id_group'],
                        'id_user' => $var_data_valid['txt_id_user'],
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
            }

        }else if ($post_add_dnsmon->txt_vendor == 'RESELLER_CLUB') {
            $var_data->after(function($var_data) use ($post_add_dnsmon) {
                $vendor = $post_add_dnsmon->txt_vendor;
                $domain_id = $post_add_dnsmon->txt_domain_id;
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
                $name_group = Group::where('id', $var_data_valid['txt_id_group'])->pluck('name_group');
        
                Dnsmon::create([
                    'name_domain' => $var_data_valid['txt_domain_name'],
                    'vendor' => $var_data_valid['txt_vendor'],
                    'id_group' => $var_data_valid['txt_id_group'],
                    'id_user' => $var_data_valid['txt_id_user'],
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

            }
        }

            
            return redirect(route('dnsmon.lists'))->with('success', 'Add new domain successfully');
        
    }
}
