<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

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

        dd($request->all());
        $validated = $request->validate(
            [
                // required ini wajib diisi;
                'name_category' => 'required|unique:categories|max:255',
            ],
            [
                'name_category.required' => 'Nama Category tidak boleh kosong!'

            ]
        );
    }
}
