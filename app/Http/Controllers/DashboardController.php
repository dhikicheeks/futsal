<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
     public function index()
    {
         $jadwal = DB::table("pesanan")->get();
        return view('dashboard',compact('jadwal'));
    }
}
