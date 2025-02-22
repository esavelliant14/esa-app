<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Company;
use App\Models\Privilege;
use App\Models\TitleMenu;
class UserController extends Controller
{
    
    public function index(){

        if ( auth()->user()->id_company == 1 ){
            $show_privilege = Privilege::all();
            $show_company = Company::all();
            $show_user = User::all();
        } else {
            $show_privilege = Privilege::where('id_company' , auth()->user()->id_company)->get();
            $show_company = Company::where('id' , auth()->user()->id_company)->get();
            $show_user = User::where('id_company' , auth()->user()->id_company)->get();
        }

        return view('user',[
            'title_url' => 'USER | ESA.NET',
            'active' => 'user',
            'title_menu' => 'USER',
            'title_submenu' => 'USER',
            'var_show' => $show_user,
            'var_show_company' => $show_company,
            'var_show_privilege' => $show_privilege,
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
            User::create([
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

    public function delete(User $id)
    {
            User::destroy($id->id);      
            return redirect('/user')->with('success', 'Delete User Successfully');
    }

    public function test()
    {

    return view('test');
    }
}
