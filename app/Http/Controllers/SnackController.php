<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class SnackController extends Controller
{
    
    public function index()

    {
         $snack = DB::table("snack")
                    ->WHERE('status_snack',0)
                    ->get();
        return view('home.snack.snack',['snack'=>$snack]);
      
    }

    public function store_snack(Request $request)
    {
       
        
         $request->validate([
            
            'nama_snack'=>'required | unique:snack,nama_snack',
            'harga_jual'=>'required | integer',
            'harga_beli'=>'required | integer',
            'jumlah_masuk'=>'required | integer',
            
        ]); 
        $date_now = Carbon::now('Asia/Jakarta');
        DB::table('snack')->insert([
            'nama_snack'=>$request->nama_snack,
            'harga_jual'=>$request->harga_jual,
            'harga_beli'=>$request->harga_beli,
            'jumlah_masuk'=>$request->jumlah_masuk,
            'tanggal_ditambahkan'=>$date_now,
            'tanggal_update'=>$date_now,
        ]);
        
        return redirect('stock_snack')->with('status', 'Snack Ditambahkan!');
        
        
       
    }

    // TODO TAMBAH QUANTITY SNACK
    public function tambah_quantity_snack(Request $request)
    {
        $id_snack = $request->id_snack;
        $data_snack = DB::table('snack')
            ->select('*')
            ->where('id_snack', $id_snack)
            ->get();
        
            return view('home.snack.tambah_snack', compact('data_snack'));
    }
    // TODO KURANG QUANTITY SNACK
    public function kurang_quantity_snack(Request $request)
    {
        $id_snack = $request->id_snack;
        
        $data_snack = DB::table('snack')
            ->select('*')
            ->where('id_snack', $id_snack)
            ->get();
        
            return view('home.snack.kurang_snack', compact('data_snack'));
    }
    public function save_tambah_quantity_snack(Request $request)
    {
        
        $id_snack = $request->id_snack;
        $jumlah_masuk = $request->jumlah_masuk;
        $data_snack = DB::table('snack')
            ->select('*')
            ->where('id_snack', $id_snack)
            ->get();
        foreach ($data_snack as $key) {
            $qty_jml = $key->jumlah_masuk;

        }
        // TODO DATA LAMA
        $qty_snack = $qty_jml+$jumlah_masuk;
        $current = Carbon::now('Asia/Jakarta');
        DB::table('snack')->WHERE('id_snack', $id_snack)
            ->update(['jumlah_masuk' => $qty_snack,
                       'tanggal_update'=>$current
        ]);
        return redirect()->back();
    }
    public function save_kurang_quantity_snack(Request $request)
    {
        
        $id_snack = $request->id_snack;
        $jumlah_keluar = $request->jumlah_keluar;
        $data_snack = DB::table('snack')
            ->select('*')
            ->where('id_snack', $id_snack)
            ->get();
        foreach ($data_snack as $key) {
            $qty_jml = $key->jumlah_masuk;
            $qty_kl = $key->jumlah_keluar;

        }
        // TODO DATA LAMA
        $qty_snack = $qty_jml-$jumlah_keluar;
        $qty_out = $qty_kl+$jumlah_keluar;
        $current = Carbon::now('Asia/Jakarta');
        DB::table('snack')->WHERE('id_snack', $id_snack)
            ->update(['jumlah_masuk' => $qty_snack,
                       'tanggal_keluar'=>$current,
                       'jumlah_keluar' => $qty_out,
                       'tanggal_update'=>$current
        ]);
        return redirect()->back();
    }
    
  
    public function destroy_snack($id_snack)
    {
        $date_now = Carbon::now('Asia/Jakarta');
        DB::table('snack')->where('id_snack',$id_snack)
            ->update(['status_snack' => 1, 'tanggal_dihapus'=>$date_now]);
         return redirect('stock_snack')->with('status-delete', 'Snack Berhasil Di Hapus!');

    }
}
