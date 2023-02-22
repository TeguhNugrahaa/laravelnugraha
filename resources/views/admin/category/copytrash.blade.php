<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <!-- Ini untuk kategori trash-->
            List Trash Category
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

                        <!-- pesan alert untuk menghapus -->

                        @if(session('success'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>{{ session('success')}}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        <!-- Tabel Boostrap -->

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name Category</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>


                                <!--@php($i = 1)-->
                                @foreach($categories as $category)
                                <tr>
                                    <!-- ini untuk buat penomoran indexnya -->
                                    <th scope="row">{{ $categories->firstItem()+$loop->index }}</th>
                                    <!--th scope="row">{{ $i++ }}</th>-->
                                    <td>{{ $category->name_category }}</td>
                                    <!-- fungsi ini diganti dengan nama user (tabelnya)  dan user itu methodnya-->
                                    <td>{{ $category->user->name }}</td>
                                    <!-- fungsi ini diganti dengan nama user (tabelnya) -->
                                    <!-- td>{{ $category->user->name }}</td> -->
                                    <!-- fungsi ini diganti sama yang diatas -->
                                    <!--td>{{ $category->id_user }}</td>-->
                                    <td>
                                        @if($category->created_at == NULL)
                                        <p>Data Kosong</p>
                                        @else
                                        {{ Carbon\Carbon::parse($category->created_at)->diffForHumans() }}
                                        @endif
                                    </td>
                                    <!-- ini untuk buat update data -->
                                    <td>
                                        <!-- tambahkan satu buttonnya untuk restore dan copy urlnya -->
                                        <a href="{{ url('category/restore/'.$category->id) }}" class="btn btn-info">Restore</a>
                                        <a href="{{ url('category/pdelete/'.$category->id) }}" class="btn btn-danger"> Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $categories->links() }}

                    </div>

                    <div class="col-md-4">



                    </div>

                </div>

            </div>



        </div>
    </div>
</x-app-layout>