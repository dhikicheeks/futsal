<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
     
    public function home()
    {
        $inventory = DB::table("inventory")->get();
        $validasi_dp = DB::table("pesanan")
                        ->LEFTJOIN("status_pesanan", 'pesanan.flag_status', 'status_pesanan.id_status_pesanan')
                        ->SELECT(
                        'pesanan.*',
                        'status_pesanan.deskripsi'
                    )
                    ->get();
         return view('home.home',compact('validasi_dp','inventory'));
    }
     
   public function store_inventory(Request $request)
    {

        $request->validate([
            'barang'=>'required',
            'jumlah'=>'required | integer',
        ]); 

        DB::table('inventory')->insert([
            'nama_barang' => $request->barang,
            'jumlah' => $request->jumlah,
        ]);
        return redirect('/home')->with('status', 'Inventory Ditambahkan!');
       
    }

     public function destroy_inventory($id_inventory)

    {
        DB::table('inventory')->where('id_inventory',$id_inventory)->delete();
         return redirect('/home')->with('status-delete', 'Snack Berhasil Di Hapus!');
    }

    public function detail_validasi_dp(Request $request)
    {
            $id_pesanan = $request ->id_pesanan;
            $pesanan = DB::table("pesanan")->SELECT('*')
                        ->where('id_pesanan', $id_pesanan)
                        ->get();
            return view('home.detail.validasi-dp-detail',compact('pesanan'));

    }
    public function turnamen()
    {
           
            return view('turnamen');

    }
    

    
}
