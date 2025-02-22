<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Privilege;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;


class PrivilegeController extends Controller
{
    public function index(){
        
        if ( auth()->user()->id_company == 1 ){
            $show_privilege = Privilege::all();
            $show_company = Company::all();
        } else {
            $show_privilege = Privilege::where('id_company' , auth()->user()->id_company)->get();
            $show_company = Company::where('id' , auth()->user()->id_company)->get();
        }

        return view('privilege',[
            'title_url' => 'USER | ESA.NET',
            'active' => 'privilege',
            'title_menu' => 'PRIVILEGE',
            'title_submenu' => 'PRIVILEGE',
            'var_show' => $show_privilege,
            'var_show_company' => $show_company,
        ]);
    }

    public function add(Request $post_create_privilege)
    {
        $check_table_privilege = DB::table('table_privileges')
        ->where('name_privilege', $post_create_privilege->input('txt_name_privilege'))
        ->where('id_company', $post_create_privilege->input('txt_company'))
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
            'txt_company' => 'required',
            
        ],[
            'txt_name_privilege.required' => 'Name Privilege is Required',
            'txt_name_privilege.unique' => 'Name Privilege already exist',
            'txt_company.unique' => 'Name Company is Required'
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
                'id_company' => $var_data_valid['txt_company'],
            ]);
            return redirect('/privilege')->with('success', 'Create Privilege Successfully');
        };
  }

  public function comboPrivilege($id, Request $request)
    {
        if (!$request->ajax()) {
            return redirect('/main');
        }
        $privileges = Privilege::where('id', $id)->pluck('name_privilege', 'id'); // Sesuaikan dengan kolom tabel
        return response()->json($privileges);
    }

}
