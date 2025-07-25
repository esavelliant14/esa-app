<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\group;
use App\Models\Privilege;
use Illuminate\Support\Facades\Gate;
use App\Models\Logging;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\TitleMenu;
class UserController extends Controller
{
   
    public function index(){

        if (!Gate::allows('access-permission' , '2')) {
            return redirect('/main')->with('access_denied', true);
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
            'txt_privilege' => 'required',
            'txt_status' => 'required',
            'txt_password' => 'required|confirmed',
            'txt_password_confirmation' => 'required',
        ],[
            'txt_name.required' => 'Name is required',
            'txt_email.required' => 'Email is required',
            'txt_email.unique' => 'Email already exist',
            'txt_email.email' => 'Wrong format email',
            'txt_group' => 'Group is required',
            'txt_privilege' => 'Privilege is required',
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
                'id_privilege' => $var_data_valid['txt_privilege'],
                'status' => $var_data_valid['txt_status'],
                'password' => bcrypt($var_data_valid['txt_password']),
            ]);
            Logging::create([
                'action_by' => auth()->user()->email,
                'category_action' => 'Create User',
                'status' => 'Success',
                'ip_address' => request()->ip(),
                'agent' => request()->header('User-Agent'),
                'details' => 'Creating user ' . $var_data_valid['txt_email'],

            ]);
            return redirect('/user')->with('success', 'Create User Successfully');
        };
    }

    public function update(Request $post_edit_user)
    {
        $existing_data = User::where('id' , $post_edit_user->txt_id)->first();
        
        $existing_privilege = Privilege::where('id', $existing_data->id_privilege)->pluck('name_privilege')->first();
        $existing_status = User::where('id' , $post_edit_user->txt_id)->pluck('status')->first();
        $new_privilege = Privilege::where('id', $post_edit_user->txt_privilege)->pluck('name_privilege')->first();
        $new_status = $post_edit_user->txt_status;
        User::where('id', $post_edit_user->txt_id)->update([
        'id_privilege' => $post_edit_user->txt_privilege,
        'status' => $post_edit_user->txt_status,
        ]);
        Logging::create([
            'action_by' => auth()->user()->email,
            'category_action' => 'Update User',
            'status' => 'Success',
            'ip_address' => request()->ip(),
            'agent' => request()->header('User-Agent'),
            'details' => 'Success update user=' . $post_edit_user->txt_email . ' from PRIVILEGE=' . $existing_privilege . ' and STATUS=' . $existing_status . ' CHANGES TO PRIVILEGE=' .$new_privilege. ' and STATUS='. $new_status,
            
        ]);
        return redirect('/user')->with('success', 'Update User Successfully');
        
    }
    
    public function reset_password(User $id)
    {
        User::where('id' , $id->id)->update(
            [
                'password' => bcrypt('qweqweqwe'),
                'two_factor_secret' => null,
                'two_factor_recovery_codes' => null,
            ]);
        Logging::create([
                'action_by' => auth()->user()->email,
                'category_action' => 'Reset Password',
                'status' => 'Success',
                'ip_address' => request()->ip(),
                'agent' => request()->header('User-Agent'),
                'details' => 'Success reset password user=' . $id->email,

            ]); 
        return redirect('/user')->with('success', 'Reset User Successfully');
        
    }

    public function delete(User $id)
    {
            User::destroy($id->id);
            Logging::create([
                'action_by' => auth()->user()->email,
                'category_action' => 'Delete User',
                'status' => 'Success',
                'ip_address' => request()->ip(),
                'agent' => request()->header('User-Agent'),
                'details' => 'Success delete user=' . $id->email,

            ]);   
            return redirect('/user')->with('success', 'Delete User Successfully');
    }


}
