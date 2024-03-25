<?php

use App\Controllers;
use App\Routes\Route;

// Home
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');


//Encheres
Route::get('/client', 'ClientController@index');
Route::get('/client/show', 'ClientController@show');
Route::get('/client/create', 'ClientController@create');
Route::post('/client/create', 'ClientController@store');
Route::get('/client/edit', 'ClientController@edit');
Route::post('/client/edit', 'ClientController@update');
Route::post('/client/delete', 'ClientController@delete');


//login et logout
Route::get('/login', 'AuthController@index');
Route::post('/login', 'AuthController@store');
Route::get('/logout', 'AuthController@delete');


//Product
Route::get('/product/index', 'ProductController@index');
Route::get('/product/create', 'ProductController@create');
Route::post('/product/create', 'ProductController@store');
Route::get('/product/show', 'ProductController@show');
Route::get('/product/edit', 'ProductController@edit');
Route::get('/product/update', 'ProductController@update');
Route::get('/product/delete', 'ProductController@delete');


// User
Route::get('/user', 'UserController@index');
Route::get('/user/show', 'UserController@show');
Route::get('/user/create', 'UserController@create');
Route::post('/user/create', 'UserController@store');


//catalogue
Route::get('/catalogue', 'CatalogueController@index');




Route::dispatch();
