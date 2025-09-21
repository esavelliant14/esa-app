<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bwmrtr;
use App\Models\Bwmclient;
use App\Models\Bwmbod;

class MainController extends Controller
{
    public function index() {
        $total_device = Bwmrtr::where('id_group', auth()->user()->id_group)->count();
        $total_client = Bwmclient::where('id_group', auth()->user()->id_group)->count();
        $total_bod = Bwmbod::where('id_group', auth()->user()->id_group)->count();

        // group per tanggal
        $bodGrouped = Bwmbod::selectRaw('DATE(created_at) as tanggal, 
            SUM(CASE WHEN status="Active" THEN 1 ELSE 0 END) as active_count,
            SUM(CASE WHEN status="Inactive" THEN 1 ELSE 0 END) as done_count')
            ->where('id_group', auth()->user()->id_group)
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        $dates       = $bodGrouped->pluck('tanggal')->map(fn($d) => \Carbon\Carbon::parse($d)->format('Y-m-d\TH:i:sP'));
        $activeArray = $bodGrouped->pluck('active_count');
        $doneArray   = $bodGrouped->pluck('done_count');

        return view('index',[
            'title_url' => 'DASHBOARD | SUPERAPPS',
            'active' => 'dashboard',
            'title_menu' => 'DASHBOARD',
            'title_submenu' => 'DASHBOARD',
            'var_total_device' => $total_device,
            'var_total_client' => $total_client,
            'var_total_bod' => $total_bod,
            'activeArray'     => $activeArray,
            'doneArray'       => $doneArray,
            'dates' => $dates,
            
        ]); 
    }
}
