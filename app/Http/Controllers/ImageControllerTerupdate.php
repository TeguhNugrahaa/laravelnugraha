<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// memanggil untuk model produk
use App\Models\Produk;

use Intervention\Image\Facades\Image as InterventionImage;
use Illuminate\Support\Carbon;

// memanggil untuk pengguna image
use App\Models\Image;

// memanggil untuk pengguna MultiPic
use App\Models\Multipic;

// tambahkan use untuk unlink data

use Illuminate\Support\Facades\File;

// use untuk storage data
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /** @var  \Illuminate\Filesystem\FilesystemManager $storage */
    private $storage;

    // sebelum masuk jalan ke controller
    public function __construct()
    {
        // ini untuk proses autentifikasi
        $this->middleware('auth');
        // ini untuk penyimpanan gambarnya public
        $this->storage = Storage::disk('public');
    }

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
                // required ini wajib diisi form untuk validasi value berarti image untuk semuanya;
                'image_name' => 'required|unique:images|max:255',
                'upload_image' => ['required', 'image'],
            ],
            [
                'image_name.required' => 'Nama Image tidak boleh kosong!'

            ]
        );

        $image = $request->file('upload_image');
        $uploadPath = $this->storage->putFile('image/file', $image);
        // dapetin path directory file
        $origin = str_replace('image/file/', '', $uploadPath);
        $resize = InterventionImage::make($image)->resize(300, 200)->encode();
        // untuk memanggil resize
        $this->storage->put('image/file/resize/' . $origin, $resize);

        Image::insert([
            'image_name' => $request->image_name,
            'image' => $uploadPath,
            //karena dia carbonnya array hrs pake tanda koma
            'created_at' => Carbon::now(),
        ]);

        // arahkan ke route belum tentu kalau si back
        return redirect()->route('all.image')->with('success', 'Data Image berhasil ditambahkan!');
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
        $image = Image::findOrFail($id);
        //tambahkan method postnya

        $validated = $request->validate(
            [
                // required ini wajib diisi, nullabe edit image name, upload images ketika edit itu tidak selalu orang itu upload gambar, required (wajib) ;
                'image_name' => ['required', 'max:255', 'unique:images,image_name,' . $id],
                'upload_image' => ['nullable', 'image']
            ],
            [
                'image_name.required' => 'Nama Image tidak boleh kosong!'

            ]
        );

        // ngirim ke request data lama
        $attributes = $request->only(['image_name']);
        $attributes['updated_at'] = Carbon::now();

        // if kalo ada upload gambar baru
        // skip kalo cuma update nama doang
        if ($request->hasFile('upload_image')) {
            // upload gambar dulu, kalo berhasil replace image lama
            $uploadImage = $request->file('upload_image');
            $uploadPath = $this->storage->putFile('image/file', $uploadImage);
            $origin = str_replace('image/file/', '', $uploadPath);
            // ketika mau resize gambarnya dalam bentuk biner (kode komputer) kode komputer bisa nyatuin gambar
            $resize = InterventionImage::make($uploadImage)->resize(300, 200)->encode();
            $this->storage->put('image/file/resize/' . $origin, $resize);
            $attributes['image'] = $uploadPath;

            // proses delete gambar lama dan resizenya
            $file = $image->image;
            // fungsi resize
            $thumbnail = str_replace('image/file', 'image/file/resize', $file);
            // berarti file asli
            $this->storage->delete($file);
            // berarti file yang sudah berubah (resize)
            $this->storage->delete($thumbnail);
        }

        $image->update($attributes);

        return redirect()->route('all.image')->with('success', 'Data Image berhasil diubah!');
    }

    //fungsi untuk deleteImage
    public function deleteImage($id)
    {
        $status = 'failed';
        $message = 'Data gagal dihapus!';
        $image = Image::findOrFail($id);
        $file = $image->image;

        if ($image->delete()) {
            $status = 'success';
            $message = 'Data berhasil di hapus!';
            //str_replace ubah replacenya ubah gambar
            $thumbnail = str_replace('image/file', 'image/file/resize', $file);
            $this->storage->delete($file);
            $this->storage->delete($thumbnail);
        }

        return redirect()->route('all.image')->with($status, $message);
    }

    //fungsi untuk  method multipic

    public function multiPic()
    {

        // nampilin file semuanya
        $images = Multipic::all();

        return view('admin.multipic.index', compact('images'));
    }

    //fungsi untuk  method multiadd post
    public function multiAdd(Request $request)
    {
        $request->validate([
            'upload_images' => ['required', 'array'],
            'upload_images.*' => ['image'],
        ]);

        $images = $request->file('upload_images');
        // manggil upload image
        foreach ($images as $image) {
            // nama folder multipic
            $uploadPath = $this->storage->putFile('multipic', $image);
            Multipic::create(['image' => $uploadPath]);
        }

        return redirect()->route('multi.pic')->with('success', 'berhasil upload file');
    }

    public function deleteMulti($id)
    {
        $status = 'failed';
        $message = 'Data gagal dihapus!';
        $image = Multipic::findOrFail($id);
        $file = $image->image;

        if ($image->delete()) {
            $status = 'success';
            $message = 'Data berhasil di hapus!';
            $this->storage->delete($file);
        }

        return redirect()->route('multi.pic')->with($status, $message);
    }
}
