<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illumintae\Http\Redirect\Response;

//use Illuminate\Support\Carbon;
//use Auth;

class CategoryController extends Controller
{
    public function index()
    {

        //echo "Ini halaman Category di view index";
        return view('admin.category.index');
    }

    public function addCategory(Request $request)
    {
        //ini untuk membuat validasi

        //Proses Dump
        //dd($request->all());
        $validated = $request->validate(
            [
                // required ini wajib diisi;
                'name_category' => 'required|unique:categories|max:255',
            ],
            [
                'name_category.required' => 'Nama Category tidak boleh kosong!'

            ]
        );

        //Category::insert([

        // inin nanti disini berdasarkan field namenya ada di phpmyadmin

        //'name_category' => $request->name_category,
        //'id_user' => Auth::user()->id,
        //'create_at' => Carbon::now(),
        //]);

        // versi kedua pake eloquent ORM

        $category = new Category;
        $category->name_category = $request->name_category;
        $category->id_user = Auth::user()->id;
        $category->save();



        // manggil return redirectnya
        return redirect()->back()->with('success', 'Data berhasil disimpan');

        // ini untuk manggil insert categorynya
        //$request->except('_token');
        //Category::insert($request->all());


    }
}
