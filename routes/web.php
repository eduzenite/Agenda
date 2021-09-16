<?php

use App\Http\Controllers\Web\ContactController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', [ContactController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::post('/contact', [ContactController::class, 'store'])->middleware(['auth'])->name('contact.create');
Route::post('/update/contact/{id}', [ContactController::class, 'update'])->middleware(['auth'])->name('contact.update');
Route::post('/delete/contact/{id}', [ContactController::class, 'destroy'])->middleware(['auth'])->name('contact.delete');

require __DIR__.'/auth.php';
