<?php

use Component\Route\Route;

Route::get('/test', function(){
    echo "Hello World!";
});
Route::any('/', 'App\Controllers\HomeController@index');
Route::get('/article/view/{id}', 'App\Controllers\HomeController@view');

Route::dispatch();