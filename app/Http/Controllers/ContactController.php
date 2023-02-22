<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{

    // ini proses konstruksi sebelum autentifikasi
    public function __construct()
    {

        $this->middleware('auth');
    }


    public function index()
    {

        //echo "Ini halaman Kontak by controller";
        return view('contact');
    }
}
