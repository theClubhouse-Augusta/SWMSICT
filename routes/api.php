<?php

use Illuminate\Http\Request;

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

Route::any('{path?}', 'MainController@index')->where("path", ".+");

Route::post('signUpUser', 'UsersController@signUp');
Route::post('storeInfo', 'InfoController@store');
