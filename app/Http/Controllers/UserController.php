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
}
