<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function()
{
  $name = "Izzatur Royhan";

	$beautymail = app()->make(Snowfire\Beautymail\Beautymail::class);
    $beautymail->send('emails.welcome', ["name" => $name], function($message) use($name)
    {
        $message
			->from('bar@example.com')
			->to('izzapark34@gmail.com', 'Royhan')
			->subject('Welcome!');
    });
  // dd($qr);

});
