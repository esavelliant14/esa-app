<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Login;
use App\Models\Company;
use App\Models\Privilege;

class UserController extends Controller
{
    public function index(){
        return view('user',[
            'title_url' => 'USER | ESA.NET',
            'active' => 'user',
            'title_menu' => 'USER',
            'title_submenu' => 'USER',
            'var_show' => Login::all(),
            'var_show_company' => Company::all(),
            'var_show_privilege' => Privilege::all(),
        ]);
    }

//    public function add(Request $post_create_user)
//    {
//        $test = $post_create_user->validate([
//            'txt_name' => 'required',
//            'txt_email' => 'required|unique:table_logins,email|email:dns',
//            'txt_company' => 'required',
//            'txt_privileged' => 'required',
//            'txt_password' => 'required|confirmed',
//            'txt_password_confirmation' => 'required',
//        ]);
//
//        dd($test);
//    }

    public function add(Request $post_create_user)
    {
        $var_data = Validator::make($post_create_user->all(), [
            'txt_name' => 'required',
            'txt_email' => 'required|unique:table_logins,email|email:dns',
            'txt_company' => 'required',
            'txt_privileged' => 'required',
            'txt_status' => 'required',
            'txt_password' => 'required|confirmed',
            'txt_password_confirmation' => 'required',
        ]);
        
        if( $var_data->fails() ){
            return redirect('/user')
            ->withErrors($var_data)
            ->withInput();
        }else{
            $var_data_valid = $var_data->validated();
//            dd($var_data_valid);
            Login::create([
                'name' => $var_data_valid['txt_name'],
                'email' => $var_data_valid['txt_email'],
                'id_company' => $var_data_valid['txt_company'],
                'id_privilege' => $var_data_valid['txt_privileged'],
                'status' => $var_data_valid['txt_status'],
                'password' => bcrypt($var_data_valid['txt_password']),
            ]);
            return redirect('/user')->with('success', 'Create User Successfully');
        };
  }



}
