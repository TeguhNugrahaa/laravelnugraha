<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <!-- Ini untuk judul kategori dan untuk melemparkan link trash-->
            Multi Picture
        </h2>
    </x-slot>

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
                                    <th scope="col">Image</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($images as $i => $image)
                                <tr>
                                    <!-- ini untuk buat penomoran indexnya serial numbernya -->
                                    <td scope="row">{{ ($i+1) }}</td>

                                    <!-- fungsi ini diganti dengan nama (tabelnya) image -->
                                    <td>
                                        <img src="{{ $image->image_url }}" style="width: 200px;">
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
                                        <!-- ini untuk buat hapus datanya -->
                                        <a href="{{ route('multi.destroy', $image->id) }}" class="btn btn-danger" onclick="return confirm('Yakin akan dihapus?')"> Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-4">

                        <!-- Jika session ini sukses -->

                        @if(session('success'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>{{ session('success')}}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        <div class="card">
                            <div class="card-header">

                                Add multiPic
                            </div>
                            <form action="{{ route('multi.add') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">

                                    <!-- buat form control card body -->
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Picture</label>
                                        <input type="file" class="form-control" id="exampleFormControlInput1" name="upload_images[]" multiple="">

                                        @error('image')

                                        {{ $message }}
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">Add Picture</button>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>



            </div>
        </div>
</x-app-layout>