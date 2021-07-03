<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VerifikasiController extends Controller
{
    public function verifikasi_pelunasan(){
        return view('home.verifikasi.verifikasi_pelunasan');
    }
    
    public function verifikasi_member_baru(){
        return view('home.verifikasi.verifikasi_member_baru');
    }
}