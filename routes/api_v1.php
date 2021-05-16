<?php


use Illuminate\Support\Facades\Route;

Route::post('auth/login', 'AuthController@login');
Route::post('auth/logout', 'AuthController@logout');
Route::post('auth/refresh', 'AuthController@refresh');
Route::post('auth/me', 'AuthController@me');

Route::get('book', 'BookController@index');
Route::get('book/{id}', 'BookController@getById');