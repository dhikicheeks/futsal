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


            $jadwal = DB::table("jadwal_pertandingan")
                        ->LEFTJOIN("non_member","jadwal_pertandingan.id_pertandingan","non_member.jadwal")
                        ->LEFTJOIN("member","jadwal_pertandingan.id_pertandingan","member.jadwal")
                        ->LEFTJOIN("paket","jadwal_pertandingan.paket","paket.id_paket")
                        ->LEFTJOIN("status_pesanan","jadwal_pertandingan.flag_status","status_pesanan.id_status_pesanan")
                        // ->LEFTJOIN("status_pesanan AS status_member","member.flag_status","status_member.id_status_pesanan")
                        ->SELECT(
                                    'non_member.*',
                                    'member.*',
                                    'jadwal_pertandingan.jam_pertandingan',
                                    'jadwal_pertandingan.tanggal_pertandingan',
                                    'jadwal_pertandingan.flag_status',                       
                                    'jadwal_pertandingan.nama_tim',                       
                                    'status_pesanan.deskripsi AS status_deskripsi',                                 
                                    // 'status_member.deskripsi AS status_pesanan_member',    
                                        'paket.jenis_paket'                             
                                )
                                    ->WHERE('tanggal_pertandingan',$date_now)
                                    ->ORDERBY ('jam_pertandingan')
                                    ->get();
                                   
        return view('dashboard',compact('date_now','jadwal'));
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
        $upload_dp = DB::table("non_member")
            ->leftjoin("jadwal_pertandingan",'non_member.jadwal', 'jadwal_pertandingan.id_pertandingan')
            ->leftjoin("paket",'jadwal_pertandingan.paket', 'paket.id_paket')
                    ->SELECT(
                        'non_member.*',
                        'jadwal_pertandingan.*',
                        'paket.*'
                        )
                       ->where('jadwal_pertandingan.flag_status',1)
                        ->get();
                        // dd($upload_dp);
        return view('upload_bukti_dp',compact('upload_dp'));
    }

    
}
