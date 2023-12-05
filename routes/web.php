<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaryawanController;

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

Route::get('dashboard', function () {
    return view('dashboard');
});
Route::get('cari',[KaryawanController::class, 'cari']);
Route::get('dashboard', [KaryawanController::class, 'index']);
Route::get('create', [KaryawanController::class, 'create']);
Route::post('store', [KaryawanController::class, 'store']);
Route::get('edit/{id}', [KaryawanController::class, 'edit']);
Route::delete('dashboard/{id}', [KaryawanController::class, 'destroy']);
Route::Resource('karyawan', KaryawanController::class);
