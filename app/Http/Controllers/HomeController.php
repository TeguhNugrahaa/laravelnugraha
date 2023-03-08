<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\slider;


class HomeController extends Controller
{
    public function homeSlider()
    {

        $sliders = Slider::latest()->get();
        return view('admin.slider.index', compact('sliders'));
    }


    public function addSlider()
    {

        //$sliders = Slider::latest()->get();
        return view('admin.slider.form_add_slider');
    }

    public function storeSlider(Request $request)
    {
        //kalau mau request data ke server biasanya di debug dluw pakek try and catch
        $date = date('YmdHisgis'); //untuk membedakan nama filenya kita beri date
        try {
            $slider = new Slider;
            $slider->title = $request->title;
            $slider->description = $request->description;
            if ($request->hasFile('image')) {
                $request->file('image')->move('slider/file/', $date . $request->file('image')->getClientOriginalName());
                $slider->image = $date . $request->file('image')->getClientOriginalName();
            }

            $slider->save();
            return redirect()->route('home.slider')->with('success', 'Data Image berhasil ditambahkan!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('success', $th->getMessage());
        }
    }
}
