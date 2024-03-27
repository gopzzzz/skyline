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
Route::get('/staff', [App\Http\Controllers\HomeController::class, 'staff'])->name('staff');
Route::post('/staffinsert', [App\Http\Controllers\HomeController::class, 'staffinsert'])->name('staffinsert');
Route::get('staffdelete/{id}', [App\Http\Controllers\HomeController::class, 'staffdelete'])->name('staffdelete');

Route::post('/stafffetch', [App\Http\Controllers\HomeController::class, 'stafffetch'])->name('stafffetch');
Route::post('/staffedit', [App\Http\Controllers\HomeController::class, 'staffedit'])->name('staffedit');
Route::get('/expense', [App\Http\Controllers\HomeController::class, 'expense'])->name('expense');
Route::post('/expenseinsert', [App\Http\Controllers\HomeController::class, 'expenseinsert'])->name('expenseinsert');
Route::get('expensedelete/{id}', [App\Http\Controllers\HomeController::class, 'expensedelete'])->name('expensedelete');

Route::post('/expensefetch', [App\Http\Controllers\HomeController::class, 'expensefetch'])->name('expensefetch');
Route::post('/expenseedit', [App\Http\Controllers\HomeController::class, 'expenseedit'])->name('expenseedit');

Route::get('/attendance', [App\Http\Controllers\HomeController::class, 'attendance'])->name('attendance');

Route::post('/attendanceinsert', [App\Http\Controllers\HomeController::class, 'attendanceinsert'])->name('attendanceinsert');

Route::post('/attendancefetch', [App\Http\Controllers\HomeController::class, 'attendancefetch'])->name('attendancefetch');

Route::get('/attendancedetails', [App\Http\Controllers\HomeController::class, 'showDetails'])->name('attendancedetails');

Route::post('/attendancedetails', [App\Http\Controllers\HomeController::class, 'showDetailsfilter'])->name('attendancedetails');

Route::post('/attendanceedit', [App\Http\Controllers\HomeController::class, 'attendanceedit'])->name('attendanceedit');
Route::get('/expensetype', [App\Http\Controllers\HomeController::class, 'expensetype'])->name('expensetype');

Route::post('/expensetypefetch', [App\Http\Controllers\HomeController::class, 'expensetypefetch'])->name('expensetypefetch');

Route::post('/expensetypeinsert', [App\Http\Controllers\HomeController::class, 'expensetypeinsert'])->name('expensetypeinsert');

Route::post('/expensetypeedit', [App\Http\Controllers\HomeController::class, 'expensetypeedit'])->name('expensetypeedit');

Route::get('/salary', [App\Http\Controllers\HomeController::class, 'salary'])->name('salary');

Route::post('/filterByMonth', [App\Http\Controllers\HomeController::class, 'filterByMonth'])->name('salary');
