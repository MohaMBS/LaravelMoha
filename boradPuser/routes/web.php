<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home;
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

Route::get('/facebook', [Home::class, "index"])->middleware(['auth'])->name('facebook');
Route::post('/facebook', [Home::class, "send"])->middleware(['auth'])->name('newPost');
Route::post('/like', [Home::class, "like"])->middleware(['auth'])->name('registerLike');
Route::post('/comment', [Home::class, "comment"])->middleware(['auth'])->name('comment');
Route::get('/getMsg/{to}', [Home::class, "indexSelection"])->middleware(['auth']);

require __DIR__.'/auth.php';
