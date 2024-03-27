<?php

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
    return view('login');
});
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/expensetype', [App\Http\Controllers\HomeController::class, 'expensetype'])->name('expensetype');

Route::post('/expensetypefetch', [App\Http\Controllers\HomeController::class, 'expensetypefetch'])->name('expensetypefetch');

Route::post('/expensetypeinsert', [App\Http\Controllers\HomeController::class, 'expensetypeinsert'])->name('expensetypeinsert');

Route::post('/expensetypeedit', [App\Http\Controllers\HomeController::class, 'expensetypeedit'])->name('expensetypeedit');
