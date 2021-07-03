<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InputController extends Controller
{
    public function pesan()
    {
        return view('pesan');
    }

    public function resi_dp()
    {
        return view('resi-dp');
    }

    public function upload_bukti_dp()
    {
        return view('upload_bukti_dp');
    }

    public function turnamen()
    {
        return view('turnamen');
    }
    
    public function tambah_inventory()
    {
        return view('home.inventory.tambah_inventory');
    }

    public function lihat_inventory()
    {
        return view('home.inventory.lihat_inventory');
    }
}