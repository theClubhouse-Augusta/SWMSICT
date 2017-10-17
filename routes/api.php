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

Route::post('signUp', 'UsersController@signUp');
Route::post('signIn', 'UsersController@signIn');
Route::get('signOut', 'UsersController@signOut');
Route::get('getUser', 'UsersController@getUser');

Route::post('getProducts/{type}/{order}/{physLoc}/{specOff}', 'InfoController@getProducts');
Route::post('saveSearchData', 'InfoController@saveSearchData');
Route::post('collectSearchData', 'InfoController@collectSearchData');
Route::post('getProducts2', 'InfoController@getProducts2');

Route::any('{path?}', 'MainController@index')->where("path", ".+");
