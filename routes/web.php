<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Category1
Route::post('/categories', 'CategoriesController@store');

Route::get('/categories', 'CategoriesController@index');
 
Route::get('/categories/create', 'CategoriesController@create');

Route::get('/categories/{category}/edit', 'CategoriesController@edit');

Route::put('/categories/{category}/edit', 'CategoriesController@update');

// Posts2
Route::get('/posts/create' , 'PostsController@create');

Route::get('/posts' , 'PostsController@index');

Route::post('/posts' , 'PostsController@store');




