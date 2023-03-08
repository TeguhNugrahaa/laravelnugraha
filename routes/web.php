<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\HomeController;


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


// Kalo begini dengan cara home compact dengan ImageControllernya

Route::get('/', function () {
    $images = DB::table('images')->get();
    return view('home', compact('images'));
});

//Kalo ini untuk view home fungstion di ImageControllernya Versi kedua
//Route::get('/', [ImageController::class, 'home'])->name('home');



// ini nanti di arahkan di bagian home frontend yang tadi sudah di copykan

// dan lokasi route ini berada di layouts.master_home

//Route::get('/', function () {
//return view('layouts.master_home');
//});

// kalo ini berasalnya dari view home homeblade.php dan buat variabelnya

//Route::get('/', function () {

//$images = DB::table('images')->get();
//return view('home', compact('images'));
//});


// kalo ini berasalnya dari view welcome.blade.php

//Route::get('/', function () {
//return view('welcome');
//});


Route::get('/home', function () {
    return view('home');
});




Route::get('/about', [AboutController::class, 'index'])->name('tentang');
Route::get('/contact', [ContactController::class, 'index']);


/* buat route untuk masuk ke all category */
Route::get('/all/category', [CategoryController::class, 'index'])->name('all.category');

/* buat route post add, methodnya addCategory untuk masuk ke store category */

Route::post('/category/add', [CategoryController::class, 'addCategory'])->name('store.category');

/* buat route untuk edit category */
Route::get('/category/edit/{id}', [CategoryController::class, 'editCategory']);
/* buat route untuk update category */
Route::post('/category/update/{id}', [CategoryController::class, 'updateCategory']);


/* buat route untuk trush delete category */

Route::get('/trash/category', [CategoryController::class, 'trashCategory'])->name('trash.category');

/* buat route untuk soft delete category */

Route::get('/category/soft/delete/{id}', [CategoryController::class, 'softDelete']);

/* buat route untuk restore category */

Route::get('/category/restore/{id}', [CategoryController::class, 'restoreCat']);

/* buat route untuk delete category */

Route::get('/category/pdelete/{id}', [CategoryController::class, 'permanentDelete']);

/* buat route imagenya */
Route::get('/all/image', [ImageController::class, 'index'])->name('all.image');

/* buat route imagenya untuk postnya */

Route::post('/add/image/', [ImageController::class, 'addImage'])->name('add.image');

/* buat route imagenya untuk edit */
Route::get('/edit/image/{id}', [ImageController::class, 'editImage'])->name('image.edit');

/* buat route imagenya untuk update */
Route::post('/update/image/{id}', [ImageController::class, 'updateImage'])->name('image.update');

/* buat route imagenya untuk hapus image */
Route::get('/delete/image/{id}', [ImageController::class, 'deleteImage'])->name('image.destroy');

/* buat route untuk multiple image */
Route::get('/multi/pic/', [ImageController::class, 'multiPic'])->name('multi.pic');

/* buat route post untuk multiple image */
Route::post('/multi/add/', [ImageController::class, 'multiAdd'])->name('multi.add');

/* buat route untuk multiple image delete*/
Route::get('/delete/multi/{id}', [ImageController::class, 'deleteMulti'])->name('multi.destroy');


/* buat route untuk admin slider */
Route::get('/home/slider/', [HomeController::class, 'homeSlider'])->name('home.slider');

/* buat route untuk add slider */

Route::get('/add/slider/', [HomeController::class, 'addSlider'])->name('add.slider');

/* buat route untuk store slider */

// Route::post('/store/slider', [HomeController::class, 'storeSlider'])->name('store.slider');
Route::post('/store/slider', [HomeController::class, 'storeSlider'])->name('store.slider');







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


        // kalau untuk untuk menyambungkan tabel user di database
        //$users = DB::table('users')->select('*')->get();

        //dd($users->all());

        // return untuk adminnya 
        return view('admin.index');

        // kalau versi ini untuk dashboard user (versi ke 2)
        //return view('dashboard', compact('users'));

    })->name('dashboard');
});



// Menampilkan route untuk logout jetstream
Route::get('/user/logout/', [ImageController::class, 'logout'])->name('user.logout');





/*Route::get('/dashboard', function () {
    return view('dashboard');
/*})->middleware(['auth'])->name('dashboard');

/*require __DIR__ . '/auth.php';
