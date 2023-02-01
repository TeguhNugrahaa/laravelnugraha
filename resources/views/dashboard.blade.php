<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

            <!-- Ini untuk memanggil nama user -->

            Hi...<b>{{ Auth::user()->name }}</b>

            <!-- Ini untuk memanggil nama user yang arah ke kanan -->

            <b style="float:right;">Total Users : {{ count($users) }}</b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!--div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div>-->

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
                    @foreach($users as $user)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <!-- Pemanggilan diffForHumans di fungsi Carbon -->
                        <td>{{ Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</td>
                        <!--td>{{ \Carbon\Carbon::parse($user->created_at)->format("d F Y") }}</td>-->



                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>