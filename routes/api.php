<?php

use App\Http\Controllers\Api\ContactController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/contact', [ContactController::class, 'index'])->name('api.contact.list');
Route::post('/contact', [ContactController::class, 'store'])->name('api.contact.create');
Route::put('/contact/{id}', [ContactController::class, 'update'])->name('api.contact.update');
Route::delete('contact/{id}', [ContactController::class, 'destroy'])->name('api.contact.delete');
