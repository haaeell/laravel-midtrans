<?php

use App\Http\Controllers\OrderController;
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
Route::post('/checkOut/{id}', [OrderController::class, 'checkOut'])->name('checkOut');
Route::get('/order-history', [OrderController::class, 'index'])->name('orderHistory');
Route::post('/midtrans/callback', [OrderController::class, 'handleMidtransCallback'])->name('midtransCallback');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
