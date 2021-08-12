<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{

    // TODO INDEX LAPORAN
    public function laporan_keuangan_futsal()
    {
        $pesanan = DB::table('jadwal_pertandingan')
                        ->LEFTJOIN('member','jadwal_pertandingan.id_pertandingan', 'member.jadwal')
                        ->LEFTJOIN('non_member','jadwal_pertandingan.id_pertandingan', 'non_member.jadwal')
                        ->LEFTJOIN('paket','jadwal_pertandingan.paket', 'paket.id_paket')
                        ->LEFTJOIN('status_pesanan', 'jadwal_pertandingan.flag_status', 'status_pesanan.id_status_pesanan')
                        ->LEFTJOIN('users', 'member.id_user_member', 'users.id')
                        ->select(
                            'jadwal_pertandingan.id_pertandingan as jadwal',
                            'jadwal_pertandingan.tanggal_pertandingan as tanggal',
                            'jadwal_pertandingan.jam_pertandingan as jam',
                            'jadwal_pertandingan.nama_tim',
                            'jadwal_pertandingan.paket',
                            'jadwal_pertandingan.flag_status',
                            'member.id_user_member',
                            'member.updated_at',
                            'non_member.tambahan_rompi',
                            'non_member.id_non_member',
                            'non_member.biaya_tambahan',
                            'non_member.updated_at',
                            'non_member.nama_pemesan as nama_non_member',
                            'users.name as nama_member',
                            'paket.deskripsi as nama_paket',
                            'paket.harga',
                            'status_pesanan.deskripsi',
                        )
                        ->whereIn('jadwal_pertandingan.flag_status', [4, 5])
                        ->get();
                        // dd($pesanan);
        $status_pesanan = DB::table('jadwal_pertandingan')
                            ->LEFTJOIN('member','jadwal_pertandingan.id_pertandingan', 'member.jadwal')
                            ->LEFTJOIN('non_member','jadwal_pertandingan.id_pertandingan', 'non_member.jadwal')
                            ->select(
                                DB::raw('count(case when jadwal_pertandingan.flag_status = 5 then jadwal_pertandingan.id_pertandingan else null end) as batal_transaksi'),
                                DB::raw('count(case when jadwal_pertandingan.flag_status != 5 then jadwal_pertandingan.id_pertandingan else null end) as selesai_transaksi')
                            )
                            ->get();
                            // dd($pesanan);
        foreach ($status_pesanan as $key) {
            $jml_batal_transaksi = $key->batal_transaksi;
            $jml_selesai_transaksi = $key->selesai_transaksi;
        }
         return view('home.laporan.laporan_keuangan_futsal',compact('pesanan', 'jml_batal_transaksi', 'jml_selesai_transaksi'));
              
    }
    

    // TODO LAPORAN KEUANGAN PENJULAAN
    public function laporan_keuangan_snack()
    {
        $laporan_keuangan_snack = DB::table("snack")->get();
        return view('home.laporan.laporan_keuangan_snack',compact('laporan_keuangan_snack'));

    }
    // TODO FILTER PENJULAAN
    public function filter_snack(Request $request)
    {
        $tanggal1 = $request->tanggal1;
        $tanggal = $request->tanggal2;
        $nama_snack = $request->nama_snack;
        $laporan_keuangan_snack = DB::table("snack")
                                ->select('*');
                                if (!empty($tanggal1) && !empty($tanggal2)) {
                                    $laporan_keuangan_snack = $laporan_keuangan_snack->WHEREDATE('tanggal_keluar', '>=', $tanggal1)
                                    ->WHEREDATE('tanggal_keluar', '<=', $tanggal2);
                                }
                                if (!empty($nama_snack)) {
                                    $laporan_keuangan_snack = $laporan_keuangan_snack->where('nama_snack', $nama_snack);
                                }
                                $laporan_keuangan_snack = $laporan_keuangan_snack->get();
        return view('home.laporan.tampil_laporan_keuangan_snack',compact('laporan_keuangan_snack'));

    }
   

    // TODO DETAIL MODAL LAPORAN FUTSAL
    public function detail_keuangan_futsal(Request $request)
    {
            $id_user_member = Auth::user()->id;
            $jadwal = $request->jadwal;
            $role_id = Auth::user()->role_id;
            $jadwal_member = DB::table('member')->select('jadwal')->where('id_user_member',$id_user_member)->get();
            foreach ($jadwal_member as $key) {
                $jadwals = $key->jadwal;
            }
            // dd($jadwal);
            if ($role_id == 3) {
                $pesanan = DB::table('jadwal_pertandingan')
                        ->LEFTJOIN('member','jadwal_pertandingan.id_pertandingan', 'member.jadwal')
                        ->LEFTJOIN('non_member','jadwal_pertandingan.id_pertandingan', 'non_member.jadwal')
                        ->LEFTJOIN('paket','jadwal_pertandingan.paket', 'paket.id_paket')
                        ->LEFTJOIN('status_pesanan', 'jadwal_pertandingan.flag_status', 'status_pesanan.id_status_pesanan')
                        ->select(
                            'jadwal_pertandingan.id_pertandingan as jadwal',
                            'jadwal_pertandingan.tanggal_pertandingan as tanggal',
                            'jadwal_pertandingan.jam_pertandingan as jam',
                            'jadwal_pertandingan.nama_tim',
                            'jadwal_pertandingan.paket',
                            'jadwal_pertandingan.flag_status',
                            'member.id_user_member',
                            'member.updated_at',
                            'non_member.tambahan_rompi',
                            'non_member.id_non_member',
                            'non_member.biaya_tambahan',
                            'non_member.updated_at',
                            'paket.deskripsi as nama_paket',
                            'paket.harga',
                            'status_pesanan.deskripsi'
                        )
                        ->whereIn('jadwal_pertandingan.id_pertandingan', $jadwals)
                        ->get();
                $status_pesanan = DB::table('jadwal_pertandingan')
                            ->LEFTJOIN('member','jadwal_pertandingan.id_pertandingan', 'member.jadwal')
                            ->LEFTJOIN('non_member','jadwal_pertandingan.id_pertandingan', 'non_member.jadwal')
                            ->select(
                                DB::raw('count(case when jadwal_pertandingan.flag_status = 5 then jadwal_pertandingan.id_pertandingan else null end) as batal_transaksi'),
                                DB::raw('count(case when jadwal_pertandingan.flag_status != 5 then jadwal_pertandingan.id_pertandingan else null end) as selesai_transaksi')
                            )
                        ->whereIn('jadwal_pertandingan.id_pertandingan', $jadwals)
                            ->get();
                // dd($pesanan);
            }
            else {
                         $pesanan = DB::table('jadwal_pertandingan')
                        ->LEFTJOIN('member','jadwal_pertandingan.id_pertandingan', 'member.jadwal')
                        ->LEFTJOIN('non_member','jadwal_pertandingan.id_pertandingan', 'non_member.jadwal')
                        ->LEFTJOIN('paket','jadwal_pertandingan.paket', 'paket.id_paket')
                        ->LEFTJOIN('status_pesanan', 'jadwal_pertandingan.flag_status', 'status_pesanan.id_status_pesanan')
                        ->select(
                            'jadwal_pertandingan.id_pertandingan as jadwal',
                            'jadwal_pertandingan.tanggal_pertandingan as tanggal',
                            'jadwal_pertandingan.jam_pertandingan as jam',
                            'jadwal_pertandingan.nama_tim',
                            'jadwal_pertandingan.paket',
                            'jadwal_pertandingan.flag_status',
                            'member.id_user_member',
                            'member.updated_at',
                            'non_member.tambahan_rompi',
                            'non_member.id_non_member',
                            'non_member.biaya_tambahan',
                            'non_member.updated_at',
                            'paket.deskripsi as nama_paket',
                            'paket.harga',
                            'status_pesanan.deskripsi'
                        )
                        ->where('jadwal_pertandingan.id_pertandingan', $jadwal)
                        ->get();
                $status_pesanan = DB::table('jadwal_pertandingan')
                            ->LEFTJOIN('member','jadwal_pertandingan.id_pertandingan', 'member.jadwal')
                            ->LEFTJOIN('non_member','jadwal_pertandingan.id_pertandingan', 'non_member.jadwal')
                            ->select(
                                DB::raw('count(case when jadwal_pertandingan.flag_status = 5 then jadwal_pertandingan.id_pertandingan else null end) as batal_transaksi'),
                                DB::raw('count(case when jadwal_pertandingan.flag_status != 5 then jadwal_pertandingan.id_pertandingan else null end) as selesai_transaksi')
                            )
                            ->where('jadwal_pertandingan.id_pertandingan', $jadwal)
                            ->get();
            }
            
        foreach ($status_pesanan as $key) {
            $jml_batal_transaksi = $key->batal_transaksi;
            $jml_selesai_transaksi = $key->selesai_transaksi;
        }
                        // dd($pesanan);
         return view('home.detail.laporan-keuangan-futsal-detail',compact('pesanan', 'jml_batal_transaksi', 'jml_selesai_transaksi'));

    }

    // TODO FILTER TANGGAL LAPORAN KEUANGAN FUTSAL
    public function filtertanggalmaen(Request $request)
    {
        $tanggal1 =$request ->tanggalfilter1;
        $tanggal2 =$request ->tanggalfilter2;
        $status = $request->status;
        $filter_keuangan_futsal =  DB::table('jadwal_pertandingan')
                        ->LEFTJOIN('member','jadwal_pertandingan.id_pertandingan', 'member.jadwal')
                        ->LEFTJOIN('non_member','jadwal_pertandingan.id_pertandingan', 'non_member.jadwal')
                        ->LEFTJOIN('paket','jadwal_pertandingan.paket', 'paket.id_paket')
                        ->LEFTJOIN('status_pesanan', 'jadwal_pertandingan.flag_status', 'status_pesanan.id_status_pesanan')
                        ->LEFTJOIN('users', 'member.id_user_member', 'users.id')
                        ->select(
                            'jadwal_pertandingan.id_pertandingan as jadwal',
                            'jadwal_pertandingan.tanggal_pertandingan as tanggal',
                            'jadwal_pertandingan.jam_pertandingan as jam',
                            'jadwal_pertandingan.nama_tim',
                            'jadwal_pertandingan.paket',
                            'jadwal_pertandingan.flag_status',
                            'member.id_user_member',
                            'member.updated_at',
                            'non_member.tambahan_rompi',
                            'non_member.id_non_member',
                            'non_member.biaya_tambahan',
                            'non_member.updated_at',
                            'non_member.nama_pemesan as nama_non_member',
                            'users.name as nama_member',
                            'paket.deskripsi as nama_paket',
                            'paket.harga',
                            'status_pesanan.deskripsi'
                        );
                        if (!empty($status)) {
                            if ($status == 1) {
                                $filter_keuangan_futsal = $filter_keuangan_futsal->where('jadwal_pertandingan.paket', '=', 0);
                            }
                            else if ($status == 2) {
                                $filter_keuangan_futsal = $filter_keuangan_futsal->where('jadwal_pertandingan.paket', '!=', 0);
                            }
                        }
                        if (!empty($tanggal1) && !empty($tanggal2)) {
                            $filter_keuangan_futsal = $filter_keuangan_futsal->where(function ($query) use ($tanggal1, $tanggal2) {
                                        $query->WHEREDATE('member.updated_at', '>=', $tanggal1)
                                            ->WHEREDATE('member.updated_at', '<=', $tanggal2)
                                            ->orWHEREDATE('non_member.updated_at', '>=', $tanggal1)
                                            ->WHEREDATE('non_member.updated_at', '<=', $tanggal2);
                                    });

                        }
                        $filter_keuangan_futsal = $filter_keuangan_futsal
                        ->whereIn('jadwal_pertandingan.flag_status', [4, 5])
                        ->get();
                    $status_pesanan = DB::table('jadwal_pertandingan')
                            ->LEFTJOIN('member','jadwal_pertandingan.id_pertandingan', 'member.jadwal')
                            ->LEFTJOIN('non_member','jadwal_pertandingan.id_pertandingan', 'non_member.jadwal')
                            ->select(
                                DB::raw('count(case when jadwal_pertandingan.flag_status = 5 then jadwal_pertandingan.id_pertandingan else null end) as batal_transaksi'),
                                DB::raw('count(case when jadwal_pertandingan.flag_status != 5 then jadwal_pertandingan.id_pertandingan else null end) as selesai_transaksi')
                            )
                            ->get();
                            // dd($pesanan);
        foreach ($status_pesanan as $key) {
            $jml_batal_transaksi = $key->batal_transaksi;
            $jml_selesai_transaksi = $key->selesai_transaksi;
        }
                     return view('home.laporan.laporan_keuangan_futsal_filter',compact('filter_keuangan_futsal', 'jml_batal_transaksi', 'jml_selesai_transaksi'));

    }
    
}