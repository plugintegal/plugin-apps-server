<?php

use Illuminate\Http\Request;

Route::post('register','User\AuthUserController@register');
Route::post('login','User\AuthUserController@login');
Route::get('user/profile','User\UserController@profile')->middleware('auth:api');
Route::get('user/{member_id}','User\UserController@show');
Route::get('users','User\UserController@index');


Route::get('test','User\AuthUserController@index');
