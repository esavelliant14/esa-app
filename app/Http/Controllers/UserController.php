<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\group;
use App\Models\Privilege;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\TitleMenu;
class UserController extends Controller
{
   
    public function index(){

        if (!Gate::allows('access-permission' , '1')) {
            return redirect('/main');
        }
        if ( auth()->user()->id_group == 1 ){
            $show_privilege = Privilege::all();
            $show_group = group::all();
            $show_user = User::all();
        } else {
            $show_privilege = Privilege::where('id_group' , auth()->user()->id_group)->get();
            $show_group = group::where('id' , auth()->user()->id_group)->get();
            $show_user = User::where('id_group' , auth()->user()->id_group)->get();
        }

        return view('user',[
            'title_url' => 'USER | ESA.NET',
            'active' => 'user',
            'title_menu' => 'USER',
            'title_submenu' => 'USER',
            'var_show' => $show_user,
            'var_show_group' => $show_group,
            'var_show_privilege' => $show_privilege,
        ]);
    }

//    public function add(Request $post_create_user)
//    {
//        $test = $post_create_user->validate([
//            'txt_name' => 'required',
//            'txt_email' => 'required|unique:table_logins,email|email:dns',
//            'txt_group' => 'required',
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
            'txt_group' => 'required',
            'txt_privileged' => 'required',
            'txt_status' => 'required',
            'txt_password' => 'required|confirmed',
            'txt_password_confirmation' => 'required',
        ],[
            'txt_name.required' => 'Name is required',
            'txt_email.required' => 'Email is required',
            'txt_email.unique' => 'Email already exist',
            'txt_email.email' => 'Wrong format email',
            'txt_group' => 'Group is required',
            'txt_privileged' => 'Privilege is required',
            'txt_status' => 'Status is required',
            'txt_password.required' => 'Password is required',
            'txt_password.confirmed' => 'Password not match',
            'txt_password_confirmation.required' => 'Repeat password is required',
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
                'id_group' => $var_data_valid['txt_group'],
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


}
