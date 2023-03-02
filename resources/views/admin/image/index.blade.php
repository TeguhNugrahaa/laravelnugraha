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

                <div class="col-md-8">

                    <!-- Tabel Boostrap -->

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Image Name</th>
                                <th scope="col">Image</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>


                            <!--@php($i = 1)-->
                            @foreach($images as $image)
                            <tr>
                                <!-- ini untuk buat penomoran indexnya serial numbernya -->
                                <th scope="row">{{ $images->firstItem()+$loop->index }}</th>
                                <!--th scope="row">{{ $i++ }}</th>-->
                                <td>{{ $image->image_name }}</td>
                                <!-- fungsi ini diganti dengan nama (tabelnya) image -->
                                <td>
                                    <img src="{{ $image->thumbnail_url }}" style="width: 100px;">
                                </td>
                                <td>
                                    @if($image->created_at == NULL)
                                    <p>Data Kosong</p>
                                    @else
                                    {{ Carbon\Carbon::parse($image->created_at)->diffForHumans() }}
                                    @endif
                                </td>
                                <!-- ini untuk buat update data -->
                                <td>
                                    <a href="{{ url('edit/image/'.$image->id) }}" class="btn btn-info"> Edit</a>
                                    <!-- ini untuk buat hapus datanya -->
                                    <a href="{{ url('delete/image/'.$image->id) }}" class="btn btn-danger" onclick="return confirm('Yakin akan dihapus?')"> Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $images->links() }}

                </div>

                <div class="col-md-4">

                    <!-- Jika session ini sukses -->

                    @if(session('success'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>{{ session('success')}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <div class="card-header">

                        Add Images
                    </div>
                    <form action="{{ route('add.image') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <!-- buat form control card body -->
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Image Name</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" name="image_name" placeholder="input name image">

                                @error('image_name')

                                {{ $message }}
                                @enderror
                            </div>

                            <!-- buat form control card body -->
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Image</label>
                                <input type="file" class="form-control" id="exampleFormControlInput1" name="upload_image" placeholder="input name category">

                                @error('image')

                                {{ $message }}
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Add Image</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>



    </div>
</div>

@endsection