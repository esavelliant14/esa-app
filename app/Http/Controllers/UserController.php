<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return view('user',[
            'title_url' => 'USER | ESA.NET',
            'active' => 'user',
            'title_menu' => 'USER',
            'title_submenu' => 'USER',
        ]);
    }

    public function add_user(Request $post_create_user){
        $test = $post_create_user->validate([
            'txt_name' => 'required',
            'txt_email' => 'required|unique:table_login,email|email:dns',
            'txt_company' => 'required',
            'txt_privileged' => 'required',
            'txt_password' => 'required|confirmed',
            'txt_password_confirmation' => 'required',
        ]);

        dd($test);
    }
}
