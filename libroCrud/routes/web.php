<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LlibreContreller;

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

Route::get('/llibres', [LlibreContreller::class, 'index'])->middleware(['auth']);
Route::get('/addLlibres', [LlibreContreller::class, 'addNew'])->middleware(['auth']);
Route::post('/sotreLlibre', [LlibreContreller::class, 'store'])->middleware(['auth'])->name('storeLLibre');
Route::post('/saveLlibre', [LlibreContreller::class, 'save'])->middleware(['auth'])->name('saveLLibre');
Route::get('/delLlibre/{id}', [LlibreContreller::class, 'destroy'])->middleware(['auth']);
Route::get('/editLlibre/{id}', [LlibreContreller::class, 'ediLlibre'])->middleware(['auth']);

require __DIR__.'/auth.php';
