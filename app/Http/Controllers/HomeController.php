<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
    //TODO INDEX
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

     //TODO SIMPAN INVENTORY
   public function store_inventory(Request $request)
    {
        $date_now = Carbon::now('Asia/Jakarta');
        $request->validate([
            'barang'=>'required | unique:inventory,nama_barang',
            'jumlah'=>'required | integer',
        ]); 

        DB::table('inventory')->insert([
            'nama_barang' => $request->barang,
            'jumlah' => $request->jumlah,
            'created_at' => $date_now,
        ]);
        return redirect('/home')->with('status', 'Inventory Ditambahkan!');
       
    }

    //TODO DELETE INVENTORY
     public function destroy_inventory($id_inventory)

    {
        DB::table('inventory')->where('id_inventory',$id_inventory)->delete();
         return redirect('/home')->with('status-delete', 'Snack Berhasil Di Hapus!');
    }

    
    
    //TODO EDIT INVENTORY
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


    }   

    //TODO UPDATE INVENTORY
    public function update_inventory(Request $request){
        $id_inventory = $request->id_inventory;
        $date_now = Carbon::now('Asia/Jakarta');
       
        $update = DB::table('inventory')
              ->where('id_inventory', '=', $id_inventory)
                    ->UPDATE([
                    'jumlah' =>$request->jumlah,
                    'updated_at'=>$date_now
                    ]);
           return redirect('/home')->with('status', 'Inventory Berhasil Diubah!');                                
    }   
}


 
