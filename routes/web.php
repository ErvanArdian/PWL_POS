<?php

use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\StokController;


Route::pattern('id', '[0-9]+'); //artinya ketika ada parameter {id}, maka harus berupa angka 

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postLogin']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');
Route::get('register', [AuthController::class, 'register']);
Route::post('register', [AuthController::class, 'store']);

Route::middleware(['auth'])->group(function() { //artinya semua route di dalam group ini harus login dulu 
//memasukkan semua route yang perlu autentikasi di sini.
    Route::get('/', function () {
        return view('welcome');
    });
    
    Route::get('/', [WelcomeController::class, 'index']);
    Route::get('/profile', [ProfileController::class, 'index']);
    Route::post('upload_foto', [ProfileController::class, 'upload_foto'])->name('upload.foto');
    Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('update.profile');

    
    Route::middleware(['authorize:ADM,MNG'])->group(function() {
        Route::get('/user', [UserController::class, 'index']);          //menampilkan halaman awal user
        Route::post('/user/list', [UserController::class, 'list']);      //menampilkan data user dalam bentuk json untuk databales
        Route::get('/user/create', [UserController::class, 'create']);   //menampilkan halaman form tambah user 
        Route::post('/user', [UserController::class, 'store']);         //menyimpan data user baru
        Route::get('/user/create_ajax', [UserController::class, 'create_ajax']);         //menampilkan  halaman form tambah user Ajax
        Route::post('/user/ajax', [UserController::class, 'store_ajax']);         //menyimpan data user baru Ajax
        Route::get('/user/{id}', [UserController::class, 'show']);       //menampilkan detail user
        Route::get('/user/{id}/edit', [UserController::class, 'edit']);  //menampilkan halaman form edit user  
        Route::put('/user/{id}', [UserController::class, 'update']);     //menyimpan perubahan data user 
        Route::get('/user/{id}/show_ajax', [UserController::class, 'show_ajax']);
        Route::get('/user/{id}/edit_ajax', [UserController::class, 'edit_ajax']);     //menampilkan halaman form edit user Ajax
        Route::put('/user/{id}/update_ajax', [UserController::class, 'update_ajax']);     //menyimpan perubahan data user Ajax
        Route::get('/user/{id}/delete_ajax', [UserController::class, 'confirm_ajax']);     // Untuk tampilkan form confirm delete user Ajax
        Route::delete('/user/{id}/delete_ajax', [UserController::class, 'delete_ajax']);     // Untuk hapus data user ajax
        Route::delete('/user/{id}', [UserController::class, 'destroy']); //menghapus data user 
        Route::get('/user/import', [UserController::class, 'import']); //ajax form upload data user 
        Route::post('/user/import_ajax', [UserController::class, 'import_ajax']); //ajax import excel data user 
        Route::get('/user/export_excel', [UserController::class, 'export_excel']); // ajax import excel
        Route::get('/user/export_pdf', [UserController::class, 'export_pdf']); // ajax export pdf
    });
    
    Route::middleware(['authorize:ADM,MNG'])->group(function () {
        Route::get('/supplier', [SupplierController::class, 'index']);          //menampilkan halaman awal untuk supplier
        Route::post('/supplier/list', [SupplierController::class, 'list']);      //menampilkan data supplier dalam bentuk json untuk databales
        Route::get('/supplier/create', [SupplierController::class, 'create']);   //menampilkan halaman form tambah supplier
        Route::post('/supplier', [SupplierController::class, 'store']);         //menyimpan data supplier baru
        Route::get('/supplier/create_ajax', [SupplierController::class, 'create_ajax']); // Menampilkan halaman form tambah supplier Ajax
        Route::post('/supplier/ajax', [SupplierController::class, 'store_ajax']);     // Menyimpan data supplier baru Ajax
        Route::get('/supplier/{id}', [SupplierController::class, 'show']);       //menampilkan detail supplier
        Route::get('/supplier/{id}/edit', [SupplierController::class, 'edit']);  //menampilkan halaman form edit supplier 
        Route::put('/supplier/{id}', [SupplierController::class, 'update']);     //menyimpan perubahan data supplier 
        Route::get('/supplier/{id}/show_ajax', [SupplierController::class, 'show_ajax']); // Menampilkan halaman detail supplier Ajax
        Route::get('/supplier/{id}/edit_ajax', [SupplierController::class, 'edit_ajax']); // Menampilkan halaman form edit supplier Ajax
        Route::put('/supplier/{id}/update_ajax', [SupplierController::class, 'update_ajax']); // Menyimpan perubahan data supplier Ajax
        Route::get('/supplier/{id}/delete_ajax', [SupplierController::class, 'confirm_ajax']); // Untuk menampilkan form supplier delete kategori Ajax
        Route::delete('/supplier/{id}/delete_ajax', [SupplierController::class, 'delete_ajax']); // Untuk menghapus data supplier  Ajax
        Route::delete('/supplier/{id}', [SupplierController::class, 'destroy']); //menghapus data supplier 
        Route::get('/supplier/import', [SupplierController::class, 'import']); //ajax form upload data supplier 
        Route::post('/supplier/import_ajax', [SupplierController::class, 'import_ajax']); //ajax import excel data supplier
        Route::get('/supplier/export_excel', [SupplierController::class, 'export_excel']); // ajax import excel
        Route::get('/supplier/export_pdf', [SupplierController::class, 'export_pdf']); // ajax export pdf
    });
    
    Route::middleware(['authorize:ADM,CST,STF,KSR'])->group(function () {
        Route::get('/kategori', [KategoriController::class, 'index']);          //menampilkan halaman awal kategori
        Route::post('/kategori/list', [KategoriController::class, 'list']);      //menampilkan data kategori dalam bentuk json untuk databales
        Route::get('/kategori/create', [KategoriController::class, 'create']);   //menampilkan halaman form tambah kategori 
        Route::post('/kategori', [KategoriController::class, 'store']);         //menyimpan data kategori baru
        Route::get('/kategori/create_ajax', [KategoriController::class, 'create_ajax']);  //Menampilkan halaman form tambah kategori ajax
        Route::post('/kategori/ajax', [KategoriController::class, 'store_ajax']);         //menyimpan data kategori baru Ajax
        Route::get('/kategori/{id}', [KategoriController::class, 'show']);       //menampilkan detail kategori
        Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit']);  //menampilkan halaman form edit kategori  
        Route::put('/kategori/{id}', [KategoriController::class, 'update']);     //menyimpan perubahan data kategori 
        Route::get('/kategori/{id}/show_ajax', [KategoriController::class, 'show_ajax']); // Menampilkan halaman detail kategori
        Route::get('/kategori/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']); // Menampilkan halaman form edit kategori Ajax
        Route::put('/kategori/{id}/update_ajax', [KategoriController::class, 'update_ajax']); // Menyimpan perubahan data kategori Ajax
        Route::get('/kategori/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']); // Untuk menampilkan form konfirmasi delete kategori Ajax
        Route::delete('/kategori/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']); // Untuk menghapus data kategori  Ajax
        Route::delete('/kategori/{id}', [KategoriController::class, 'destroy']); //menghapus data kategori 
        Route::get('/kategori/import', [KategoriController::class, 'import']); //ajax form upload data kategori
        Route::post('/kategori/import_ajax', [KategoriController::class, 'import_ajax']); //ajax import excel data kategori
        Route::get('/kategori/export_excel', [KategoriController::class, 'export_excel']); // ajax import excel
        Route::get('/kategori/export_pdf', [KategoriController::class, 'export_pdf']); // ajax export pdf
    });
    
    Route::middleware(['authorize:ADM,MNG,STF,KSR'])->group(function () {
        Route::get('/barang', [BarangController::class, 'index']);          //menampilkan halaman awal barang
        Route::post('/barang/list', [BarangController::class, 'list']);      //menampilkan data barang dalam bentuk json untuk databales
        Route::get('/barang/create', [BarangController::class, 'create']);   //menampilkan halaman form tambah barang
        Route::post('/barang', [BarangController::class, 'store']);         //menyimpan data barang baru
        Route::get('/barang/create_ajax', [BarangController::class, 'create_ajax']); // Menampilkan halaman form tambah barang Ajax
        Route::post('/barang/ajax', [BarangController::class, 'store_ajax']);     // Menyimpan data barang baru Ajax
        Route::get('/barang/{id}', [BarangController::class, 'show']);       //menampilkan detail barang
        Route::get('/barang/{id}/edit', [BarangController::class, 'edit']);  //menampilkan halaman form edit barang 
        Route::put('/barang/{id}', [BarangController::class, 'update']);     //menyimpan perubahan data barang 
        Route::get('/barang/{id}/show_ajax', [BarangController::class, 'show_ajax']); // Menampilkan halaman detail supplier Ajax
        Route::get('/barang/{id}/edit_ajax', [BarangController::class, 'edit_ajax']); // Menampilkan halaman form edit barang Ajax
        Route::put('/barang/{id}/update_ajax', [BarangController::class, 'update_ajax']); // Menyimpan perubahan data barang Ajax
        Route::get('/barang/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']); // Untuk menampilkan form barang delete barang Ajax
        Route::delete('/barang/{id}/delete_ajax', [BarangController::class, 'delete_ajax']); // Untuk menghapus data barang  Ajax
        Route::delete('/barang/{id}', [BarangController::class, 'destroy']); //menghapus data barang 
        Route::get('/barang/import', [BarangController::class, 'import']); // Ajax form upload excel
        Route::post('/barang/import_ajax', [BarangController::class, 'import_ajax']); // Ajax import excel
        Route::get('/barang/export_excel', [BarangController::class, 'export_excel']); // export excel
        Route::get('/barang/export_pdf', [BarangController::class, 'export_pdf']); // export pdf
        Route::get('/barang/export_excel', [BarangController::class, 'export_excel']); // ajax import excel
    });

    Route::middleware(['authorize:ADM'])->group(function () {
        Route::get('/level', [LevelController::class, 'index']);         // menampilkan halaman awal level
        Route::post('/level/list', [LevelController::class, 'list']);     // menampilkan data level dalam bentuk json untuk datatables
        Route::get('/level/create', [LevelController::class, 'create']);  // menampilkan halaman form tambah level
        Route::post('/level', [LevelController::class, 'store']);        // menyimpan data level baru
        Route::get('/level/create_ajax', [LevelController::class, 'create_ajax']); // Menampilkan halaman form tambah user Ajax
        Route::post('/level/ajax', [LevelController::class, 'store_ajax']);     // Menyimpan data user baru Ajax
        Route::get('/level/{id}', [LevelController::class, 'show']);      // menampilkan detail level
        Route::get('/level/{id}/edit', [LevelController::class, 'edit']); // menampilkan halaman form edit level
        Route::put('/level/{id}', [LevelController::class, 'update']);    // menyimpan perubahan data level
        Route::get('/level/{id}/show_ajax', [LevelController::class, 'show_ajax']); // Menampilkan halaman detail level
        Route::get('/level/{id}/edit_ajax', [LevelController::class, 'edit_ajax']); // Menampilkan halaman form edit level Ajax
        Route::put('/level/{id}/update_ajax', [LevelController::class, 'update_ajax']); // Menyimpan perubahan data level Ajax
        Route::get('/level/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']); // Untuk menampilkan form konfirmasi delete level Ajax
        Route::delete('/level/{id}/delete_ajax', [LevelController::class, 'delete_ajax']); // Untuk menghapus data level Ajax
        Route::delete('/level/{id}', [LevelController::class, 'destroy']); // menghapus data level
        Route::get('/level/import', [LevelController::class, 'import']); //ajax form upload data level
        Route::post('/level/import_ajax', [LevelController::class, 'import_ajax']); //ajax import excel data level 
        Route::get('/level/export_excel', [LevelController::class, 'export_excel']); // ajax import excel
        Route::get('/level/export_pdf', [LevelController::class, 'export_pdf']); // ajax export pdf
    });


    Route::middleware(['authorize:ADM'])->group(function () {
        Route::get('/penjualan', [PenjualanController::class, 'index']);         // menampilkan halaman awal Penjualan
        Route::post('/penjualan/list', [PenjualanController::class, 'list']);     // menampilkan data Penjualan dalam bentuk json untuk datatables
        Route::get('/penjualan/create', [PenjualanController::class, 'create']);  // menampilkan halaman form tambah Penjualan
        Route::post('/penjualan', [PenjualanController::class, 'store']);        // menyimpan data Penjualan baru
        Route::get('/penjualan/create_ajax', [PenjualanController::class, 'create_ajax']); // Menampilkan halaman form tambah user Ajax
        Route::post('/penjualan/ajax', [PenjualanController::class, 'store_ajax']);     // Menyimpan data user baru Ajax
        Route::get('/penjualan/{id}', [PenjualanController::class, 'show']);      // menampilkan detail Penjualan
        Route::get('/penjualan/{id}/edit', [PenjualanController::class, 'edit']); // menampilkan halaman form edit Penjualan
        Route::put('/penjualan/{id}', [PenjualanController::class, 'update']);    // menyimpan perubahan data Penjualan
        Route::get('/penjualan/{id}/show_ajax', [PenjualanController::class, 'show_ajax']); // Menampilkan halaman detail Penjualan
        Route::get('/penjualan/{id}/edit_ajax', [PenjualanController::class, 'edit_ajax']); // Menampilkan halaman form edit Penjualan Ajax
        Route::put('/penjualan/{id}/update_ajax', [PenjualanController::class, 'update_ajax']); // Menyimpan perubahan data Penjualan Ajax
        Route::get('/penjualan/{id}/delete_ajax', [PenjualanController::class, 'confirm_ajax']); // Untuk menampilkan form konfirmasi delete Penjualan Ajax
        Route::delete('/penjualan/{id}/delete_ajax', [PenjualanController::class, 'delete_ajax']); // Untuk menghapus data Penjualan Ajax
        Route::delete('/penjualan/{id}', [PenjualanController::class, 'destroy']); // menghapus data Penjualan
        Route::get('/penjualan/import', [PenjualanController::class, 'import']); //ajax form upload data Penjualan
        Route::post('/penjualan/import_ajax', [PenjualanController::class, 'import_ajax']); //ajax import excel data Penjualan 
        Route::get('/penjualan/export_excel', [PenjualanController::class, 'export_excel']); // ajax import excel
        Route::get('/penjualan/export_pdf', [PenjualanController::class, 'export_pdf']); // ajax export pdf
    });

    Route::group(['prefix' =>'stok', 'middleware'=>'authorize:ADM'],function() {
        Route::get('/', [StokController::class, 'index']);         
        Route::post('/list', [StokController::class, 'list']);
        Route::get('/create_ajax', [StokController::class, 'create_ajax']);
        Route::post('/ajax', [StokController::class, 'store_ajax']);
        Route::get('/{id}/show_ajax', [StokController::class, 'show_ajax']);
        Route::get('/{id}/edit_ajax', [StokController::class, 'edit_ajax']);
        Route::put('/{id}/update_ajax', [StokController::class, 'update_ajax']);
        Route::get('/{id}/delete_ajax', [StokController::class, 'confirm_ajax']);
        Route::delete('/{id}/delete_ajax', [StokController::class, 'delete_ajax']);
        Route::get('/import', [StokController::class, 'import']);
        Route::post('/import_ajax', [StokController::class, 'import_ajax']);
        Route::get('/export_excel', [StokController::class, 'export_excel']);
        Route::get('/export_pdf', [StokController::class, 'export_pdf']);
    });
});