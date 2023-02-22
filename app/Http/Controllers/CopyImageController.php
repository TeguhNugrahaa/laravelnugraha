<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// memanggil untuk model produk
use App\Models\Produk;

use Intervention\Image\Facades\Image as InterventionImage;
use Illuminate\Support\Carbon;

// memanggil untuk pengguna image
use App\Models\Image;


// tambahkan use untuk unlink data

use Illuminate\Support\Facades\File;

class ImageController extends Controller
{


    public function index()
    {
        $images = Image::latest()->paginate(5);
        return view('admin.image.index', compact('images'));
    }

    // karena methodnya post jadi masuk ke request
    public function addImage(Request $request)
    {
        $validated = $request->validate(
            [
                // required ini wajib diisi;
                'image_name' => 'required|unique:images|max:255',
                //'image' => 'required|mimes:jpg.jpeg,png',
            ],
            [
                'image_name.required' => 'Nama Image tidak boleh kosong!'

            ]
        );

        $image = $request->file('image');

        //$generate_id = hexdec(uniqid());
        //$img_extension = strtolower($image->getClientOriginalExtension());
        //setelah itu buat concatenya generate_id sama img_extensionnya
        //$img_name =  $generate_id . '.' . $img_extension;
        //contohnya : namefile123.png

        // memanggil untuk memanggil file imagenya
        //$location = 'image/file/';
        //setelah itu buat concatenya location sama img_namenya
        //$last_img = $location . $img_name;
        //$image->move($location, $img_name);

        // Ini untuk generate_id nya


        $generate_id = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

        //InterventionImage::make($image)->resize(300, 200)->save('image/file/' . $generate_id);

        $img = InterventionImage::make($image)->resize(300, 200)->save('/image/file/' . $generate_id);

        $last_img = 'image/file/' . $generate_id;



        Image::insert([

            'image_name' => $request->image_name,
            'image' => $last_img,
            //karena dia carbonnya array hrs pake tanda koma
            'created_at' => Carbon::now(),


        ]);

        return redirect()->back()->with('success', 'Data Image berhasil ditambahkan!');
    }

    public function editImage($id)
    {
        //tambahkan method get

        $images = Image::findOrFail($id);
        return view('admin.image.edit_image', compact('images'));
    }
    // fungstion update image yang merequest untuk id table imagenya
    public function updateImage(Request $request, $id)
    {
        //tambahkan method postnya

        $validated = $request->validate(
            [
                // required ini wajib diisi;
                'image_name' => 'required|unique:images|max:255',
                //'image' => 'required|mimes:jpg.jpeg,png',
            ],
            [
                'image_name.required' => 'Nama Image tidak boleh kosong!'

            ]
        );

        // validate untuk old_image
        $old_image = $request->old_image;
        $image = $request->file('image');

        $generate_id = hexdec(uniqid());
        $img_extension = strtolower($image->getClientOriginalExtension());
        //setelah itu buat concatenya generate_id sama img_extensionnya
        $img_name =  $generate_id . '.' . $img_extension;
        //contohnya : namefile123.png

        // memanggil untuk memanggil file imagenya
        $location = 'image/file/';
        //setelah itu buat concatenya location sama img_namenya
        $last_img = $location . $img_name;
        //setelah itu imagenya kita move
        $image->move($location, $img_name);


        //fungsi unlink untuk meremove file yang akan di timpa
        //dd($old_image);
        unlink($old_image);
        //unlink($old_image);
        Image::findOrFail($id)->update([

            'image_name' => $request->image_name,
            'image' => $last_img,
            //karena dia carbonnya array hrs pake tanda koma
            'updated_at' => Carbon::now(),


        ]);

        return redirect()->route('all.image')->with('success', 'Data Image berhasil ditambahkan!');
    }


    //fungsi untuk deleteImage

    public function deleteImage($id)
    {
        $image = Image::findOrFail($id);
        //fungsi ini untuk memanggil folder imagenya
        $old_image = $image->image;
        unlink($old_image);
        //ketika ini bisa unlink dia bisa delete
        //tambahkan method findOrFail
        Image::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Data berhasil di hapus!');
    }
}
