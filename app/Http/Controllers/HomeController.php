<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\slider;


class HomeController extends Controller
{
    /** @var  \Illuminate\Filesystem\FilesystemManager $storage */
    private $storage;

    // sebelum masuk jalan ke controller
    public function __construct()
    {
        // ini untuk penyimpanan gambarnya public
        $this->storage = Storage::disk('public');
    }

    public function homeSlider()
    {

        $sliders = Slider::latest()->get();
        return view('admin.slider.index', compact('sliders'));
    }


    public function addSlider()
    {


        return view('admin.slider.form_add_slider');
    }

    public function storeSlider(Request $request)
    {
        $validated = $request->validate(

            [

                'title' => 'required',
                'description' => 'required',
                'image' => 'required|unique:sliders|max:255',
            ],

            [

                'image.required' => 'silahkan isi formulir data anda!'

            ]
        );


        $image = $request->file('image');
        $generate_id = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

        Image::make($image)->resize(1920, 1000)->save('/slider/file/' . $generate_id);

        $last_img = '/slider/file/' . $generate_id;

        Slider::insert([

            'title' => $request->title,
            'description' => $request->description,
            'image' => $last_img,
            //karena dia carbonnya array hrs pake tanda koma
            'created_at' => Carbon::now(),

        ]);

        $image = $request->file('upload_image');
        $uploadPath = $this->storage->putFile('slider/file', $image);
        // dapetin path directory file
        $origin = str_replace('slider/file/', '', $uploadPath);
        $resize = Image::make($image)->resize(1920, 1000)->encode();
        // untuk memanggil resize
        $this->storage->put('slider/file/resize/' . $origin, $resize);

        Slider::insert([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $uploadPath,
            //karena dia carbonnya array hrs pake tanda koma
            'created_at' => Carbon::now(),
        ]);

        // arahkan ke route belum tentu kalau si back
        return redirect()->route('home.slider')->with('success', 'Data Image berhasil ditambahkan!');
    }
}
