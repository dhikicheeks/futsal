<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VerifikasiController extends Controller
{
    public function verifikasi_pelunasan(){

 $pelunasan = DB::table("pesanan")
                        ->LEFTJOIN("status_pesanan", 'pesanan.flag_status', 'status_pesanan.id_status_pesanan')
                        ->SELECT(
                        'pesanan.*',
                        'status_pesanan.deskripsi'
                    )
                    ->where('pesanan.flag_status',3)
                    ->get();
         return view('home.verifikasi.verifikasi_pelunasan',compact('pelunasan'));

    }
    
    public function verifikasi_member_baru(){
        return view('home.verifikasi.verifikasi_member_baru');
    }
}