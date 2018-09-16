<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

# Public Facing Routes
Route::get('/', "BlogController@home");
Route::get('/post/{slug}', "BlogController@post");

# Admin Routes
Route::get('/admin', "Admin\PostsController@index");
Route::get('/admin/posts', "Admin\PostsController@list");
Route::get('/admin/posts/new', "Admin\PostsController@create");
Route::get('/admin/posts/{id}/edit', "Admin\PostsController@edit");
Route::get('/admin/posts/{id}/delete', "Admin\PostsController@delete");
Route::post('/admin/posts/process', "Admin\PostsController@process");

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
