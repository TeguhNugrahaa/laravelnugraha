<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {

        //echo "Ini halaman Kontak by controller";
        return view('contact');
    }
}
