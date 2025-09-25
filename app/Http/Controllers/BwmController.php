<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBwmRequest;
use App\Http\Requests\UpdateBwmRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Bwmrtr;
use App\Models\User;
use App\Models\Group;
use App\Models\Privilege;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Logging;
use App\Models\Bwmclient;
use App\Models\Bwm;
use App\Models\Bwmbod;
use Illuminate\Support\Facades\Http;

class BwmController extends Controller
{

    public function rtr(){
        if (!Gate::allows('access-permission' , '63')) {
            return redirect('/main')->with('access_denied', true);
        }

        $show_group = Group::where('id' , auth()->user()->id_group)->get();
        $show_rtr = Bwmrtr::where('id_group', auth()->user()->id_group)->get();
        
        return view('index-bwm-rtr',[
            'title_url' => 'LIST BWM ROUTER',
            'active' => 'rtr-lists',
            'title_menu' => 'BWM',
            'title_submenu' => 'LIST Routers',
            'var_show' => $show_rtr,
            'var_show_group' => $show_group,
        ]);
    }

    public function getclient(Request $get_rtr)
    {
        $response = Http::post('http://127.0.0.1:8000/get-client', [
            'hostname' => $get_rtr['txt_hostname'],
            'ip_address' => $get_rtr['txt_ip_address'],
            'interface' => $get_rtr['txt_interface'],
            'logical_system' => $get_rtr['txt_logical_system'],
            'id_group' => $get_rtr['txt_id_group'],
            'id_user' => $get_rtr['txt_id_user'],
        ]);

        if($response->successful())
        {
            $data = $response->json();
            return redirect(route('bwmrtr.lists'))->with($data['status'], $data['message']);
        }else{
            $data = $response->json();
            return redirect(route('bwmrtr.lists'))->with($data['status'], $data['message']);
        }
        
    }


