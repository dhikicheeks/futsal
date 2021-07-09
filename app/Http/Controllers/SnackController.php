<?php

namespace App\Http\Controllers;

use App\Models\Snack;
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
    public function store(Request $request)
    {
        
         $request->validate([
            'snack'=>'required',
            'harga'=>'required | integer',
            'stock'=>'required | integer',
            
        ]); 

        DB::table('snack')->insert([
            'nama_snack'=>$request->snack,
            'harga'=>$request->harga,
            'stock'=>$request->stock,

        ]);
        return redirect('stock_snack')->with('status', 'Snack Ditambahkan!');

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Snack  $snack
     * @return \Illuminate\Http\Response
     */
    public function show(Snack $snack)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Snack  $snack
     * @return \Illuminate\Http\Response
     */
    public function edit(Snack $snack)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Snack  $snack
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Snack $snack)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Snack  $snack
     * @return \Illuminate\Http\Response
     */
    public function destroy(Snack $snack)
    {
        //
    }
}
