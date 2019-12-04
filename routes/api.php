<?php

use Illuminate\Http\Request;
//-----------------------------Routas que no Necesitan Token---------------------------------------//

Route::get('/', function () {
    return response()->json(['Name'=>'API REST','status'=>'200','Version'=>'v1'],200);      
});
  

Route::post('register', 'ResgisterController@register');
Route::post('login', 'ResgisterController@login');


//-----------------------------Routas que Necesitan Token---------------------------------------//
Route::resource('article', 'ArticleController')->middleware('auth:api');


