<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/register', function () {
    return view('user_register');
});

Route::post('/register', [UserController::class, 'register'])->name('register');

Route::get('/order', function () {
    return view('new_order');
});

Route::post('/order', [OrderController::class, 'store'])->name('order.store');

Route::get('/search-users', [UserController::class, 'search']);

Route::get('/users', [UserController::class, 'listUsers']);