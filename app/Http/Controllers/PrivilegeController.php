<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Privilege;
use App\Models\Group;
use App\Models\User;
use App\Models\PrivilegePermission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use App\Models\Logging;


class PrivilegeController extends Controller
{
    public function index(){
        
        if (!Gate::allows('access-permission' , '1')) {
            return redirect('/main');
        }
        if ( auth()->user()->id_group == 1 ){
            $show_privilege = Privilege::all();
            $show_group = Group::all();
        } else {
            $show_privilege = Privilege::where('id_group' , auth()->user()->id_group)->get();
            $show_group = Group::where('id' , auth()->user()->id_group)->get();
        }

        return view('privilege',[
            'title_url' => 'USER | ESA.NET',
            'active' => 'privilege',
            'title_menu' => 'PRIVILEGE',
            'title_submenu' => 'PRIVILEGE',
            'var_show' => $show_privilege,
            'var_show_group' => $show_group,
        ]);
    }

    public function add(Request $post_create_privilege)
    {
        //dd($post_create_privilege->all());
        $check_table_privilege = DB::table('table_privileges')
        ->where('name_privilege', $post_create_privilege->input('txt_name_privilege'))
        ->where('id_group', $post_create_privilege->input('txt_group'))
        ->count();

        if($check_table_privilege == 0 ){
            $addons_validate = "";
        }else {
            $addons_validate = "unique:table_privileges,name_privilege";
        }
        $var_data = Validator::make($post_create_privilege->all(), [
            'txt_name_privilege' => ['required',
            $addons_validate
        ],
            'txt_group' => 'required',
            
        ],[
            'txt_name_privilege.required' => 'Name Privilege is Required',
            'txt_name_privilege.unique' => 'Name Privilege already exist',
            'txt_group.required' => 'Name Group is Required'
        ]);
        
        if( $var_data->fails() ){
            return redirect('/privilege')
            ->withErrors($var_data)
            ->withInput();
        }else{
            $var_data_valid = $var_data->validated();
//            dd($var_data_valid);
            $privilege = Privilege::create([
                'name_privilege' => $var_data_valid['txt_name_privilege'],
                'id_group' => $var_data_valid['txt_group'],
            ]);
            if (!is_null($post_create_privilege->input('txt_permission'))){
                foreach ($post_create_privilege->txt_permission as $permission) {
                    PrivilegePermission::create([
                        'id_permission' => $permission ,
                        'id_privilege' => $privilege->id,
                    ]);
                }
            }
            Logging::create([
                'action_by' => auth()->user()->email,
                'category_action' => 'Add Privilege',
                'status' => 'Success',
                'ip_address' => request()->ip(),
                'agent' => request()->header('User-Agent'),
                'details' => 'Success add new privilege=' . $var_data_valid['txt_name_privilege'],

            ]); 
            return redirect('/privilege')->with('success', 'Create Privilege Successfully');
        };
    }

    public function delete($id)
    {
        $name_privilege = Privilege::where('id', $id)->pluck('name_privilege')->first();
        $check_user = User::where('id_privilege' , $id)->count();
        //dd($test);
        if($check_user == "0"){
            Privilege::destroy('id' , $id);    
            Logging::create([
                'action_by' => auth()->user()->email,
                'category_action' => 'Delete Privilege',
                'status' => 'Success',
                'ip_address' => request()->ip(),
                'agent' => request()->header('User-Agent'),
                'details' => 'Success delete privilege=' . $name_privilege,
            ]);  
            return redirect('/privilege')->with('success', 'Delete Privilege Successfully');
        }else {
            Logging::create([
                'action_by' => auth()->user()->email,
                'category_action' => 'Delete Privilege',
                'status' => 'Failed',
                'ip_address' => request()->ip(),
                'agent' => request()->header('User-Agent'),
                'details' => 'Failed delete privilege=' . $name_privilege . ' because group still used by user',
            ]);
            return redirect('/privilege')->with('failed', 'Privilege still used by user');
        }
            
    }

    public function update(Request $post_edit_privilege)
    {
        PrivilegePermission::where('id_privilege', $post_edit_privilege->txt_id)->delete(); 
        foreach ($post_edit_privilege->txt_permission as $permission) {
            PrivilegePermission::create([
                'id_permission' => $permission ,
                'id_privilege' => $post_edit_privilege->txt_id,
            ]);
        }
        Logging::create([
            'action_by' => auth()->user()->email,
            'category_action' => 'Update Privilege',
            'status' => 'Success',
            'ip_address' => request()->ip(),
            'agent' => request()->header('User-Agent'),
            'details' => 'Success update privilege=' . $post_edit_privilege->txt_name_privilege,
        ]);
        return redirect('/privilege')->with('success', 'Update Privilege Successfully');
        
    }

    public function comboPrivilege($id, Request $request)
    {
        if (!$request->ajax()) {
            return redirect('/main');
        }
        $privileges = Privilege::where('id_group', $id)->pluck('name_privilege', 'id'); 
        return response()->json($privileges);
    }

    public function viewPermissionPrivilege($id, Request $request)
    {
        if (!$request->ajax()) {
            return redirect('/privilege');
        }
        $permission_privilege = PrivilegePermission::where('id_privilege', $id)->pluck('id_permission')->toArray();
        return response()->json([
            'permissions' => $permission_privilege
        ]);
    }

}
