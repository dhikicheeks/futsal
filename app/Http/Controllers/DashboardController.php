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
        ->leftjoin("status_pesanan", 'pesanan.flag_status', 'status_pesanan.id_status_pesanan')
          ->SELECT(
                        'pesanan.*',
                        'status_pesanan.deskripsi'
                    )
         ->WHERE('tanggal_pesan',$date_now)
         ->ORDERBY ('jam_pesan')
         ->get();
        return view('dashboard',compact('jadwal','date_now'));
    }


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
}
