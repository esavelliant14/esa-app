<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Privilege;

class PrivilegeController extends Controller
{
    public function index(){
        return view('privilege',[
            'title_url' => 'USER | ESA.NET',
            'active' => 'privilege',
            'title_menu' => 'PRIVILEGE',
            'title_submenu' => 'PRIVILEGE',
            'var_show' => Privilege::all(),
        ]);
    }

    public function add(Request $post_create_privilege)
    {
        $var_data = Validator::make($post_create_privilege->all(), [
            'txt_name_privilege' => 'required|unique:table_privileges,name_privilege',
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
            ]);
            return redirect('/privilege')->with('success', 'Create Company Successfully');
        };
  }
}
