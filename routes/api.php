<?php

use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\NumberController;
use App\Http\Controllers\Api\NumberPreferenceController;
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
//Route::get('/contact', [ContactController::class, 'index'])->name('api.contact.list');
//Route::post('/contact', [ContactController::class, 'store'])->name('api.contact.create');
//Route::put('/contact/{id}', [ContactController::class, 'update'])->name('api.contact.update');
//Route::delete('contact/{id}', [ContactController::class, 'destroy'])->name('api.contact.delete');

Route::group([
    "prefix" => "customers"
], function () {
    Route::post('/', [CustomerController::class, 'store'])->middleware('auth:api')->name('api.customers.store');
    Route::post('{customerId}', [CustomerController::class, 'update'])->middleware('auth:api')->name('api.customers.update');
    Route::delete('{customerId}', [CustomerController::class, 'destroy'])->middleware('auth:api')->name('api.customers.destroy');

    Route::post('{customerId}/numbers', [NumberController::class, 'store'])->middleware('auth:api')->name('api.customers.numbers.store');
    Route::post('{customerId}/numbers/{numberId}', [NumberController::class, 'update'])->middleware('auth:api')->name('api.customers.numbers.update');
    Route::delete('{customerId}/numbers/{numberId}', [NumberController::class, 'destroy'])->middleware('auth:api')->name('api.customers.numbers.destroy');
});
