<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OfferController;

Route::get('/','OfferController@index')->name('offers.index');

Route::get('/create','offerController@create')->name('offers.create');
Route::post('/','offerController@store')->name('offers.store');

// for updat row in db
Route::get('/{offer}/edit','OfferController@edit')->name('offers.edit');
Route::put('/{offer}','OfferController@update')->name('offers.update');

Route::get('/{offer}', 'OfferController@destroy')->name('offers.destroy');