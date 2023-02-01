<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <!-- Ini untuk judul kategori-->
            All Category
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
                                    <th scope="col">Nama</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row"></th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
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
                        <div class="card-header">

                            Add Category
                        </div>
                        <form action="{{ route('store.category') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <!-- buat form control card body -->
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Name Category</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" name="name_category" placeholder="input name category">

                                    @error('name_category')

                                    {{ $message }}
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Add Category</button>
                            </div>
                        </form>
                    </div>

                </div>

            </div>



        </div>
    </div>
</x-app-layout>