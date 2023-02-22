<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    // ini proses konstruksi sebelum autentifikasi
    public function __construct()
    {

        $this->middleware('auth');
    }


    public function index()
    {

        //echo "Ini halaman About by controller";
        return view('about');
    }
}
