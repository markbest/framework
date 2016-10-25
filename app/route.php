<?php

use Lib\Route\Route;

Route::get('', 'HomeController@index');
Route::get('article/view/{id}', 'HomeController@view');

Route::dispatch();