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
    public function laporan_keuangan_turnamen()
    {
        return view('home.laporan.laporan_keuangan_turnamen');
    }
    public function laporan_keuangan_member()
    {
        return view('home.laporan.laporan_keuangan_member');
    }
}