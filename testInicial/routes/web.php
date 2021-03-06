<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemeC;//nuevo controlador.
use App\Http\Controllers\MailController;//controlador para el mail.


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

Route::get('/meme2', function () {
    return view('memelandia2');
});

Route::get('/meme', [MemeC::class, 'show']);

Route::get('/send/email', [MailController::class, 'mail']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
