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
                    ->WHEREIN('pesanan.flag_status',[1,2])
                    ->get();
         return view('home.home',compact('validasi_dp','inventory'));
    }
     
   public function store_inventory(Request $request)
    {

        $request->validate([
            'barang'=>'required | unique:inventory,nama_barang',
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
            $pesanan = DB::table("pesanan")
            ->leftjoin("paket", 'pesanan.paket', 'paket.id_paket')
                    ->SELECT(
                        'pesanan.*',
                        'paket.deskripsi','paket.harga')
                        ->where('id_pesanan', $id_pesanan)
                        ->get();
            return view('home.detail.validasi-dp-detail',compact('pesanan'));

    }
    public function turnamen()
    {
           
            return view('turnamen');

    }
    
    public function edit_inventory(Request $request){

        $id_inventory = $request->id_inventory;
        $edit = DB::table('inventory')
              ->SELECT(
                    'nama_barang' ,
                    'jumlah',
              )
              ->where('id_inventory', $id_inventory)
              ->first(); 
          
           return view('home.edit.inventory-edit',compact("edit", "id_inventory"));
                                
                    //   ->with('status', 'Inventory Ditambahkan!');


    }   

    public function update_inventory(Request $request){
        
        $id_inventory = $request->id_inventory;
        // dd($id_inventory);
        $update = DB::table('inventory')
              ->where('id_inventory', '=', $id_inventory)
                    ->UPDATE([
                    'jumlah' =>$request->jumlah,
                    ]);
          
           return redirect('/home')->with('status', 'Inventory Berhasil Diubah!');                                
    }




     public function update_verifikasi_dp(Request $request)
    {
       $update_verifikasi_dp = $request->id_pesanan;

       $update_status_verifikasi_dp = DB::table('pesanan')
                                    ->WHERE(
                                        'id_pesanan','=',$update_verifikasi_dp
                                    )
                                    ->UPDATE([
                                        'flag_status' =>3
                                    ]);

        return redirect('/home');
    }
   
}


 
