<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NasController extends Controller
{
    public function attribute(){
        return view('index-attribute',[
            'title_url' => 'ATTRIBUTE',
            'active' => 'attribute',
            'title_menu' => 'NAS',
            'title_submenu' => 'ATTRIBUTE',
        ]);
    }
}
