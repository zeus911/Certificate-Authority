<?php

Route::get('/', function(){
	return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index');

// Latch.
Route::get('auth/latch', 'LatchController@latch');
Route::post('auth/latchPair', 'LatchController@pair');
