<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SiswaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FirebaseController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('get-firebase-data', [FirebaseController::class, 'index'])->name('firebase.index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->group(function () {
    Route::get('/data_admin', [AdminController::class, 'index'])->name('admin');
    Route::post('/data_admin', [AdminController::class, 'add_admin'])->name('add_admin');
    Route::get('/edit/{id}', [AdminController::class, 'edit_admin'])->name('edit_admin');
    Route::delete('/delete{id}', [AdminController::class, 'delete'])->name('delete_admin');
    Route::get('/data_siswa', [SiswaController::class, 'index'])->name('siswa');
    Route::post('/data_siswa', [SiswaController::class, 'add_siswa'])->name('add_siswa');
});
