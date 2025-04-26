<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DdnsController extends Controller
{
    public function lists(){
        return view('index-ddns-lists',[
            'title_url' => 'LIST DDNS',
            'active' => 'list-ddns',
            'title_menu' => 'DDNS',
            'title_submenu' => 'LIST DDNS',
        ]);
    }

    public function users(){
        return view('index-ddns-users',[
            'title_url' => 'LIST USERS',
            'active' => 'list-users',
            'title_menu' => 'USERS',
            'title_submenu' => 'LIST USERS',
        ]);
    }

    public function forwarding(){
        return view('index-ddns-forwarding',[
            'title_url' => 'LIST FORWARDING',
            'active' => 'forwarding',
            'title_menu' => 'FORWARDING',
            'title_submenu' => 'LIST FORWARDING',
        ]);
    }
}
