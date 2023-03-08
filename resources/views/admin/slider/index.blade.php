<!-- Copy Indexnya -->

@extends('admin.admin_master')

@section('content')

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!--div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div>-->

        <div class="container">

            <div class="row">

                <a href="{{ route('add.slider') }}"> <button class="btn btn-info mb-3"> Add Slider</button></a>
                </br>


                <div class="col-md-12">

                    <!-- Tabel Boostrap -->

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Images</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>


                            @php($i = 1)
                            @foreach($sliders as $slider)
                            <tr>
                                <!-- ini untuk buat penomoran indexnya serial numbernya -->
                                <th scope="row">{{ $i++ }}</th>
                                <!--th scope="row">{{ $i++ }}</th>-->
                                <td>{{ $slider->title }}</td>
                                <!-- fungsi ini diganti dengan nama (tabelnya) image -->
                                <td>
                                    {{ $slider->description }}
                                </td>
                                <td>
                                    <img src="{{ $slider->thumbnail_url }}" style="width: 100px;">

                                </td>
                                <!-- ini untuk buat update data -->
                                <td>
                                    <a href="" class="btn btn-info"> Edit</a>
                                    <!-- ini untuk buat hapus datanya -->
                                    <a href="" class="btn btn-danger" onclick="return confirm('Yakin akan dihapus?')"> Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

            </div>

        </div>



    </div>
</div>


@endsection