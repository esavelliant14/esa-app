<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Privilege;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;


class PrivilegeController extends Controller
{
    public function index(){
        
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
            Privilege::create([
                'name_privilege' => $var_data_valid['txt_name_privilege'],
                'id_group' => $var_data_valid['txt_group'],
            ]);
            return redirect('/privilege')->with('success', 'Create Privilege Successfully');
        };
  }

  public function comboPrivilege($id, Request $request)
    {
        //if (!$request->ajax()) {
        //    return redirect('/main');
        //}
        $privileges = Privilege::where('id_group', $id)->pluck('name_privilege', 'id'); 
        return response()->json($privileges);
    }

}
