<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NasController extends Controller
{
    public function lists(){
        return view('index-nas-lists',[
            'title_url' => 'LIST NAS',
            'active' => 'list nas',
            'title_menu' => 'NAS',
            'title_submenu' => 'LIST NAS',
        ]);
    }

    public function attributes(){
        return view('index-nas-attributes',[
            'title_url' => 'ATTRIBUTE',
            'active' => 'attribute',
            'title_menu' => 'NAS',
            'title_submenu' => 'ATTRIBUTE',
        ]);
    }

    public function users(){
        return view('index-nas-users',[
            'title_url' => 'LIST USERS',
            'active' => 'list users',
            'title_menu' => 'NAS',
            'title_submenu' => 'LIST USERS',
        ]);
    }

    public function profile_bandwidth(){
        return view('index-nas-bw',[
            'title_url' => 'PROFILE BANDWIDTH',
            'active' => 'profile-bandwidth',
            'title_menu' => 'NAS',
            'title_submenu' => 'PROFILE BANDWIDTH',
        ]);
    }

    public function profile_ppp(){
        return view('index-nas-ppp',[
            'title_url' => 'PROFILE PPP',
            'active' => 'profile-ppp',
            'title_menu' => 'NAS',
            'title_submenu' => 'PROFILE PPP',
        ]);
    }
}
