<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function laporan_keuangan_futsal()
    {
        return view('home.laporan.laporan_keuangan_futsal');
    }
    
    public function laporan_keuangan_snack()
    {
        return view('home.laporan.laporan_keuangan_snack');
    }
}