    public function addrtr(Request $post_create_bwmrtr){
        
        $var_data = Validator::make($post_create_bwmrtr->all(), [
            'txt_hostname' => 'required',
            'txt_ip_address' => 'required|ip',
            'txt_interface' => 'required',
            'txt_id_group' => 'required',
            'txt_id_user' => 'required',
            'txt_brand' => 'required',
            'txt_logical_system' => 'required',
            'txt_regional' => 'required',
        ],[
            'txt_hostname.required' => 'Router hostname is required',
            'txt_ip_address.required' => 'IP Address is required',
            'txt_ip_address.ip' => 'Wrong format IP Address',
            'txt_interface.required' => 'Interface is required',
            'txt_brand.required' => 'Brand name is required',
            'txt_logical_system.required' => 'Logical System parameter is Required',
            'txt_regional.required' => 'Regional parameter is required'
        ]);

        $var_data->after(function($var_data) use ($post_create_bwmrtr) {
            $hostname = $post_create_bwmrtr->txt_hostname;
            $ip_address = $post_create_bwmrtr->txt_ip_address;
            $interface = $post_create_bwmrtr->txt_interface;
            $id_group = $post_create_bwmrtr->txt_id_group;
            $brand = $post_create_bwmrtr->txt_brand;
            $logical_system = $post_create_bwmrtr->txt_logical_system;

            $existAll = DB::table('table_bwm_rtr')
                ->where('hostname', $hostname)
                ->where('ip_address', $ip_address)
                ->where('interface', $interface)
                ->where('id_group', $id_group)
                ->where('brand', $brand)
                ->exists();
            if($existAll) {
                $var_data->errors()->add('txt_hostname', 'Data already exist');
            }

            $existHost = DB::table('table_bwm_rtr')
                ->where('hostname', $hostname)
                ->where('ip_address', '!=' ,$ip_address)
                ->where('id_group', $id_group)
                ->exists();

            if($existHost) {
                $var_data->errors()->add('txt_hostname', 'A hostname is only allowed to have 1 IP Address');
            }

            $existIp = DB::table('table_bwm_rtr')
                ->where('ip_address', $ip_address)
                ->where('hostname', '!=', $hostname)
                ->where('id_group', $id_group)
                ->exists();
            if($existIp){
                $var_data->errors()->add('txt_ip_address', 'IP Address already used by another hostname');
            }

            $existInt = DB::table('table_bwm_rtr')
                ->where('hostname', $hostname)
                ->where('interface', $interface)
                ->where('id_group',$id_group)
                ->exists();
            if($existInt){
                $var_data->errors()->add('txt_interface', 'Interface already used for this hostname');
            }
        });

        if( $var_data->fails() ){
            return redirect(route('bwmrtr.lists'))
            ->withErrors($var_data)
            ->withInput();
        }else{
            $var_data_valid = $var_data->validated();
            $name_group = Group::where('id', $var_data_valid['txt_id_group'])->pluck('name_group');
            Bwmrtr::create([
                'hostname' => $var_data_valid['txt_hostname'],
                'ip_address' => $var_data_valid['txt_ip_address'],
                'interface' => $var_data_valid['txt_interface'],
                'brand' => $var_data_valid['txt_brand'],
                'regional' => $var_data_valid['txt_regional'],
                'logical_system' => $var_data_valid['txt_logical_system'],
                'id_group' => $var_data_valid['txt_id_group'],
                'id_user' => $var_data_valid['txt_id_user'],
                
            ]);
            Logging::create([
                'action_by' => auth()->user()->email,
                'category_action' => 'Add BWM Router',
                'status' => 'Success',
                'ip_address' => request()->ip(),
                'agent' => request()->header('User-Agent'),
                'details' => 'Success add new pop=' . $var_data_valid['txt_hostname'] . ' , IP Address=' . $var_data_valid['txt_ip_address'] . ' , interface='. $var_data_valid['txt_interface'] . ' brand=' . $var_data_valid['txt_brand'] . ' Group=' . $name_group,
                'id_group' => auth()->user()->id_group,

            ]); 
            return redirect(route('bwmrtr.lists'))->with('success', 'Create BWM Router Successfully');
        };
    }

    public function deletertr($id) {
        $router = Bwmrtr::findOrFail($id);
        $hostname = $router->hostname;
        $interface = $router->interface;
        $ip_address = $router->ip_address;
        $id_group = $router->id_group;
        $brand = $router->brand;
        $name_group = $router->group->name_group;
        $check_client = Bwmclient::where('hostname' , $hostname)->where('id_group', $id_group)->where('interface', $interface)->count();
        $check_bw = Bwm::where('hostname', $hostname)->where('id_group', $id_group)->count();
        if($check_client == "0" && $check_bw == "0"){
            Bwmrtr::destroy('id' , $id);      
            Logging::create([
                'action_by' => auth()->user()->email,
                'category_action' => 'Delete BWM Router',
                'status' => 'Success',
                'ip_address' => request()->ip(),
                'agent' => request()->header('User-Agent'),
                'details' => 'Success delete router=' . $hostname . ' ,IP Address=' . $ip_address . ' ,interface=' . $interface . ' brand=' . $brand . ' Group=' . $name_group,
                'id_group' => auth()->user()->id_group,
            ]);
            return redirect(route('bwmrtr.lists'))->with('success', 'Delete BWM Router Successfully');
        }else {
            Logging::create([
                'action_by' => auth()->user()->email,
                'category_action' => 'Delete BWM Router',
                'status' => 'Failed',
                'ip_address' => request()->ip(),
                'agent' => request()->header('User-Agent'),
                'details' => 'Failed delete router=' . $hostname . ' ,IP Address=' . $ip_address . ' ,interface=' . $interface . ' brand=' . $brand . ' Group=' . $name_group .' because still used by BWM or Client',
                'id_group' => auth()->user()->id_group,
            ]);
            return redirect(route('bwmrtr.lists'))->with('failed', 'BWM Router still used by BWM/Client');
        }
    
        
    }
    public function comboHostname($groupId, Request $request)
    {
        if (!$request->ajax()) {
            return redirect('/main');
        }
        $hostnamertr = Bwmrtr::where('id_group', $groupId)->pluck('hostname', 'id'); 
        return response()->json($hostnamertr);
    }

