<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index() {
        return view('index',[
            'title_url' => 'DASHBOARD | ESA.NET',
            'active' => 'dashboard',
            'title_menu' => 'DASHBOARD',
            'title_submenu' => 'DASHBOARD',
            
        ]); 
    }
}
