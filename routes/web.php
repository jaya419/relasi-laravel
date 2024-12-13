<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\auth_controller;

/*
|----------------------------------------------------------------------
| Web Routes
|----------------------------------------------------------------------
| 
| Here is where you can register web routes for your application.
|
*/


Route::middleware('auth')->group(function () {
Route::get('/', [AppointmentController::class, 'deskripsi'])->name('deskripsi.deskripsi');

//route crud dokter, pasien dan jadwal
Route::resource('doctors', DoctorController::class);
Route::resource('appointments', AppointmentController::class);
    
//route untuk button di sidebar/ di akses setelah login
Route::get('deskripsi.deskripsi', [AppointmentController::class, 'deskripsi'])->name('deskripsi');
Route::get('appointments.index', [AppointmentController::class, 'index'])->name('index');
Route::get('doctors.index', [DoctorController::class, 'index'])->name('index');
});

// Halaman login untuk guest (belum login)
Route::get('/login', function () {
    return view('Auth.Login');
})->middleware('guest')->name('login');


//rute untuk input user tanpa harus login admin atau login admin
Route::get('user.input', [AppointmentController::class, 'create'])->name('user.input');
Route::post('/user/store', [AppointmentController::class, 'store'])->name('appointments.store');

//route untuk fungsi pencarian
Route::get('doctors.search', [DoctorController::class, 'search'])->name('doctors.search');
Route::get('appointments.search', [AppointmentController::class, 'search'])->name('appointments.search');

//button ceklis dan silang untuk mengubah status
Route::patch('/appointments/{id}/complete', [AppointmentController::class, 'markAsComplete'])->name('appointments.complete');
Route::patch('/appointments/{id}/cancel', [AppointmentController::class, 'markAsCancel'])->name('appointments.cancel');

//rute login dan logout
Route::post('/login-proses', [auth_controller::class, 'login'])->name('loginproccess');
Route::post('/logout', [auth_controller::class, 'logout'])->name('logout');
