<?php

use Illuminate\Support\Facades\Auth;
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
Auth::routes();



Route::get('/', function () {
    return view('guest.home');
})->name('home');



Route::middleware('auth')
    ->namespace('Admin')
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('/home', 'HomeController@index')->name('home');
        Route::resource('dishes', 'DishController');
        Route::resource('orders', 'OrderController');
        Route::get('/chart', 'ChartController@index')->name('chart');
});


Route::get('/{vue_capture?}', function () {
    return view('guest.home');
})->where('vue_capture', '[/\w.-]*');
