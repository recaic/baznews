<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your module. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => 'checkperm'], function() {


    Route::resource('news', 'Backend\PostController');

});


Route::group(['prefix' => 'news'], function() {
    Route::get('/', function() {
        dd('This is the News module index page. Build something great!');
    });
});
