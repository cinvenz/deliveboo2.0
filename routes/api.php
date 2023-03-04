<?php

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });




Route::get('/users', 'Api\UserController@index')->name('users.index');
Route::get('/users/search', 'Api\UserController@search')->name('users.search');
Route::get('/users/{user}', 'Api\UserController@show')->name('users.show');
Route::get('/users/{user}/dishes', 'Api\DishController@dishes')->name('users.dishes');

Route::get('/users/search', 'Api\UserController@search')->name('users.search');


Route::post('checkout','Api\UserController@checkout');











