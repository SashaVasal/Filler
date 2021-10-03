<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
use Illuminate\Http\Request;

Route::get('/', function () {


});

Route::get('/create_game', 'ApiController@CreateGame');

Route::get('/game/{id}', 'ApiController@Game');

Route::get('/turn', 'ApiController@PressButton');