    public function comboInterface($hostname, Request $request)
    {
        if (!$request->ajax()) {
            return redirect('/main');
        }
        $groupid = auth()->user()->id_group;
        $hostnamertr = Bwmrtr::where('hostname', $hostname)->where('id_group', $groupid)->pluck('interface'); 
        return response()->json($hostnamertr);
    }

    public function bw(){
        if (!Gate::allows('access-permission' , '63')) {
            return redirect('/main')->with('access_denied', true);
        }

        $show_group = Group::where('id' , auth()->user()->id_group)->get();
        $show_bw = Bwm::where('id_group', auth()->user()->id_group)->get();

        return view('index-bwm-bw',[
            'title_url' => 'LIST BWM',
            'active' => 'bw-lists',
            'title_menu' => 'BWM',
            'title_submenu' => 'LIST Bandwidth',
            'var_show' => $show_bw,
            'var_show_group' => $show_group,
        ]);
    }

    public function getpolicer(Request $get_rtr)
    {
        $response = Http::post('http://127.0.0.1:8000/get-policer', [
            'hostname' => $get_rtr['txt_hostname'],
            'ip_address' => $get_rtr['txt_ip_address'],
            'interface' => $get_rtr['txt_interface'],
            'logical_system' => $get_rtr['txt_logical_system'],
            'id_group' => $get_rtr['txt_id_group'],
            'id_user' => $get_rtr['txt_id_user'],
        ]);

        if($response->successful())
        {
            $data = $response->json();
            return redirect(route('bwmrtr.lists'))->with($data['status'], $data['message']);
        }else{
            $data = $response->json();
            return redirect(route('bwmrtr.lists'))->with($data['status'], $data['message']);
        }
        
    }

