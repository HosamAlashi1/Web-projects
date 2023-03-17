<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/posts','App\Http\Controllers\PostController@index')->name('posts.index');
// for insert row in db
Route::get('/posts/create','App\Http\Controllers\PostController@create')->name('posts.create');
Route::post('/posts','App\Http\Controllers\PostController@store')->name('posts.store');

Route::get('/posts/{post}','App\Http\Controllers\PostController@show')->name('posts.show');

// for updat row in db
Route::get('/posts/{post}/edit','App\Http\Controllers\PostController@edit')->name('posts.edit');
Route::put('/posts/{post}','App\Http\Controllers\PostController@update')->name('posts.update');

// to deleted 
Route::delete('/posts/{post}', 'App\Http\Controllers\PostController@destroy')->name('posts.destroy');
// to make a table of posts 

/*
    1- define a new route for the user in order to hit the url in browser
    2- define a new controller 
    3- define a new view
    4- define $posts array and pass it to the view
*/