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



Route::get('/', function () {
    return response()->json(['Name'=>'API REST','status'=>'200','Version'=>'v1'],200);      
});
  
Route::post('register', 'ResgisterController@register');
Route::post('login', 'ResgisterController@login');
   
Route::middleware('auth:api')->group( function () {
    Route::resource('article', 'ArticleController');
});

