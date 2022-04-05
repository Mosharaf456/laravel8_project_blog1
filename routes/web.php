<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Category1
Route::post('/categories', 'CategoriesController@store');

Route::get('/categories', 'CategoriesController@index');
 
Route::get('/categories/create', 'CategoriesController@create');

Route::get('/categories/{category}/edit', 'CategoriesController@edit');

Route::put('/categories/{category}/edit', 'CategoriesController@update');

//Tag
Route::post('/tags', 'TagsController@store');

Route::get('/tags', 'TagsController@index');
 
Route::get('/tags/create', 'TagsController@create');

Route::get('/tags/{tag}/edit', 'TagsController@edit');

Route::put('/tags/{tag}/edit', 'TagsController@update');

// Posts2
Route::get('/posts' , 'PostsController@index');

Route::post('/posts' , 'PostsController@store');
// 
Route::get('/posts/{post}' , 'HomeController@show');

//comments
Route::post('/posts/{post}/comments' , 'CommentsController@store')->middleware('auth');

Route::get('/posts/{category}/category' , 'SearchController@searchPostBycategory');
//
Route::get('/posts/{post}/liked' , 'CommentsController@storeLike')->middleware('auth');

Route::get('/comments/{comment}/liked' , 'CommentsController@storeCommentLike')->middleware('auth');

// Posts2
Route::get('/posts/create' , 'PostsController@create');

Route::get('/posts/{post}/edit' , 'PostsController@edit');

Route::put('/posts/{post}/edit' , 'PostsController@update');




