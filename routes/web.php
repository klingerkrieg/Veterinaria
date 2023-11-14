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

#todos acessam
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/pets/list', [App\Http\Controllers\PetsController::class, 'index'])->name('pets');
Route::get('/pets/{pet}', [App\Http\Controllers\PetsController::class, 'edit'])->name('pets-edit');

#apenas veterinarios acessam
Route::middleware(['auth','can:veterinario-access'])->group(function () {

    Route::get('/usuarios/list', [App\Http\Controllers\UsuariosController::class, 'index'])->name('usuarios');
    Route::get('/usuarios/', [App\Http\Controllers\UsuariosController::class, 'new'])->name('usuarios-new');
    Route::get('/usuarios/{user}', [App\Http\Controllers\UsuariosController::class, 'edit'])->name('usuarios-edit');
    Route::put('/usuarios/{user}', [App\Http\Controllers\UsuariosController::class, 'update'])->name('usuarios-update');
    Route::delete('/usuarios/{user}', [App\Http\Controllers\UsuariosController::class, 'delete'])->name('usuarios-delete');
    Route::post('/usuarios', [App\Http\Controllers\UsuariosController::class, 'salvar'])->name('usuarios-insert');

    Route::get('/pets/', [App\Http\Controllers\PetsController::class, 'new'])->name('pets-new');
    Route::get('/pets-com-dono/{user}', [App\Http\Controllers\PetsController::class, 'new'])->name('pets-new-com-user');
    Route::put('/pets/{pet}', [App\Http\Controllers\PetsController::class, 'update'])->name('pets-update');
    Route::delete('/pets/{pet}', [App\Http\Controllers\PetsController::class, 'delete'])->name('pets-delete');
    Route::post('/pets', [App\Http\Controllers\PetsController::class, 'salvar'])->name('pets-insert');

    Route::get('/vacinas/list', [App\Http\Controllers\VacinasController::class, 'index'])->name('vacinas');
    Route::get('/vacinas/', [App\Http\Controllers\VacinasController::class, 'new'])->name('vacinas-new');
    Route::get('/vacinas/{vacina}', [App\Http\Controllers\VacinasController::class, 'edit'])->name('vacinas-edit');
    Route::put('/vacinas/{vacina}', [App\Http\Controllers\VacinasController::class, 'update'])->name('vacinas-update');
    Route::delete('/vacinas/{vacina}', [App\Http\Controllers\VacinasController::class, 'delete'])->name('vacinas-delete');
    Route::post('/vacinas', [App\Http\Controllers\VacinasController::class, 'salvar'])->name('vacinas-insert');

    Route::get('/vacinacoes/list', [App\Http\Controllers\VacinacoesController::class, 'index'])->name('vacinacoes');
    Route::get('/vacinacoes/{vacinacao}', [App\Http\Controllers\VacinacoesController::class, 'edit'])->name('vacinacoes-edit');
    Route::delete('/vacinacoes/{vacinacao}', [App\Http\Controllers\VacinacoesController::class, 'delete'])->name('vacinacoes-delete');
    Route::post('/vacinacoes/{pet}', [App\Http\Controllers\VacinacoesController::class, 'salvar'])->name('vacinacoes-insert');

});