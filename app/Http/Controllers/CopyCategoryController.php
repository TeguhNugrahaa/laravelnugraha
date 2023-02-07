<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illumintae\Http\Redirect\Response;

use Illuminate\Support\Facades\DB;

//use Illuminate\Support\Carbon;
//use Auth;

class CategoryController extends Controller
{
    public function index()
    {

        //With untuk memanggil eloquent versi 1
        $categories = Category::with('user')->latest()->paginate(5);
        // dd($categories);
        return view('admin.category.index', compact('categories'));

        //With untuk memanggil eloquent versi 2 untuk relasi user modelnya
        //$cat = Category::with('user')->get();
        // dd($categories);
        //return $cat;

        //With untuk memanggil eloquent versi 2 untuk relasi user modelnya
        //$cat = Category::with('user')->get();
        // dd($categories);
        //return $cat;

        //Joint tabel dengan query builder
        // $categories = DB::table('categories')
        //     ->join('users', 'users.id', '=', 'categories.id_user')
        //     ->join('users', 'categories.id_user', 'users.id')
        //     ->select('categories.*', 'users.name')
        //     ->latest()->paginate(5);


        // ini untuk memanggil latest dengan menggunakan Eloquent ORM
        //$category = Category::latest()->get();

        // Fungsi untuk memanggil database tabel di phpmyadmin
        //$category = DB::table('categories')->latest()->get();

        // Fungsi untuk memanggil dengan pagination di phpmyadmin versi Eloquent ORM
        //$categories = Category::latest()->paginate(6);

        // Fungsi untuk memanggil dengan pagination di phpmyadmin versi Query Builder
        //$categories = DB::table('categories')->latest()->paginate(5);

        // ini untuk memanggil categori dengan menggunakan Eloquent ORM
        //$category = Category::all();
        //echo "Ini halaman Category di view index";
        // menampilkan kategories, ngambil database Category
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



        // Insert data with Eloquent ORM versi 1
        //Category::insert([
        // ini nanti disini berdasarkan field namenya ada di phpmyadmin
        //'name_category' => $request->name_category,
        //'id_user' => Auth::user()->id,
        //'create_at' => Carbon::now(),
        //]);

        // versi kedua pake eloquent ORM

        //$category = new Category;
        //$category->name_category = $request->name_category;
        //$category->id_user = Auth::user()->id;
        //$category->save();




        // Versi ketiga
        // Insert Data Query Builder dan untuk created_at pilih datenya
        $data = array();
        $data['name_category'] = $request->name_category;
        $data['id_user'] = Auth::user()->id;
        $data['created_at'] = date('y-m-d');
        DB::table('categories')->insert($data);





        // ini tujuannya untuk manggil insert, update lewat model
        //$data[] = [
        //'name_category' => $request->name_category,
        //'id_user' => Auth::user()->id,
        //'created_at' => now(),
        // ];
        //Category::insert($data);


        // manggil return redirectnya
        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }


    // ini untuk manggil insert categorynya
    //$request->except('_token');
    //Category::insert($request->all());


    // ini untuk kelas addCategory untuk edit

    public function editCategory($id)
    {
        // dengan menggunakan eloquent
        $categories = Category::findOrFail($id);
        return view('admin.category.edit_category', compact('categories'));
    }



    public function updateCategory(Request $request, $id)
    {
        // dengan menggunakan eloquent
        $categories = Category::findOrfail($id);
        $categories->update([
            // dengan menggunakan field name
            'name_category' => $request->name_category,
            'id_user' => Auth::user()->id,
        ]);
        return redirect()->route('all.category')->with('Data berhasil diupdate!');
    }
}
