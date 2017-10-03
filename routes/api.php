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

<<<<<<< HEAD
Route::post('saveInvestmentInfo', 'InfoController@saveInvestmentInfo');
Route::get('displayResults', 'InfoController@displayResults');
=======
<<<<<<< HEAD
<<<<<<< HEAD
Route::post('signUp', 'UsersController@signUp');
Route::post('signIn', 'UsersController@signIn');
Route::get('signOut', 'UsersController@signOut');
Route::get('getUser', 'UsersController@getUser');

Route::post('storeInfo', 'InfoController@store');
>>>>>>> fea15d924fe02b978cc3edec0a04034318ed86b3

Route::any('{path?}', 'MainController@index')->where("path", ".+");
=======
=======
>>>>>>> 58e38b6c32ac208efef1f5633f6eab3685d3c39d
Route::any('{path?}', 'MainController@index')->where("path", ".+");

Route::post('signUpUser', 'UsersController@signUp');
Route::post('storeInfo', 'InfoController@store');
<<<<<<< HEAD
>>>>>>> 58e38b6c32ac208efef1f5633f6eab3685d3c39d
=======
>>>>>>> 58e38b6c32ac208efef1f5633f6eab3685d3c39d
