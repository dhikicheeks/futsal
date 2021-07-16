<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class PesananController extends Controller
{
     public function index()
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
        return view('pesan',compact('pesanan', 'paket_jam1', 'paket_jam2'));
    }

     public function store_pesanan(Request $request)
    {
        // dd($request);
         $request->validate([
            
            'pemesan'=>'required',
            'nama_tim'=>'required' 
           
            
        ]); 

        DB::table('pesanan')->insert([
            'tanggal_pesan'=>$request->tanggal,
            'jam_pesan'=>$request->jam,
            'paket'=>$request->paket,
            'nama_pemesan'=>$request->pemesan,
            'nama_tim'=>$request->nama_tim,

        ]);
        return redirect('pesan')->with('status', 'Snack Ditambahkan!');

        
    }
}