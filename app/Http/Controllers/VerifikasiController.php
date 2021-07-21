<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VerifikasiController extends Controller
{

    // INDEX
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

    public function detail_validasi_pelunasan(Request $request)
    {
            $id_pesanan = $request ->id_pesanan;
            $pesanan = DB::table("pesanan")
            ->leftjoin("paket", 'pesanan.paket', 'paket.id_paket')
                    ->SELECT(
                        'pesanan.*',
                        'paket.deskripsi','paket.harga')
                        ->where('id_pesanan', $id_pesanan)
                        ->get();
            return view('home.detail.validasi-dp-detail',compact('pesanan'));
                    }

    public function update_verifikasi_pelunasan(Request $request) {
         $update_verifikasi_pelunasan= $request->id_pesanan;
         $update_now = Carbon::now('Asia/Jakarta');
         $update_status_verifikasi_pelunasan= DB::table('pesanan')
                                    ->WHERE(
                                        'id_pesanan','=',$update_verifikasi_pelunasan
                                    )
                                    ->UPDATE([
                                        'flag_status' =>4,
                                        'updated_at'=>$update_now
                                    ]);
        //  $date_now = Carbon::now();
        //  $laporan_keuangan = DB::table('laporan_keuangan_futsak')->INSERT('tanggal_pesanan selesai' ->$request->date_now);
         return redirect()->back()->with('status', 'Pesanan Di Laporkan');
    }

    
}