    public function addbw(Request $post_create_bwmbw){
        $var_data = Validator::make($post_create_bwmbw->all(), [
            'txt_hostname' => 'required',
            'txt_policer_name' => 'required',
            'txt_bandwidth' => 'required|integer',
            'txt_bandwidth_unit' => 'required',
            'txt_burst_limit' => 'required|integer',
            'txt_burst_limit_unit' => 'required',
            'txt_id_group' => 'required',
            'txt_id_user' => 'required',
        ],[
            'txt_hostname.required' => 'Router hostname is required',
            'txt_policer_name' => 'Policer name is required',
            'txt_bandwidth.required' => 'Bandwidth is required',
            'txt_bandwidth.integer' => 'Bandwidth value must be an integer',
            'txt_bandwidth_unit.required' => 'Bandwidth unit is required',
            'txt_burst_limit.required' => 'Burst limit is required',
            'txt_burst_limit.integer' => 'Burst limit value must be an integer',
            'txt_burst_limit_unit.required' => 'Burst limit unit is required',
        ]);

        $var_data->after(function($var_data) use ($post_create_bwmbw) {
            $hostname = $post_create_bwmbw->txt_hostname;
            $policer_name = $post_create_bwmbw->txt_policer_name;
            $id_group = $post_create_bwmbw->txt_id_group;

            $existAll = DB::table('table_bwm_bw')
                ->where('hostname', $hostname)
                ->where('policer_name', $policer_name)
                ->where('id_group', $id_group)
                ->exists();
            if($existAll) {
                $var_data->errors()->add('txt_policer_name', 'Data already exist');
            }

        });

        if( $var_data->fails() ){
            return redirect(route('bwmbw.lists'))
            ->withErrors($var_data)
            ->withInput();
        }else{
            $var_data_valid = $var_data->validated();
            $result_bandwidth = ($var_data_valid['txt_bandwidth'] . $var_data_valid['txt_bandwidth_unit']);
            $result_burst = ($var_data_valid['txt_burst_limit'] . $var_data_valid['txt_burst_limit_unit']);
            $response = Http::post('http://127.0.0.1:8000/receive-bw', [
                'hostname' => $var_data_valid['txt_hostname'],
                'policer_name' => $var_data_valid['txt_policer_name'],
                'limit_bandwidth' => $result_bandwidth,
                'limit_burst' => $result_burst,
                'id_group' => $var_data_valid['txt_id_group'],
                'id_user' => $var_data_valid['txt_id_user'],
            ]);
            if($response->successful()){
                $data = $response->json();
                Bwm::create([
                'hostname' => $data['hostname'],
                'policer_name' => $data['policer_name'],
                'bandwidth' => $data['limit_bandwidth'],
                'burst_limit' => $data['limit_burst'],
                'policer_status' => 'Active',
                'id_group' => $data['id_group'],
                'id_user' => $data['id_user'],
                
                ]);
                Logging::create([
                    'action_by' => auth()->user()->email,
                    'category_action' => 'Add BWM Bandwidth',
                    'status' => 'Success',
                    'ip_address' => request()->ip(),
                    'agent' => request()->header('User-Agent'),
                    'details' => 'Success add new bandwidth at pop=' . $data['hostname'] . ' , Policer Name=' . $data['policer_name'] . ' , bandwidth='. $data['limit_bandwidth'],
                    'id_group' => auth()->user()->id_group,
                ]); 
                return redirect(route('bwmbw.lists'))->with($data['status'], $data['message']);

            }else{
                $data = $response->json();
                Logging::create([
                    'action_by' => auth()->user()->email,
                    'category_action' => 'Add BWM Bandwidth',
                    'status' => 'Failed',
                    'ip_address' => request()->ip(),
                    'agent' => request()->header('User-Agent'),
                    'details' => 'Failed add new bandwidth at pop=' . $data['hostname']. ' because ' . $data['message'],
                    'id_group' => auth()->user()->id_group,
                ]); 
                return redirect(route('bwmbw.lists'))->with($data['status'], $data['message']);
            }



            
        };
    }

    // public function deletebw($id){
    //     $bw = Bwm::findOrFail($id);
    //     $hostname = $bw->hostname;
    //     $policer_name = $bw->policer_name;
    //     $id_group = $bw->id_group;
    //     $name_group = $bw->group->name_group;
    //     $check_client = Bwmclient::where('hostname' , $hostname)->where('id_group', $id_group)
    //                     ->where('input_policer', $policer_name)
    //                     ->where('output_policer', $policer_name)
    //                     ->count();
    //     if($check_client == 0) {
    //         Bwm::destroy('id' , $id);      
    //         Logging::create([
    //             'action_by' => auth()->user()->email,
    //             'category_action' => 'Delete BWM Bandwidth',
    //             'status' => 'Success',
    //             'ip_address' => request()->ip(),
    //             'agent' => request()->header('User-Agent'),
    //             'details' => 'Success delete Bandwidth=' . $policer_name . ' ,hostname=' . $hostname . ' ,group=' . $name_group ,
    //             'id_group' => auth()->user()->id_group,
    //         ]);
    //         return redirect(route('bwmbw.lists'))->with('success', 'Delete BWM Bandwidth Successfully');
    //     }else{
    //         Logging::create([
    //             'action_by' => auth()->user()->email,
    //             'category_action' => 'Delete BWM Bandwidth',
    //             'status' => 'Failed',
    //             'ip_address' => request()->ip(),
    //             'agent' => request()->header('User-Agent'),
    //             'details' => 'Failed delete Bandwidth=' . $policer_name . ' ,Hostname=' . $hostname .  ' Group=' . $name_group .' because still used by Client',
    //             'id_group' => auth()->user()->id_group,
    //         ]);
    //         return redirect(route('bwmbw.lists'))->with('failed', 'BWM Bandwidth still used by Client');
    //     }
    // }
    
