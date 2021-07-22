<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class PesananController extends Controller
{
     public function index()
    {
         $pesanan = DB::table("pesanan")
                    ->leftjoin("paket", 'pesanan.paket', 'paket.id_paket')
                    ->leftjoin("status_pesanan", 'pesanan.flag_status', 'status_pesanan.id_status_pesanan')
                    ->SELECT(
                        'pesanan.*',
                        'paket.deskripsi',
                        'status_pesanan.deskripsi AS status_deskripsi'
                    )
                    ->WHEREIN('flag_status',[1,2])
                    ->get();
        $paket_jam1 = DB::table("paket")
                    ->SELECT('*')
                    ->where('jenis_paket', 1)
                    ->where('to_role_id', 0)
                    ->get();
        $paket_jam2 = DB::table("paket")
                    ->SELECT("*")
                    ->where('jenis_paket', 2)
                    ->where('to_role_id', 0)
                    ->get();
        return view('pesan',compact('pesanan', 'paket_jam1', 'paket_jam2'));
    }

     public function store_pesanan(Request $request)
    {
         $request->validate([           
            'pemesan'=>'required',
            'nama_tim'=>'required', 
            'jam'=>'required', 
            'tanggal'=>'required',
        ]);
        $date_now = Carbon::now('Asia/Jakarta');
        $jam =  $request->jam;

        if ($jam >= '17:00') {
            $tambahan = 1;
        } else {
            $tambahan = 0;
        }

        //TODO INPUT KE TABEL
        DB::table('pesanan')->insert([
            'tanggal_pesan'=>$request->tanggal,
            'jam_pesan'=>$request->jam,
            'paket'=>$request->paket,
            'nama_pemesan'=>$request->pemesan,
            'nama_tim'=>$request->nama_tim,
            'biaya_tambahan'=>$tambahan,
            'created_at'=>$date_now,
            'updated_at'=>$date_now,
        ]);

        //TODO AMBIL DATA UNTUK TAMPIL KE HALAMAN RESI_DP
        $ambil_data = DB::table("pesanan")
            ->leftjoin('paket', 'pesanan.paket', 'paket.id_paket')
            ->SELECT(
                "pesanan.*",
                'paket.*'
            )
            ->where('pesanan.tanggal_pesan', $request->tanggal)
            ->where('pesanan.jam_pesan', $request->jam)
            ->where('pesanan.paket', $request->paket)
            ->where('pesanan.nama_pemesan', $request->pemesan)
            ->where('pesanan.nama_tim', $request->nama_tim)
            ->where('pesanan.biaya_tambahan', $tambahan)
            ->where('pesanan.created_at', $date_now)
            ->get();
        
        // TODO MENGAMBIL HARGA PAKET YANG DI INPUT
        foreach ($ambil_data as $value) {
            $ambil_data_tambahan = $value->harga;
        }

        // TODO JIKA 1 MAKA HARGA PAKET (AMBIL_DATA_TAMBAHAN) + 20000
        if ($tambahan == 1) {
            $total_harga = $ambil_data_tambahan + '20000';
        }else{
            $total_harga = $ambil_data_tambahan;
        }

        $data = [
            'ambil_data' => $ambil_data,
            'total_harga' => $total_harga,
        ];

        // dd($ambil_data);
        return view('resi-dp', $data);
    }
    
    // TODO UPLOAD BUKTI DI RESI
    public function resi_transaksi_upload(Request $request)
    {
        dd($request);
        $foto_resi = $request->file('foto_resi');
        $id_pesanan = $request->id_pesanan;
        // dd($id_pesanan);
        $namaFile = uniqid('foto_resi_');
        $eksetensiFile = $foto_resi->getClientOriginalExtension();
        $namaFileBaru = $namaFile. '.' .$eksetensiFile;

        $direktoriUpload = public_path().'/bukti_resi';
        $foto_resi->move($direktoriUpload, $namaFileBaru);
        $update_now = Carbon::now('Asia/Jakarta');
        $data=[
            'bukti_tf' => $namaFileBaru,
            'flag_status' => 2,
            'updated_at'=>$update_now
        ];
        DB::table('pesanan')
            ->where('id_pesanan', $id_pesanan)
            ->update($data);

        return redirect('/pesan')->with('status', 'Pesanan Anda Menunggu Verifikasi Admin');
    }
}