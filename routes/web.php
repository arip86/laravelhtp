<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController; //panggil controller yang ada dibuat sebelumnya
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\PelatihanController;
use App\Http\Controllers\PendaftaranController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//route untuk halaman depan

Route::get('/', function () {
    return view('front');

});

//group untuk isi pelatihan
Route::group(['middleware' => ['auth']], function(){
Route::get('/pelatihan', [PelatihanController::class, 'index']);
Route::post('/pelatihan-store', [PelatihanController::class, 'store']);
});

Route::get ('/salam', function(){
    return "Selamat pagi";
}); // ini adalah routing untuk pemanggilan dirinya sendiri
Route::get('/ucapan', function(){
    return view('ucapan'); //ini adalah routing yang mengarahkan ke view yang ada di folder 
    //resources/views
});
Route::get('/nilai', function(){
    return view('nilai');
}); //arahkan return nilai ke file nilai yang ada di view 
Route::get('/daftar_nilai', function(){
    return view('daftar_nilai');
});
//mengarahkan routing ke controller
Route::get('/siswa', [SiswaController::class, 'dataSiswa']);
//mengarahkan ke controller dashboardController
//prefix atau group

Route::group(['middleware' => ['auth', 'peran:admin-manajer-staff']], function(){
    Route::prefix('admin')->name('admin.')->group(function(){
    
Route::get('/dashboard', [DashboardController::class, 'index'])->name('index');
Route::get('/staff', [StaffController::class, 'index']);
//ini adalah route untuk pegawai
Route::get('/pegawai',[PegawaiController::class, 'index']);
Route::get('/pegawai/create', [PegawaiController::class, 'create']);
Route::post('/pegawai/store', [PegawaiController::class, 'store']);
Route::get('/pegawai/edit/{id}', [PegawaiController::class, 'edit']);
Route::post('/pegawai/update', [PegawaiController::class, 'update']);
Route::get('/pegawai/show/{id}', [PegawaiController::class, 'show']);
Route::get('/pegawai/delete/{id}', [PegawaiController::class, 'destroy']);
Route::get('generate-pdf', [PegawaiController::class, 'generatePDF']);
Route::get('/pegawai/pegawaiPDF', [PegawaiController::class, 'pegawaiPDF']);
Route::get('/pegawai/exportexcel/', [PegawaiController::class, 'exportExcel']);
Route::post('/pegawai/importexcel', [PegawaiController::class, 'importExcel']);


//ini adalah route untuk divisi
Route::get('/divisi', [DivisiController::class, 'index']);
Route::get('/divisi/create', [DivisiController::class, 'create']);
Route::post('/divisi/store', [DivisiController::class, 'store']);
Route::get('/divisi/edit/{id}', [DivisiController::class, 'edit']);
Route::post('/divisi/update', [DivisiController::class, 'update']);
Route::get('/divisi/show/{id}', [DivisiController::class, 'show']);
Route::get('/divisi/delete/{id}', [DivisiController::class, 'destroy']);


//ini adalah routing untuk jabatan
Route::get('/jabatan', [JabatanController::class, 'index']);
Route::get('/jabatan/create', [JabatanController::class, 'create']);
Route::post('/jabatan/store', [JabatanController::class, 'store']);
Route::get('/jabatan/edit/{id}', [JabatanController::class, 'edit']);
Route::post('/jabatan/update', [JabatanController::class, 'update']);


//ini adalah routing untuk dashboard
//ini adalah route untuk user
Route::get('/user', [UserController::class, 'index']);


Route::get('/pendaftar', [PendaftaranController::class, 'index']);

});
});
//nantinya pegawai tersebut mengambil pelatihan dan pada table pelatihan bertambah

Auth::routes();
Route::get('/after_register', function(){
    return view ('after_register');
});
// Route::get('/acces_denied2', function(){
//     return view ('admin/accesdenied');
// });
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/pegawaiapi', [PegawaiController::class, 'apiPegawai']);
Route::get('/pegawaiapi/{id}', [PegawaiController::class, 'apiPegawaiDetail']);