    public function client(){
        if (!Gate::allows('access-permission' , '63')) {
            return redirect('/main')->with('access_denied', true);
        }

        $show_group = Group::where('id' , auth()->user()->id_group)->get();
        $show_client = Bwmclient::where('id_group', auth()->user()->id_group)->get();

        return view('index-bwm-client',[
            'title_url' => 'LIST BWM CLIENT',
            'active' => 'client-lists',
            'title_menu' => 'BWM',
            'title_submenu' => 'LIST Clients',
            'var_show' => $show_client,
            'var_show_group' => $show_group,
        ]);
    } 

    public function addclient(Request $post_create_bwmclient){
        $var_data = Validator::make($post_create_bwmclient->all(), [
            'txt_hostname' => 'required',
            'txt_interface' => 'required',
            'txt_unit_interface' => 'required|integer',
            'txt_id_group' => 'required',
            'txt_id_user' => 'required',
        ],[
            'txt_hostname.required' => 'Router hostname is required',
            'txt_interface.required' => 'Interface is required',
            'txt_unit_interface.required' => 'Unit interface is required',
            'txt_unit_interface.integer' => 'Unit interface value must be an integer',
        ]);
        $var_data->after(function($var_data) use ($post_create_bwmclient) {
            $hostname = $post_create_bwmclient->txt_hostname;
            $interface = $post_create_bwmclient->txt_interface;
            $unit = $post_create_bwmclient->txt_unit_interface;
            

            $existAll = DB::table('table_bwm_client')
                ->where('hostname', $hostname)
                ->where('interface', $interface)
                ->where('unit_interface', $unit)
                ->exists();
            if($existAll) {
                $var_data->errors()->add('txt_unit_interface', 'Data already exist');
            }
        });
        if( $var_data->fails() ){
            return redirect(route('bwmclient.lists'))
            ->withErrors($var_data)
            ->withInput();
        }else{
            $var_data_valid = $var_data->validated();
            
            $response = Http::post('http://127.0.0.1:8000/receive-client', [
                'hostname' => $var_data_valid['txt_hostname'],
                'interface' => $var_data_valid['txt_interface'],
                'unit' => $var_data_valid['txt_unit_interface']
            ]);

            if($response->successful()){
                $data = $response->json();
                Bwmclient::create([
                    'hostname' => $data['hostname'],
                    'interface' => $data['interface'],
                    'unit_interface' => $data['unit'],
                    'status_unit' => $data['status_unit'],
                    'description' => $data['description'],
                    'ip_address' => $data['ip'],
                    'vlan_id' => $data['vlan_id'],
                    'policer_status' => $data['status_policer'],
                    'input_policer' => $data['input_policer'],
                    'input_policer_status' => $data['status_input_policer'],
                    'output_policer' => $data['output_policer'],
                    'output_policer_status' => $data['status_output_policer'],
                    'id_group' => $var_data_valid['txt_id_group'],
                    'id_user' => $var_data_valid['txt_id_user'],

                ]);
                Logging::create([
                    'action_by' => auth()->user()->email,
                    'category_action' => 'Add BWM Client',
                    'status' => 'Success',
                    'ip_address' => request()->ip(),
                    'agent' => request()->header('User-Agent'),
                    'details' => 'Success add new client at pop=' . $var_data_valid['txt_hostname'] . ' , Interface=' . $var_data_valid['txt_interface'] . ' , unit='. $var_data_valid['txt_unit_interface'] ,
                    'id_group' => auth()->user()->id_group,
                ]); 
                return redirect(route('bwmclient.lists'))->with($data['status'], $data['message']);
            }else{
                $data = $response->json();
                Logging::create([
                    'action_by' => auth()->user()->email,
                    'category_action' => 'Add BWM Client',
                    'status' => 'Failed',
                    'ip_address' => request()->ip(),
                    'agent' => request()->header('User-Agent'),
                    'details' => 'Failed add new client at pop=' . $var_data_valid['txt_hostname'] . ' , Interface=' . $var_data_valid['txt_interface'] . ' , unit='. $var_data_valid['txt_unit_interface'] ,
                    'id_group' => auth()->user()->id_group,
                ]); 
                return redirect(route('bwmclient.lists'))->with($data['status'], $data['message']);
            }
        };

    }

