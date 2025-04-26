<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DnsController extends Controller
{
    public function lists(){
        return view('index-dns-lists',[
            'title_url' => 'LIST DNS',
            'active' => 'list-dns',
            'title_menu' => 'DNS',
            'title_submenu' => 'LIST DNS',
        ]);
    }
}
