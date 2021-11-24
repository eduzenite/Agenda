<?php

use App\Http\Controllers\Web\CustomerController;
use App\Http\Controllers\Web\NumberController;
use App\Http\Controllers\Web\NumberPreferenceController;
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
    return view('auth.login');
});

Route::group([
    "prefix" => "customers"
], function () {
    Route::get('/', [CustomerController::class, 'index'])->middleware(['auth'])->name('dashboard');
    Route::get('/{customerId}', [CustomerController::class, 'show'])->middleware(['auth'])->name('customer');

    //Actions
    Route::post('/', [CustomerController::class, 'store'])->middleware('auth')->name('customer.store');
    Route::post('{customerId}', [CustomerController::class, 'update'])->middleware('auth')->name('customer.update');
    Route::post('{customerId}/delete', [CustomerController::class, 'destroy'])->middleware('auth')->name('customer.destroy');

    Route::post('{customerId}/numbers', [NumberController::class, 'store'])->middleware('auth')->name('customer.numbers.store');
    Route::post('{customerId}/numbers/{numberId}', [NumberController::class, 'update'])->middleware('auth')->name('customer.numbers.update');
    Route::post('{customerId}/numbers/{numberId}/delete', [NumberController::class, 'destroy'])->middleware('auth')->name('customer.numbers.destroy');
});

require __DIR__.'/auth.php';
