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

Route::post('register','PassportController@register');
Route::post('login','PassportController@login');

//Route::get('logout','PassportController@logout');

Route::middleware('auth:api')->get('/user', function (Request $request) {
  return $request->user();
 });
//get all resources
Route::get('/Book','BookController@index');


Route::middleware('auth:api')->group( function() {
    Route::post('/logout','PassportController@logout');
    Route::post('/Book','BookController@store');
    Route::put('/Book/{id}','BookController@update');
    Route::get('/Book/{id}','BookController@show');
    Route::delete('/Book/{id}','BookController@destroy');
  });



