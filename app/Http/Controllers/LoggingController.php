<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Logging;

class LoggingController extends Controller
{
    public function index(){
        if (!Gate::allows('access-permission' , '14')) {
            return redirect('/main')->with('access_denied', true);
        }

        $show_log = Logging::orderBy('created_at', 'desc')->where('id_group', auth()->user()->id_group)->get();
        
        return view('log',[
            'title_url' => 'LOG | SUPERAPPS',
            'active' => 'log',
            'title_menu' => 'LOG',
            'title_submenu' => 'LOG',
            'var_show' => $show_log,
        ]);
    }
}
