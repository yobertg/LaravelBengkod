<?php

use Illuminate\Support\Facades\Route;
use App\Models\Periksa;
use App\Models\DetailPeriksa;
use App\Models\Obat;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PasienController;
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
        Route::get('/dokter/obat', [DokterController::class, 'showObat'])->name('dokter.obat');
        Route::post('/dokter/obat', [DokterController::class, 'storeObat'])->name('dokter.obatStore');
        Route::get('/dokter/obat/edit/{id}', [DokterController::class, 'editObat'])->name('dokter.obatEdit');
        Route::put('/dokter/obat/update/{id}', [DokterController::class, 'updateObat'])->name('dokter.obatUpdate');
        Route::delete('/dokter/obat/delete/{id}', [DokterController::class, 'destroyObat'])->name('dokter.obatDelete');

        Route::get('/dokter/periksa/edit/{id}', [DokterController::class, 'editPeriksa'])->name('dokter.periksaEdit');
        Route::put('/dokter/periksa/update/{id}', [DokterController::class, 'updatePeriksa'])->name('dokter.periksaUpdate');
        
        Route::get('/dokter/periksa', function () {
            $periksas = Periksa::all(); 
            $obats = Obat::all();
            return view('dokter.periksa', compact('periksas', 'obats'));
        })->name('dokter.periksa');

    });

    Route::middleware('role:pasien')->group(function () {

            //pasien
        Route::get('/pasien', [PasienController::class, 'dashboardPasien'])->name('pasien.dashboard');
        Route::get('/pasien/riwayat', [PasienController::class, 'showPeriksas'])->name('pasien.riwayat');
        Route::get('/pasien/periksa', [PasienController::class, 'createPeriksa'])->name('pasien.periksa');
        Route::post('/pasien/periksa', [PasienController::class, 'storePeriksa'])->name('pasien.periksa.store');
    
    });



// Route::get('/pasien/riwayat/{id}', [PasienController::class, 'showDetailPeriksa'])->name('pasien.riwayatDetail');
    
});