    public function refreshclient($id)
    {
        $getclient = BwmClient::findOrFail($id);
        
        $response = Http::post('http://127.0.0.1:8000/refresh-client',[
            'hostname' => $getclient->hostname,
            'interface' => $getclient->interface,
            'description' => $getclient->description,
            'unit' => $getclient->unit_interface,
            'input_policer' => $getclient->input_policer,
            'output_policer' => $getclient->output_policer,
        ]);
        if($response->successful()){
            $data = $response->json();
            return redirect(route('bwmclient.lists'))->with($data['status'], $data['message']);
        }else{
            $data = $response->json();
            return redirect(route('bwmclient.lists'))->with($data['status'], $data['message']);
        }
    }

    public function getHostnames(Request $request)
    {
        if (!$request->ajax()) {
            return redirect('/main');
        }
        $idgroup = auth()->user()->id_group;
        $routers = Bwmrtr::select('hostname','id_group')
            ->where('id_group', $idgroup)->distinct()->get();

        return response()->json($routers);
    }

    public function getInterfaces($hostname, $groupId, Request $request)
    {
        if (!$request->ajax()) {
            return redirect('/main');
        }
        $interfaces = Bwmrtr::where('hostname', $hostname)
            ->where('id_group', $groupId)
            ->pluck('interface');

        return response()->json($interfaces);
    }

    public function searchPolicer($id_group, $hostname, Request $request)
    {
        // Ambil data policer berdasarkan group dan hostname dari tabel kalian
        // Misal tabelnya bernama 'policers'
        if (!$request->ajax()) {
            return redirect('/main');
        }
        $policers = DB::table('table_bwm_bw')
            ->where('id_group', $id_group)
            ->where('hostname', $hostname)
            ->where('policer_status', 'Active')
            ->pluck('policer_name'); 
            // pluck akan ambil kolom 'policer_name' jadi array

        // Kembalikan dalam bentuk JSON
        return response()->json($policers);
    }
    public function bod()
    {
        if (!Gate::allows('access-permission' , '63')) {
            return redirect('/main')->with('access_denied', true);
        }

        $show_group = Group::where('id' , auth()->user()->id_group)->get();
        $show_bod = Bwmbod::orderBy('created_at', 'desc')->where('id_group', auth()->user()->id_group)->get();

        return view('index-bod-lists',[
            'title_url' => 'LIST BOD',
            'active' => 'list-bod',
            'title_menu' => 'BWM',
            'title_submenu' => 'LIST BOD',
            'var_show' => $show_bod,
            'var_show_group' => $show_group,
        ]);
    }

