<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {

        //echo "Ini halaman About by controller";
        return view('about');
    }
}
