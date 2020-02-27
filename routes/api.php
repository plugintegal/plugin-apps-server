<?php

use Illuminate\Http\Request;

Route::post('register','User\AuthUserController@register');
Route::post('login','User\AuthUserController@login');
Route::get('user/{member_id}','User\UserController@show');
Route::get('users','User\UserController@index');
Route::get('user/data/profile','User\UserController@profile');
Route::post('user/data/profile','User\UserController@update');
Route::post('user/data/personal', 'User\PersonalController@updatePersonal');



Route::get('test','User\AuthUserController@index');

Route::post('admin/login','Admin\AuthAdminController@login');
Route::get('category','Admin\CategoryController@index');
Route::post('category','Admin\CategoryController@store');
Route::put('category/{category}','Admin\CategoryController@update');
Route::delete('category/{category}','Admin\CategoryController@destroy');



//Event
Route::get('event','Event\EventController@index');
Route::get('event/{id}','Event\EventController@show');
Route::post('event','Event\EventController@store');
