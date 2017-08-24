<?php

Route::get('/', function(){
	return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index');

// Latch.
Route::get('auth/latch', 'LatchController@latch');
Route::get('auth/latchPair', 'LatchController@pair');
