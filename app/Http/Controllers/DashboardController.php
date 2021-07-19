<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
     public function index()
    {
        $date_now = Carbon::now('Asia/Jakarta')->format('Y-m-d');
         $jadwal = DB::table("pesanan")
         
         ->WHERE('tanggal_pesan',$date_now)
         ->ORDERBY ('jam_pesan')
         ->get();
        return view('dashboard',compact('jadwal','date_now'));
    }
}
