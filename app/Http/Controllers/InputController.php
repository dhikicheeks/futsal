<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InputController extends Controller
{
    public function pesan()
    {
        return view('pesan');
    }

    public function resi_dp()
    {
        return view('resi-dp');
    }

    public function upload_bukti_dp()
    {
        $upload_dp = DB::table("pesanan")
            ->leftjoin("paket", 'pesanan.paket', 'paket.id_paket')
                    ->SELECT(
                        'pesanan.*',
                        'paket.deskripsi','paket.harga')
                       ->where('pesanan.flag_status',1)
                        ->get();

                      
        return view('upload_bukti_dp',compact('upload_dp'));
    }

    public function turnamen()
    {
        return view('turnamen');
    }
}