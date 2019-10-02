<?php

use Illuminate\Http\Request;

Route::post('register','User\AuthUserController@register');
Route::post('login','User\AuthUserController@login');

Route::get('test','User\AuthUserController@index');
