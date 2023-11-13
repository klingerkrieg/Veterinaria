<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/usuarios/list', [App\Http\Controllers\UsuariosController::class, 'index'])->name('usuarios');
Route::get('/usuarios/', [App\Http\Controllers\UsuariosController::class, 'new'])->name('usuarios-new');
Route::get('/usuarios/{user}', [App\Http\Controllers\UsuariosController::class, 'edit'])->name('usuarios-edit');
Route::put('/usuarios/{user}', [App\Http\Controllers\UsuariosController::class, 'update'])->name('usuarios-update');
Route::delete('/usuarios/{user}', [App\Http\Controllers\UsuariosController::class, 'delete'])->name('usuarios-delete');
Route::post('/usuarios', [App\Http\Controllers\UsuariosController::class, 'salvar'])->name('usuarios-insert');