    public function addbod(Request $post_create_bwmbod)
    {
        // dd($post_create_bwmbod->all());
        $maxDate = now()->addMonths(2)->toDateTimeString();
        $var_data = Validator::make($post_create_bwmbod->all(), [
                'txt_hostname' => 'required',
                'txt_description' => 'required',
                'txt_interface' => 'required',
                'txt_unit_interface' => 'required|integer',
                'txt_input_policer' => 'required',
                'txt_output_policer' => 'required',
                'txt_input_policer_bod' => 'required',
                'txt_output_policer_bod' => 'required',
                'txt_date' => 'required|after_or_equal:now|date|before_or_equal:' . $maxDate,
                'txt_id_group' => 'required',
                'txt_id_user' => 'required',
            ],[
                'txt_hostname.required' => 'Router hostname is required',
                'txt_interface.required' => 'Interface is required',
                'txt_unit_inteface.required' => 'Unit interface is required',
                'txt_unit_inteface.integer' => 'Unit interface value must be an integer',
                'txt_input_policer.required' => 'Old input policer is required',
                'txt_output_policer.required' => 'Old output policer is required',
                'txt_input_policer_bod.required' => 'New input policer is required',
                'txt_output_policer_bod.required' => 'New output policer is required',
                'txt_date.required' => 'Date is required',
                'txt_date.date' => 'Date wrong format',
                'txt_date.after_or_equal' => 'Date start from now',
                'txt_date.before_or_equal' => 'Date cannot exceed 2 months from now',
            ]);
        if( $var_data->fails() ){
            return redirect(route('bwmclient.lists'))
            ->withErrors($var_data, 'BwmBodForm')
            ->withInput();
        }else{
            $var_data_valid = $var_data->validated();
            // dd($var_data_valid);
            $newDate = \Carbon\Carbon::parse($var_data_valid['txt_date'])->format('Y-m-d H:i:s');
            $response = Http::post('http://127.0.0.1:8000/receive-bod', [
                'hostname' => $var_data_valid['txt_hostname'],
                'interface' => $var_data_valid['txt_interface'],
                'description' => $var_data_valid['txt_description'],
                'unit' => $var_data_valid['txt_unit_interface'],
                'old_input_policer' => $var_data_valid['txt_input_policer'],
                'old_output_policer' => $var_data_valid['txt_output_policer'],
                'bod_input_policer' => $var_data_valid['txt_input_policer_bod'],
                'bod_output_policer' => $var_data_valid['txt_output_policer_bod'],
                'date' => $newDate,
                'id_group' => $var_data_valid['txt_id_group'],
                'id_user' => $var_data_valid['txt_id_user'],
            ]);
            if($response->successful()){
                $data = $response->json();
                Bwmbod::create([
                    'hostname' => $data['hostname'],
                    'description' => $data['description'],
                    'interface' => $data['interface'],
                    'unit_interface' => $data['unit'],
                    'old_input_policer' => $data['old_input_policer'],
                    'old_output_policer' => $data['old_output_policer'],
                    'bod_input_policer' => $data['bod_input_policer'],
                    'bod_output_policer' => $data['bod_output_policer'],
                    'bod_until' => $data['date'],
                    'status' => 'Active',
                    'id_group' => $data['id_group'],
                    'id_user' => $data['id_user'],
                ]);
                Logging::create([
                    'action_by' => auth()->user()->email,
                    'category_action' => 'Add BOD Client',
                    'status' => 'Success',
                    'ip_address' => request()->ip(),
                    'agent' => request()->header('User-Agent'),
                    'details' => 'Success create BOD for client '. $data['description'] .' at POP=' . $data['hostname'] . ' , from existing Bandwidth(up/down)=' . $data['old_input_policer']. '/'. $data['old_output_policer'] . ' , to bandwidth(up/down)='. $data['bod_input_policer']. '/'. $data['bod_output_policer'],
                    'id_group' => $data['id_group'],
                ]); 
                return redirect(route('bwmbod.lists'))->with($data['status'], $data['message']);
            }else{
                $data = $response->json();
                Logging::create([
                    'action_by' => auth()->user()->email,
                    'category_action' => 'Add BOD Client',
                    'status' => 'Failed',
                    'ip_address' => request()->ip(),
                    'agent' => request()->header('User-Agent'),
                    'details' => 'Failed create BOD for client' . $data['description']. 'because ' . $data['message'],
                    'id_group' => $data['id_group'],
                ]); 
                return redirect(route('bwmclient.lists'))->with($data['status'], $data['message']);
            }
        }
    }




    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(StoreBwmRequest $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     */
    // public function show(Bwm $bwm)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Bwm $bwm)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    // public function update(UpdateBwmRequest $request, Bwm $bwm)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Bwm $bwm)
    // {
    //     //
    // }
}
