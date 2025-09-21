<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
class DnsController extends Controller
{

    public function dnsMon(){
        if (!Gate::allows('access-permission' , '61')) {
            return redirect('/main')->with('access_denied', true);
        }
        return view('index-dnsmon-lists',[
            'title_url' => 'DNS MONITORING',
            'active' => 'list-dns',
            'title_menu' => 'DNS',
            'title_submenu' => 'DNS MONITORING',
        ]);
    }
}
