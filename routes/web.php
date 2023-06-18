<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OsController;
use App\Http\Controllers\TopicoOcorrenciasController;
use Illuminate\Support\Facades\Auth;

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
    return view('/auth/login');
});

Auth::routes();

Route::get('/home',[OsController::class, 'index'])->middleware('auth');

Route::get('/os/cadastro',[OsController::class, 'create'])->name('os.cadastro')->middleware('auth');
Route::post('/os',[OsController::class, 'store'])->name('os.store')->middleware('auth');
Route::get('/os',[OsController::class, 'index'])->middleware('auth')->name('os.index');
Route::get('/os/consultar',[OsController::class, 'consultar'])->middleware('auth')->name('os.consultar');
Route::get('/os/edit/{id}',[OsController::class, 'edit'])->middleware('auth')->name('os.edit');
Route::delete('/os/delete/{id}',[OsController::class, 'destroy'])->name('os.delete')->middleware('auth');
Route::post('/search', 'OcorrenciasController@search')->name('search');
Route::put('/os/{id}',[OsController::class, 'update'])->name('os.update')->middleware('auth');


Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



Route::get('/topico/cadastro',[TopicoOcorrenciasController::class, 'create'])->name('topico.cadastro')->middleware('auth');
