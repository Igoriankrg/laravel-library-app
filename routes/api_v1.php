<?php


use Illuminate\Support\Facades\Route;

Route::post('auth/login', 'AuthController@login');
Route::post('auth/logout', 'AuthController@logout');
Route::post('auth/refresh', 'AuthController@refresh');
Route::post('auth/me', 'AuthController@me');

Route::get('books', 'BookController@index');
Route::get('books/{id}', 'BookController@getById');
Route::post('books', 'BookController@create');
Route::put('books/{id}', 'BookController@update');

Route::post('authors', 'AuthorController@create');