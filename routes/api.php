<?php

use Illuminate\Http\Request;

Route::post('register','API\UserController@register');
Route::get('test','API\UserController@index');
