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

class BwmController extends Controller
{

    public function rtr(){
        if ( auth()->user()->id_group == 1 ){
            $show_group = Group::all();
            $show_rtr = Bwmrtr::all();
        } else {
            $show_group = Group::where('id' , auth()->user()->id_group)->get();
            $show_rtr = Bwmrtr::where('id_group', auth()->user()->id_group)->get();
        }
        return view('index-bwm-rtr',[
            'title_url' => 'LIST BWM ROUTER',
            'active' => 'rtr-lists',
            'title_menu' => 'BWM',
            'title_submenu' => 'LIST Routers',
            'var_show' => $show_rtr,
            'var_show_group' => $show_group,
        ]);
    }


    public function addrtr(Request $post_create_bwmrtr){
        
        $var_data = Validator::make($post_create_bwmrtr->all(), [
            'txt_hostname' => 'required',
            'txt_ip_address' => 'required|ip',
            'txt_interface' => 'required',
            'txt_id_group' => 'required',
            'txt_id_user' => 'required',
            'txt_brand' => 'required'
        ],[
            'txt_hostname.required' => 'Router hostname is required',
            'txt_ip_address.required' => 'IP Address is required',
            'txt_ip_address.ip' => 'Wrong format IP Address',
            'txt_interface.required' => 'Interface is required',
            'txt_brand.required' => 'Brand name is required'
        ]);

        $var_data->after(function($var_data) use ($post_create_bwmrtr) {
            $hostname = $post_create_bwmrtr->txt_hostname;
            $ip_address = $post_create_bwmrtr->txt_ip_address;
            $interface = $post_create_bwmrtr->txt_interface;
            $id_group = $post_create_bwmrtr->txt_id_group;
            $brand = $post_create_bwmrtr->txt_brand;

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
        if ( auth()->user()->id_group == 1 ){
            $show_group = Group::all();
            $show_bw = Bwm::all();
        } else {
            $show_group = Group::where('id' , auth()->user()->id_group)->get();
            $show_bw = Bwm::where('id_group', auth()->user()->id_group)->get();

        }
        return view('index-bwm-bw',[
            'title_url' => 'LIST BWM',
            'active' => 'bw-lists',
            'title_menu' => 'BWM',
            'title_submenu' => 'LIST Bandwidth',
            'var_show' => $show_bw,
            'var_show_group' => $show_group,
        ]);
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
            $interface = $post_create_bwmbw->txt_interface;
            $id_group = $post_create_bwmbw->txt_id_group;
            $brand = $post_create_bwmbw->txt_brand;

            $existAll = DB::table('table_bwm_rtr')
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
            Bwm::create([
                'hostname' => $var_data_valid['txt_hostname'],
                'policer_name' => $var_data_valid['txt_policer_name'],
                'bandwidth' => $result_bandwidth,
                'burst_limit' => $result_burst,
                'id_group' => $var_data_valid['txt_id_group'],
                'id_user' => $var_data_valid['txt_id_user'],
                
            ]);
            Logging::create([
                'action_by' => auth()->user()->email,
                'category_action' => 'Add BWM Router',
                'status' => 'Success',
                'ip_address' => request()->ip(),
                'agent' => request()->header('User-Agent'),
                'details' => 'Success add new bandwidth at pop=' . $var_data_valid['txt_hostname'] . ' , Polcer Name=' . $var_data_valid['txt_policer_name'] . ' , bandwidth='. $result_bandwidth,
                'id_group' => auth()->user()->id_group,
            ]); 
            return redirect(route('bwmbw.lists'))->with('success', 'Create BWM Bandwidth Successfully');
        };
    }

    public function deletebw($id){
        $bw = Bwm::findOrFail($id);
        $hostname = $bw->hostname;
        $policer_name = $bw->policer_name;
        $id_group = $bw->id_group;
        $name_group = $bw->group->name_group;
        $check_client = Bwmclient::where('hostname' , $hostname)->where('id_group', $id_group)
                        ->where('input_policer', $policer_name)
                        ->where('output_policer', $policer_name)
                        ->count();
        if($check_client == 0) {
            Bwm::destroy('id' , $id);      
            Logging::create([
                'action_by' => auth()->user()->email,
                'category_action' => 'Delete BWM Bandwidth',
                'status' => 'Success',
                'ip_address' => request()->ip(),
                'agent' => request()->header('User-Agent'),
                'details' => 'Success delete Bandwidth=' . $policer_name . ' ,hostname=' . $hostname . ' ,group=' . $name_group ,
                'id_group' => auth()->user()->id_group,
            ]);
            return redirect(route('bwmbw.lists'))->with('success', 'Delete BWM Bandwidth Successfully');
        }else{
            Logging::create([
                'action_by' => auth()->user()->email,
                'category_action' => 'Delete BWM Bandwidth',
                'status' => 'Failed',
                'ip_address' => request()->ip(),
                'agent' => request()->header('User-Agent'),
                'details' => 'Failed delete Bandwidth=' . $policer_name . ' ,Hostname=' . $hostname .  ' Group=' . $name_group .' because still used by Client',
                'id_group' => auth()->user()->id_group,
            ]);
            return redirect(route('bwmbw.lists'))->with('failed', 'BWM Bandwidth still used by Client');
        }

    }
    
    public function client(){
        if ( auth()->user()->id_group == 1 ){
            $show_group = Group::all();
            $show_client = Bwmclient::all();
        } else {
            $show_group = Group::where('id' , auth()->user()->id_group)->get();
            $show_client = Bwmclient::where('id_group', auth()->user()->id_group)->get();
        }
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
            'txt_interface.required' => 'Bandwidth is required',
            'txt_unit_inteface.required' => 'Unit interface is required',
            'txt_unit_inteface.integer' => 'Unit interface value must be an integer',
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
                $var_data->errors()->add('txt_hostname', 'Data already exist');
            }
        });
        if( $var_data->fails() ){
            return redirect(route('bwmclient.lists'))
            ->withErrors($var_data)
            ->withInput();
        }else{
            $var_data_valid = $var_data->validated();
            // Bwm::create([
            //     'hostname' => $var_data_valid['txt_hostname'],
            //     'policer_name' => $var_data_valid['txt_policer_name'],
            //     'id_group' => $var_data_valid['txt_id_group'],
            //     'id_user' => $var_data_valid['txt_id_user'],
                
            // ]);
            Logging::create([
                'action_by' => auth()->user()->email,
                'category_action' => 'Add BWM Client',
                'status' => 'Success',
                'ip_address' => request()->ip(),
                'agent' => request()->header('User-Agent'),
                'details' => 'Success add new bandwidth at pop=' . $var_data_valid['txt_hostname'] . ' , Interface=' . $var_data_valid['txt_interface'] . ' , unit='. $var_data_valid['txt_unit_interface'] ,
                'id_group' => auth()->user()->id_group,
            ]); 
            return redirect(route('bwmclient.lists'))->with('success', 'Create BWM Client Successfully');
        };

    }


    public function getHostnames(Request $request)
    {
        if (!$request->ajax()) {
            return redirect('/main');
        }
        $idgroup = auth()->user()->id_group;
        $routers = Bwmrtr::select('hostname','id_group')
            ->where('id_group', $idgroup)->get();

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
