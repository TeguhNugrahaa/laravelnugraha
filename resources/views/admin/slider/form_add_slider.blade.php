<!-- Copy Indexnya -->

@extends('admin.admin_master')

@section('content')


<div class="py-12">
    <h3> Form add Slider</h3>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!--div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div>-->

        <div class="container">
            <div class="row">


                <div class="col-md-9">

                    <!-- Jika session ini sukses -->

                    @if(session('success'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>{{ session('success')}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <div class="card-header">

                        Add Slider
                    </div>
                    <form action="{{ route('store.slider') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <!-- buat form control card body -->
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Title</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" name="title" placeholder="input name title">

                                @error('image_name')

                                {{ $message }}
                                @enderror
                            </div>



                            <!-- buat form control card body -->
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Description</label>
                                <textarea class="form-control" name="description"> </textarea>

                                @error('image_name')

                                {{ $message }}
                                @enderror
                            </div>



                            <!-- buat form control card body -->
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Image</label>
                                <input type="file" class="form-control" id="exampleFormControlInput1" name="image">

                                @error('image')

                                {{ $message }}
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>

    </div>
</div>



@endsection