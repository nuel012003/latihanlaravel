<?php


use App\Http\Controllers\AuthController as AuthControllerAlias;
use App\Http\Controllers\DashboardController as DashboardControllerAlias;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Models\Berita;
/*

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get("/", [HomeController::class,'index'])->name('home.index');
Route::get("/berita/{id}", [HomeController::class,'detailBerita'])->name('home.detailBerita');
Route::get("/page/{id}", [HomeController::class,'detailPage'])->name('home.detailPage');
Route::get("/berita", [HomeController::class,'semuaBerita'])->name('home.berita');


Route::get('/login', [AuthControllerAlias::class, 'index'])->name('auth.index')->middleware('guest');
Route::post('/login', [AuthControllerAlias::class, 'Verify'])->name('auth.verify');

Route::group(['middleware' => 'auth:user'], function () {
    Route::prefix('admin')->group(function (){
        Route::get('/', [DashboardControllerAlias::class, 'index'])->name('dashboard.index');
        Route::get('/profile', [DashboardControllerAlias::class, 'profile'])->name('dashboard.profile');
        Route::get('/reset-password', [DashboardControllerAlias::class, 'resetPassword'])->name('dashboard.resetPassword');
        Route::post('/reset-password', [DashboardControllerAlias::class, 'prosesResetPassword'])->name('dashboard.prosesResetPassword');

        Route::get('/kategori',[App\Http\Controllers\KategoriController::class, 'index'])->name('kategori.index');
        Route::get('/kategori/tambah',[App\Http\Controllers\KategoriController::class, 'tambah'])->name('kategori.tambah');
        Route::post('/kategori/prosesTambah',[App\Http\Controllers\KategoriController::class, 'prosesTambah'])->name('kategori.prosesTambah');
        Route::get('/kategori/ubah/{id}',[App\Http\Controllers\KategoriController::class, 'ubah'])->name('kategori.ubah');
        Route::post('/kategori/prosesUbah',[App\Http\Controllers\KategoriController::class, 'prosesUbah'])->name('kategori.prosesUbah');
        Route::get('/kategori/hapus/{id}',[App\Http\Controllers\KategoriController::class, 'hapus'])->name('kategori.hapus');
        Route::get('/kategori/export-pdf',[App\Http\Controllers\KategoriController::class, 'exportPdf'])->name('kategori.exportPdf');

        Route::get('/berita',[App\Http\Controllers\BeritaController::class, 'index'])->name('berita.index');
        Route::get('/berita/tambah',[App\Http\Controllers\BeritaController::class, 'tambah'])->name('berita.tambah');
        Route::post('/berita/prosesTambah',[App\Http\Controllers\BeritaController::class, 'prosesTambah'])->name('berita.prosesTambah');
        Route::get('/berita/ubah/{id}',[App\Http\Controllers\BeritaController::class, 'ubah'])->name('berita.ubah');
        Route::post('/berita/prosesUbah',[App\Http\Controllers\BeritaController::class, 'prosesUbah'])->name('berita.prosesUbah');
        Route::get('/berita/hapus/{id}',[App\Http\Controllers\BeritaController::class, 'hapus'])->name('berita.hapus');

        Route::get('/user',[App\Http\Controllers\UserController::class, 'index'])->name('user.index');
        Route::get('/user/tambah',[App\Http\Controllers\UserController::class, 'tambah'])->name('user.tambah');
        Route::post('/user/prosesTambah',[App\Http\Controllers\UserController::class, 'prosesTambah'])->name('user.prosesTambah');
        Route::get('/user/ubah/{id}',[App\Http\Controllers\UserController::class, 'ubah'])->name('user.ubah');
        Route::post('/user/prosesUbah',[App\Http\Controllers\UserController::class, 'prosesUbah'])->name('user.prosesUbah');
        Route::get('/user/hapus/{id}',[App\Http\Controllers\UserController::class, 'hapus'])->name('user.hapus');

        Route::get('/page',[App\Http\Controllers\PageController::class, 'index'])->name('page.index');
        Route::get('/page/tambah',[App\Http\Controllers\PageController::class, 'tambah'])->name('page.tambah');
        Route::post('/page/prosesTambah',[App\Http\Controllers\PageController::class, 'prosesTambah'])->name('page.prosesTambah');
        Route::get('/page/ubah/{id}',[App\Http\Controllers\PageController::class, 'ubah'])->name('page.ubah');
        Route::post('/page/prosesUbah',[App\Http\Controllers\PageController::class, 'prosesUbah'])->name('page.prosesUbah');
        Route::get('/page/hapus/{id}',[App\Http\Controllers\PageController::class, 'hapus'])->name('page.hapus');
        Route::get('/page/export-pdf',[App\Http\Controllers\PageController::class, 'exportPdf'])->name('page.exportPdf');

        Route::get('/menu',[App\Http\Controllers\MenuController::class, 'index'])->name('menu.index');
        Route::get('/menu/tambah',[App\Http\Controllers\MenuController::class, 'tambah'])->name('menu.tambah');
        Route::post('/menu/prosesTambah',[App\Http\Controllers\MenuController::class, 'prosesTambah'])->name('menu.prosesTambah');
        Route::get('/menu/ubah/{id}',[App\Http\Controllers\MenuController::class, 'ubah'])->name('menu.ubah');
        Route::post('/menu/prosesUbah',[App\Http\Controllers\MenuController::class, 'prosesUbah'])->name('menu.prosesUbah');
        Route::get('/menu/hapus/{id}',[App\Http\Controllers\MenuController::class, 'hapus'])->name('menu.hapus');
        Route::get('/menu/order/{idMenu}/{idSwap}',[App\Http\Controllers\MenuController::class, 'order'])->name('menu.order');

    });

    Route::get('/logout', [AuthControllerAlias::class, 'logout'])->name('auth.logout');
});

Route::get('files/{filename}', function ($filename) {
    $path = storage_path('app/public/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
})->name('storage');

