<?php

use Lib\Route\Route;

Route::get('test', function(){
    echo "Hello World!";
});
Route::any('/', 'HomeController@index');
Route::get('article/view/{id}', 'HomeController@view');

Route::dispatch();