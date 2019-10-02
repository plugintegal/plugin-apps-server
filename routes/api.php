<?php

use Illuminate\Http\Request;

Route::post('register','User\AuthUserController@register');
Route::post('login','User\AuthUserController@login');
Route::get('user/profile','User\UserController@show')->middleware('auth:api');
Route::get('users','User\UserController@index');


Route::get('test','User\AuthUserController@index');
