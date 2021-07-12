<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TurnamenController extends Controller
{
     public function buat_jadwal_turnamen()
    {
        return view('home.turnamen.buat_jadwal_turnamen');
    }
     public function validasi_turnamen()
    {
        return view('home.turnamen.validasi_turnamen');
    }
}
