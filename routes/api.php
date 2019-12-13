<?php

use Illuminate\Http\Request;

Route::post('register','User\AuthUserController@register');
Route::post('login','User\AuthUserController@login');
Route::get('user/profile','User\UserController@profile')->middleware('auth:api');
Route::get('user/{member_id}','User\UserController@show');
Route::get('users','User\UserController@index');
Route::put('user/profile', 'User\PersonalController@updatePersonal')->middleware('auth:api');


Route::get('test','User\AuthUserController@index');

Route::post('admin/login','Admin\AuthAdminController@login');
Route::get('category','Admin\CategoryController@index');
Route::post('category','Admin\CategoryController@store');
Route::put('category/{category}','Admin\CategoryController@update');
Route::delete('category/{category}','Admin\CategoryController@destroy');



//Event
Route::get('event','Event\EventController@index');
Route::post('event','Event\EventController@store');
