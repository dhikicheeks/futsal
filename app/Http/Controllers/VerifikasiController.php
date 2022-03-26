<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VerifikasiController extends Controller
{

    //! NON MEMBER

    //? DP
    //TODO UPDATE STATUS VERIFIKASI DP
     public function update_verifikasi_dp(Request $request)
    {
        $update_verifikasi_dp = $request->id_non_member;
        $ambildata = DB::table('non_member')
                   ->SELECT(
                    'jadwal' ,
                    )
              ->where('id_non_member', $update_verifikasi_dp)
              ->first(); 

            $update_now = Carbon::now('Asia/Jakarta');
             DB::table('non_member')
                                    ->WHERE(
                                        'id_non_member','=',$update_verifikasi_dp
                                    )
                                    ->UPDATE([
                                      
                                        'updated_at' => $update_now
                                    ]); 
             DB::table('jadwal_pertandingan')
                                    ->WHERE(
                                        'id_pertandingan','=',$ambildata->jadwal
                                    )
                                    ->UPDATE([
                                          'flag_status' =>3,
                                        
                                    ]); 
        return redirect('/home');
    }
     //TODO MODAL DETAIL VALIDASI DP
    public function detail_validasi_dp(Request $request)
    {
            $id_non_member = $request ->id_non_member;
            $pesanan = DB::TABLE('non_member')
                       ->LEFTJOIN("jadwal_pertandingan","non_member.jadwal","jadwal_pertandingan.id_pertandingan")
                                ->LEFTJOIN("paket","jadwal_pertandingan.paket","paket.id_paket")
                                ->LEFTJOIN("status_pesanan","jadwal_pertandingan.flag_status","status_pesanan.id_status_pesanan")
                                ->SELECT(
                                    'non_member.*',
                                    'jadwal_pertandingan.jam_pertandingan',
                                    'jadwal_pertandingan.nama_tim',
                                    'jadwal_pertandingan.tanggal_pertandingan',                
                                    'status_pesanan.deskripsi AS status_deskripsi', 
                                    'paket.harga',                                
                                    'paket.deskripsi AS harga_deskripsi',                                
                                )
                                ->where('id_non_member', $id_non_member)
                        ->GET();
                        // dd($pesanan);
            return view('home.detail.validasi-dp-detail',compact('pesanan'));
    }





      //? BATAL 
     // TODO BATAL VERIFIKASI PEMESANAN 
    public function verifikasi_batal_pemesanan (Request $request)
    {
        $cancel_pesanan = $request->id_non_member;
        $ambildata = DB::table('non_member')
                   ->SELECT(
                    'jadwal',
                    )
                    ->where('id_non_member', $cancel_pesanan)
                    ->first(); 
        $update_now = Carbon::now('Asia/Jakarta');
        DB::table('non_member')
                                ->WHERE(
                                        'id_non_member','=',$cancel_pesanan
                                    )
                                ->UPDATE([      
                                        'updated_at' => $update_now
                                    ]); 
        DB::table('jadwal_pertandingan')
                                    ->WHERE(
                                        'id_pertandingan','=',$ambildata->jadwal
                                    )
                                    ->UPDATE([
                                          'flag_status' =>5,
                                    ]); 
        return redirect()->back();
    }

    // TODO MODAL DETAIL BATAL PESANAN MODAL
     public function batal_pemesanan(Request $request)
    {
        $id_non_member = $request->id_non_member;
        $pesanan = DB::TABLE('non_member')
                       ->LEFTJOIN("jadwal_pertandingan","non_member.jadwal","jadwal_pertandingan.id_pertandingan")
                                ->LEFTJOIN("paket","jadwal_pertandingan.paket","paket.id_paket")
                                ->LEFTJOIN("status_pesanan","jadwal_pertandingan.flag_status","status_pesanan.id_status_pesanan")
                                ->SELECT(
                                    'non_member.*',
                                    'jadwal_pertandingan.jam_pertandingan',
                                    'jadwal_pertandingan.nama_tim',
                                    'jadwal_pertandingan.tanggal_pertandingan',                
                                    'status_pesanan.deskripsi AS status_deskripsi',                                 
                                )
                                ->where('id_non_member', $id_non_member)
                            
                        ->GET();
        return view('home.detail.validasi-batal-detail', compact('pesanan'));
    }





    //? PELUNASAN
    //TODO VERIFIKASI PELUNASAN INDEX
    public function verifikasi_pelunasan(){
    $pelunasan = DB::TABLE('non_member')
                       ->LEFTJOIN("jadwal_pertandingan","non_member.jadwal","jadwal_pertandingan.id_pertandingan")
                                ->LEFTJOIN("paket","jadwal_pertandingan.paket","paket.id_paket")
                                ->LEFTJOIN("status_pesanan","jadwal_pertandingan.flag_status","status_pesanan.id_status_pesanan")
                                ->SELECT(
                                    'non_member.*',
                                    'jadwal_pertandingan.jam_pertandingan',
                                    'jadwal_pertandingan.tanggal_pertandingan',
                                    'jadwal_pertandingan.tanggal_pertandingan',                
                                    'status_pesanan.deskripsi AS status_deskripsi',                                 
                                )
                        ->WHEREIN('flag_status',[3])
                        ->GET();
         return view('home.verifikasi.verifikasi_pelunasan',compact('pelunasan'));

    }

     //TODO VERIFIKASI PELUNASAN MODAL
    public function detail_validasi_pelunasan(Request $request)
    {
            $id_non_member = $request ->id_non_member;
            $pesanan = DB::TABLE('non_member')
                       ->LEFTJOIN("jadwal_pertandingan","non_member.jadwal","jadwal_pertandingan.id_pertandingan")
                                ->LEFTJOIN("paket","jadwal_pertandingan.paket","paket.id_paket")
                                ->LEFTJOIN("status_pesanan","jadwal_pertandingan.flag_status","status_pesanan.id_status_pesanan")
                                ->SELECT(
                                    'non_member.*',
                                    'jadwal_pertandingan.jam_pertandingan',
                                    'jadwal_pertandingan.nama_tim',
                                    'jadwal_pertandingan.tanggal_pertandingan',             
                                    'status_pesanan.deskripsi AS status_deskripsi',                                 
                                    'paket.deskripsi',                                 
                                    'paket.harga',                                 
                                )
                                ->where('id_non_member', $id_non_member)
                            
                        ->GET();
                        // dd($pesanan);
            return view('home.detail.validasi-pelunasan-detail',compact('pesanan', 'id_non_member'));
    }
    
    //TODO UPDATE STATUS PELUNASAN
     public function update_verifikasi_pelunasan(Request $request) {
        
         $harga_rompi = $request->rompi;
         $update_verifikasi_pelunasan= $request->id_non_member;
         $update_now = Carbon::now('Asia/Jakarta');
        //  dd($update_verifikasi_pelunasan);
         $verifikasi = DB::table('non_member')
                   ->SELECT(
                    'jadwal' ,
                    )
                    ->where('id_non_member', $update_verifikasi_pelunasan)
                    ->first(); 
        // dd($verifikasi);
        $update_now = Carbon::now('Asia/Jakarta');
                                    DB::table('non_member')
                                    ->WHERE(
                                      'jadwal','=',$verifikasi->jadwal
                                    )
                                    ->UPDATE([
                                         'tambahan_rompi' => $harga_rompi,
                                        'updated_at'=>$update_now
                                    ]); 
                                     DB::table('jadwal_pertandingan')
                                    ->WHERE(
                                        'id_pertandingan','=',$verifikasi->jadwal
                                    )
                                    ->UPDATE([
                                          'flag_status' =>4,
                                    ]);          
        $resi = DB::table('jadwal_pertandingan as a')
                        ->LEFTJOIN('non_member as b', 'a.id_pertandingan', 'b.jadwal')
                        ->LEFTJOIN('paket as c', 'a.paket', 'c.id_paket')
                        ->select(
                            'a.tanggal_pertandingan',
                            'a.jam_pertandingan',
                            'a.nama_tim',
                            'b.nama_pemesan',
                            'b.tambahan_rompi',
                            'b.biaya_tambahan',
                            'c.deskripsi as nama_paket',
                            'c.harga'
                        )
                        ->where('b.id_non_member', $update_verifikasi_pelunasan)
                        ->get();
            // dd($resi);
        //  return redirect()->back()->with('status', 'Pesanan Di Laporkan');
        return view('resi_total', compact('resi'))->with('status', 'Pesanan Di Laporkan');
    }




    // ! MEMBER
    //TODO VERIFIKASI MEMBER BARU INDEX
    public function verifikasi_member_baru(){

        
        $member=  DB::table('member')
                                ->LEFTJOIN("jadwal_pertandingan","member.jadwal","jadwal_pertandingan.id_pertandingan")
                                ->LEFTJOIN("paket","jadwal_pertandingan.paket","paket.id_paket")
                                ->LEFTJOIN("status_pesanan","jadwal_pertandingan.flag_status","status_pesanan.id_status_pesanan")
                                ->LEFTJOIN("users","member.id_user_member","users.id")
                                ->LEFTJOIN("jenis_pembayaran","jadwal_pertandingan.metode_pembayaran","jenis_pembayaran.id_pembayaran")
                                ->SELECT(
                                    'member.*',
                                    'jadwal_pertandingan.*',                
                                    'status_pesanan.deskripsi AS status_deskripsi',                                 
                                    'users.name',
                                    'paket.deskripsi',
                                    'jenis_pembayaran.diskripsi AS metode_pembayaran'
                                )
                                ->where('jadwal_pertandingan.metode_pembayaran', '!=', 1)  
                                ->WHERE('jadwal_pertandingan.flag_status', 7)
                                ->orWhere('jadwal_pertandingan.metode_pembayaran', '!=', 1) 
                                ->WHERE('jadwal_pertandingan.flag_status', 3)
                                ->groupBy('member.id_user_member')
                                // ->groupBy('member.id_user_member')
                                // ->orderBy('jadwal_pertandingan.id_pertandingan')
                                ->GET();
                                // dd($member);
        return view('home.verifikasi.verifikasi_member_baru',compact('member'));
    }
    // TODO MODAL DETAIL
    public function tampil_verifikasi_member(Request $request)
    {
        $id_user_member = $request->id_user_member;
        $member=  DB::table('member')
                                ->LEFTJOIN("jadwal_pertandingan","member.jadwal","jadwal_pertandingan.id_pertandingan")
                                ->LEFTJOIN("paket","jadwal_pertandingan.paket","paket.id_paket")
                                ->LEFTJOIN("status_pesanan","jadwal_pertandingan.flag_status","status_pesanan.id_status_pesanan")
                                ->LEFTJOIN("users","member.id_user_member","users.id")
                                ->SELECT(
                                    'member.*',
                                    'jadwal_pertandingan.*',                
                                    'status_pesanan.deskripsi AS status_deskripsi',                                 
                                    'users.name'                                 
                                )  
                                ->WHERE('member.id_user_member', $id_user_member)
                                ->groupBy('member.id_user_member')
                                ->GET();
                                // dd($member);
        return view('home.verifikasi.tampil_verifikasi_member_baru',compact('member'));
    }
    
    // TODO VERIFIKASI TOMBOL
    public function verifikasi_admin(Request $request)
    {
        $id_user_member = $request->id_user_member;
        $jadwal = DB::table('member')
            ->select('jadwal')
            ->WHERE('id_user_member', $id_user_member)
            ->get();
        // dd($jadwal);
        foreach ($jadwal as $key) {
            $jadwal = $key->jadwal;
            DB::table('jadwal_pertandingan')
                ->WHERE('id_pertandingan', $jadwal)
                ->update([
                    'flag_status' => 4
                ]);
        }
        
            return redirect()->back();
    }

   
    
}



 