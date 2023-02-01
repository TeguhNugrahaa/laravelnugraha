<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;


use App\Models\User;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});




Route::get('/about', [AboutController::class, 'index'])->name('tentang');
Route::get('/contact', [ContactController::class, 'index']);


/* buat route untuk masuk ke all category */
Route::get('/all/category', [CategoryController::class, 'index'])->name('all.category');

/* buat route post add, methodnya addCategory untuk masuk ke store category */

Route::post('/category/add', [CategoryController::class, 'addCategory'])->name('store.category');




Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'

])->group(function () {
    Route::get('/dashboard', function () {

        /* Lokasi untuk manggil si Usernya pake Eloqment ORM Get Data */
        //$users = User::all();


        /* Lokasi untuk manggil si Usernya pake Query Builder */
        //$users = DB::table('users')->select->get();

        $users = DB::table('users')->select('*')->get();

        //dd($users->all());

        return view('dashboard', compact('users'));
    })->name('dashboard');
});


/*Route::get('/dashboard', function () {
    return view('dashboard');
/*})->middleware(['auth'])->name('dashboard');

/*require __DIR__ . '/auth.php';
