<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SnackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
         $snack = DB::table("snack")->get();
        return view('home.snack.snack',['snack'=>$snack]);
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_snack(Request $request)
    {
        
         $request->validate([
            'tanggal'=>'required',
            'snack'=>'required | unique:snack,nama_snack',
            'harga'=>'required | integer',
            'stock'=>'required | integer',
            
        ]); 

        DB::table('snack')->insert([
            'tanggal_masuk'=>$request->tanggal,
            'nama_snack'=>$request->snack,
            'harga'=>$request->harga,
            'stock'=>$request->stock,

        ]);
        return redirect('stock_snack')->with('status', 'Snack Ditambahkan!');

        
    }

    /**
     * Display the specified resource.
     *
     
     * @return \Illuminate\Http\Response
     */
    public function show($snack)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
    
     * @return \Illuminate\Http\Response
     */
    public function edit($id_snack)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id_snack)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Snack  $snack
     * @return \Illuminate\Http\Response
     */
    public function destroy_snack($id_snack)
    {
        DB::table('snack')->where('id_snack',$id_snack)->delete();
         return redirect('stock_snack')->with('status-delete', 'Snack Berhasil Di Hapus!');

    }
}
