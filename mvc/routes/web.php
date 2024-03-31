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
Route::post('/product/delete', 'ProductController@delete');


// User
Route::get('/user', 'UserController@index');
Route::get('/user/show', 'UserController@show');
Route::get('/user/create', 'UserController@create');
Route::post('/user/create', 'UserController@store');


// Enchere
Route::get('/enchere', 'EnchereController@index');
Route::get('/enchere/index', 'EnchereController@index');
Route::post('/enchere/deactiver', 'EnchereController@deactiverEnchere');
Route::get('/enchere/show', 'EnchereController@show');
Route::get('/enchere/create', 'EnchereController@activer');
Route::post('/enchere/create', 'EnchereController@store');

//Miser
Route::get('/mise', 'MiseController@index');
Route::get('/mise/create', 'MiseController@create');
Route::post('/mise/create', 'MiseController@store');



Route::dispatch();
