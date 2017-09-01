<?php

use Component\Route\Route;

Route::any('/', 'HomeController@index');
Route::get('/article/view/{id}', 'HomeController@view');

Route::dispatch();