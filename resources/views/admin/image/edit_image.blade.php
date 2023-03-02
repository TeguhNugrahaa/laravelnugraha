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

                    <!-- Jika session ini sukses -->

                    @if(session('success'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>{{ session('success')}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <div class="card-header">

                        Edit Image
                    </div>
                    @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="{{ route('image.update', $images->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="card-body">
                            <!-- buat form control card body -->
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Image Name</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" name="image_name" placeholder="input name image" value="{{ $images->image_name }}">

                            </div>

                            <!-- buat form control card body -->

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Image</label>
                                <input type="file" class="form-control" id="exampleFormControlInput1" name="upload_image" value="{{ $images->image }}">

                            </div>

                            <!-- buat form control untuk munculkan gambarnya -->

                            <div class="mb-3">
                                <img src="{{ $images->thumbnail_url }}" style="width: 250px;">
                                <!-- buat aksinya untuk editnya -->


                            </div>

                            <button type="submit" class="btn btn-primary">Update Image</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>



    </div>
</div>
@endsection