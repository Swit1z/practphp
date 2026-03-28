<?php

use Src\Route;


Route::add('GET', '/', [Controller\Site::class, 'index']);
Route::add('GET', '/post', [Controller\Site::class, 'index']);

Route::add(['GET', 'POST'], '/hello', [Controller\Site::class, 'hello'])->middleware('auth');

Route::add('GET', '/logout', [Controller\Site::class, 'logout']);


Route::add('GET', '/signup', [Controller\Site::class, 'signup']);
Route::add('POST', '/signup', [Controller\Site::class, 'signup']);

Route::add('GET', '/login', [Controller\Site::class, 'login']);
Route::add('POST', '/login', [Controller\Site::class, 'login']);