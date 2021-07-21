<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function laporan_keuangan_futsal()
    {
    //    $total_pendapatan = DB::tabel('pesanan')
    //                     ->SELECTROW('SUM(harga)')
    //                     ->GET();

       
        $laporan_keuangan_futsal = DB::table("pesanan")
                        ->LEFTJOIN("status_pesanan", 'pesanan.flag_status', 'status_pesanan.id_status_pesanan')
                        ->LEFTJOIN("paket", 'pesanan.paket', 'paket.id_paket')
                        ->SELECT(
                        'pesanan.*',
                        'status_pesanan.deskripsi',
                        'paket.harga',
                        'paket.deskripsi AS deskripsi_paket'
                    )
                    ->whereIN('pesanan.flag_status',[4,3])
                    ->get();
         return view('home.laporan.laporan_keuangan_futsal',compact('laporan_keuangan_futsal'));




              
    }
    
    public function laporan_keuangan_snack()
    {
        $laporan_keuangan_snack = DB::table("snack")->get();
        return view('home.laporan.laporan_keuangan_snack',compact('laporan_keuangan_snack'));
        
    }
    public function laporan_keuangan_turnamen()
    {
        return view('home.laporan.laporan_keuangan_turnamen');
    }
    public function laporan_keuangan_member()
    {
        return view('home.laporan.laporan_keuangan_member');
    }

    public function detail_keuangan_futsal(Request $request)
    {
            $pesanan = DB::table("pesanan")
                    ->leftjoin("paket", 'pesanan.paket', 'paket.id_paket')
                    ->SELECT(
                        'pesanan.*',
                        'paket.deskripsi'
                    )
                    ->get();
        $paket_jam1 = DB::table("paket")
                    ->SELECT('*')
                    ->where('jenis_paket', 1)
                    ->get();
        $paket_jam2 = DB::table("paket")
                    ->SELECT("*")
                    ->where('jenis_paket', 2)
                    ->get();
        
            return view('home.detail.laporan-keuangan-futsal-detail',compact('pesanan'));

    }
    
}