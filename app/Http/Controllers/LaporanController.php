<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function laporan_keuangan_futsal()
    {
        
       
 $laporan_keuangan_futsal = DB::table("pesanan")
                    ->LEFTJOIN("paket", 'pesanan.paket', 'paket.id_paket')
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


         return view('home.laporan.laporan_keuangan_futsal',compact('laporan_keuangan_futsal', 'paket_jam1', 'paket_jam2'));
        
            
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