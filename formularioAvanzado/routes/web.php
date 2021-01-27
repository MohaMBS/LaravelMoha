<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormularioAvanzado;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/encuesta', function () {
    return view('forum-avanzado');
})->middleware(['auth'])->name('encuesta');

Route::post('/encuesta',[FormularioAvanzado::class, 'Encuesta'])->middleware(['auth'])->name('encuesta-validacion');;

require __DIR__.'/auth.php';
