<?php

use Illuminate\Http\Request;

Route::post('register','User\AuthUserController@register');
Route::get('test','User\AuthUserController@index');
