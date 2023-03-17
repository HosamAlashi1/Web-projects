<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

define('PAGINATION_COUNT', 10);
// 'namespace' => 'Admin' : >>> that means will go to folder name (App\Http\Controllers\Admin)
Route::group(['namespace' => 'Admin', 'middleware' => 'auth:admin'], function () { 
    Route::get('/', 'DashboardController@index')->name('admin.dashboard');

    ############################ Begin languages Routes  ############################
    Route::group(['prefix' => 'languages'], function () {
        Route::get('/', 'LanguagesController@index')->name('admin.languages');
        Route::get('/create', 'LanguagesController@create')->name('admin.languages.create');
        Route::post('/store', 'LanguagesController@store')->name('admin.languages.store');
        Route::get('/edit/{language}', 'LanguagesController@edit')->name('admin.languages.edit');
        Route::post('/update/{language}', 'LanguagesController@update')->name('admin.languages.update');
        Route::get('/delete/{language}', 'LanguagesController@destroy')->name('admin.languages.delete');
    });
    ############################ End languages Routes  ############################

    ############################ Begin Main Categoris Routs  ############################
    Route::group(['prefix' => 'main-categoris'], function () {
        Route::get('/', 'MainCategoriesController@index')->name('admin.main_categoris');
        Route::get('/create', 'MainCategoriesController@create')->name('admin.main_categoris.create');
        Route::post('/store', 'MainCategoriesController@store')->name('admin.main_categoris.store');
        Route::get('/edit/{language}', 'MainCategoriesController@edit')->name('admin.main_categoris.edit');
        Route::post('/update/{language}', 'MainCategoriesController@update')->name('admin.main_categoris.update');
        Route::get('/delete/{language}', 'MainCategoriesController@destroy')->name('admin.main_categoris.delete');
    });
    ############################ End Main Categoris Routs  ############################

    ############################ Begin Vendors Routs  ############################
    Route::group(['prefix' => 'vendors'], function () {
        Route::get('/', 'VendorsController@index')->name('admin.vendors');
        Route::get('/create', 'VendorsController@create')->name('admin.vendors.create');
        Route::post('/store', 'VendorsController@store')->name('admin.vendors.store');
        Route::get('/edit/{language}', 'VendorsController@edit')->name('admin.vendors.edit');
        Route::post('/update/{language}', 'VendorsController@update')->name('admin.vendors.update');
        Route::get('/delete/{language}', 'VendorsController@destroy')->name('admin.vendors.delete');
    });
    ############################ End Vendors Routs  ############################
});

// for login
Route::group(['namespace' => 'Admin', 'middleware' => 'guest:admin'], function () {
    Route::get('login', 'LoginController@getLogin'); // for go login page
    Route::post('login', 'LoginController@login')->name('admin.login'); // for validate from email and password
});
