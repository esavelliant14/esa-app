<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
class DnsController extends Controller
{

    public function lists(){
        if (!Gate::allows('access-permission' , '61')) {
            return redirect('/main')->with('access_denied', true);
        }
        return view('index-dns-lists',[
            'title_url' => 'LIST DNS',
            'active' => 'list-dns',
            'title_menu' => 'DNS',
            'title_submenu' => 'LIST DNS',
        ]);
    }
}
