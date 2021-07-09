<?php

namespace App\Http\Controllers;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
     
    public function home()
    {
        $inventory = DB::table("inventory")->get();
        return view('home.home',['inventory'=>$inventory]);
    }
     
   public function store(Request $request)
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
}
