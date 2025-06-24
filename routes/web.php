<?php

use Illuminate\Support\Facades\Route;
use App\Models\Periksa;
use App\Models\DetailPeriksa;
use App\Models\Obat;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('auth.login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'storeAkun'])->name('auth.register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout.post');

Route::get('/403', function () {
    return view('error.403');
})->name('auth.denied');



Route::middleware('auth')->group(function () {
    Route::middleware('role:dokter')->group(function () {
    //dokter
        Route::get('/dokter', [DokterController::class, 'dashboardDokter'])->name('dokter.dashboard');

        Route::get('/dokter/jadwalPeriksa', [DokterController::class, 'showJadwalPeriksa'])->name('dokter.jadwalperiksa');
        Route::get('/dokter/jadwalPeriksa/add', [DokterController::class, 'addJadwalPeriksa'])->name('dokter.jadwalperiksaAdd');
        Route::post('/dokter/jadwalPeriksa', [DokterController::class, 'storeJadwalPeriksa'])->name('dokter.jadwalperiksaStore');
        Route::get('/dokter/jadwalPeriksa/edit/{id}', [DokterController::class, 'editJadwalPeriksa'])->name('dokter.jadwalperiksaEdit');
        Route::put('/dokter/jadwalPeriksa/update/{id}', [DokterController::class, 'updateJadwalPeriksa'])->name('dokter.jadwalperiksaUpdate');

        Route::get('/dokter/profile', [DokterController::class, 'showProfile'])->name('dokter.profile');
        Route::put('/dokter/profile', [DokterController::class, 'profileUpdate'])->name('dokter.profileUpdate');
     
        Route::get('/dokter/polis', [DokterController::class, 'showPeriksa'])->name('dokter.polis');
        Route::get('/dokter/periksa/{id_poli}', [DokterController::class, 'showFormPeriksa'])->name('dokter.periksa');
        Route::post('/dokter/periksa', [DokterController::class, 'periksaStore'])->name('dokter.periksaStore');
        Route::get('/dokter/periksa/edit/{id}', [DokterController::class, 'editPeriksa'])->name('dokter.periksaEdit');
        Route::post('/dokter/periksa/update/{id}', [DokterController::class, 'updatePeriksa'])->name('dokter.periksaUpdate'); // untuk periksa pasien
        Route::put('/dokter/periksa/update/{id}', [DokterController::class, 'updatePeriksa2'])->name('dokter.periksaUpdate2'); // untuk edit periksa pasien

        Route::get('/dokter/riwayatPasien', [DokterController::class, 'showRiwayatPasien'])->name('dokter.riwayatPasien');
        Route::get('/dokter/pasien/{id}/detail', [DokterController::class, 'showPasienDetail'])->name('dokter.pasien.detail');
        
        
       
    });

    Route::middleware('role:pasien')->group(function () {

            //pasien
        Route::get('/pasien', [PasienController::class, 'dashboardPasien'])->name('pasien.dashboard');
        Route::get('/pasien/riwayat', [PasienController::class, 'showPeriksas'])->name('pasien.riwayat');
        // Route::get('/pasien/periksa', [PasienController::class, 'showPoli'])->name('pasien.periksa');
        // Route::post('/pasien/periksa', [PasienController::class, 'storePoli'])->name('pasien.periksa.store');
        Route::get('/pasien/daftar-poli', [PasienController::class, 'index'])->name('pasien.daftar-poli');
        Route::get('/pasien/daftar-poli/show-poli', [PasienController::class, 'showPoli'])->name('pasien.show-poli');
        Route::post('/pasien/daftar-poli', [PasienController::class, 'store'])->name('pasien.daftar-poli.store');
    
    });

    Route::middleware('role:admin')->group(function () {

        Route::get('/admin', [AdminController::class, 'dashboardAdmin'])->name('admin.dashboard');
        Route::get('/admin/obat', [AdminController::class, 'showObat'])->name('admin.obat');
        Route::post('/admin/obat', [AdminController::class, 'storeObat'])->name('admin.obatStore');
        Route::get('/admin/obat/edit/{id}', [AdminController::class, 'editObat'])->name('admin.obatEdit');
        Route::put('/admin/obat/update/{id}', [AdminController::class, 'updateObat'])->name('admin.obatUpdate');
        Route::delete('/admin/obat/delete/{id}', [AdminController::class, 'destroyObat'])->name('admin.obatDelete');

        Route::get('/admin/poli', [AdminController::class, 'showPoli'])->name('admin.poli');
        Route::post('/admin/poli', [AdminController::class, 'storePoli'])->name('admin.poliStore');
        Route::get('/admin/poli/edit/{id}', [AdminController::class, 'editPoli'])->name('admin.poliEdit');
        Route::put('/admin/poli/update/{id}', [AdminController::class, 'updatePoli'])->name('admin.poliUpdate');
        Route::delete('/admin/poli/delete/{id}', [AdminController::class, 'destroyPoli'])->name('admin.poliDelete');

        Route::get('/admin/pasien', [AdminController::class, 'showPasien'])->name('admin.pasien');
        Route::post('/admin/pasien', [AdminController::class, 'storePasien'])->name('admin.pasienStore');
        Route::get('/admin/pasien/edit/{id}', [AdminController::class, 'editPasien'])->name('admin.pasienEdit');
        Route::put('/admin/pasien/update/{id}', [AdminController::class, 'updatePasien'])->name('admin.pasienUpdate');
        Route::delete('/admin/pasien/delete/{id}', [AdminController::class, 'destroyPasien'])->name('admin.pasienDelete');

        Route::get('/admin/dokter', [AdminController::class, 'showDokter'])->name('admin.dokter');
        Route::post('/admin/dokter', [AdminController::class, 'storeDokter'])->name('admin.dokterStore');
        Route::get('/admin/dokter/edit/{id}', [AdminController::class, 'editDokter'])->name('admin.dokterEdit');
        Route::put('/admin/dokter/update/{id}', [AdminController::class, 'updateDokter'])->name('admin.dokterUpdate');
        Route::delete('/admin/dokter/delete/{id}', [AdminController::class, 'destroyDokter'])->name('admin.dokterDelete');
    
    });



// Route::get('/pasien/riwayat/{id}', [PasienController::class, 'showDetailPeriksa'])->name('pasien.riwayatDetail');
    
});

        




      





