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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');



// ================================= Begin Authntication && Guards ========================= 

route::group(['middleware' => 'CheckAge' , 'namespace' => 'Auth'], function () {
    Route::get('/adults', 'CustomAuthController@adult')->name('adults.index');
});

Route::get('/not-adults', function(){
    return 'not adults';
})->name('not adults');

Route::get('site','Auth\CustomAuthController@site')->middleware('auth:web')->name('site');
Route::get('admin','Auth\CustomAuthController@admin')->middleware('auth:admin')->name('admin'); 

Route::get('admin/login','Auth\CustomAuthController@adminLogin')->name('admin.login');
Route::post('admin/login','Auth\CustomAuthController@CheckAdminLogin')->name('save.admin.login');

// ================================= End Authntication && Guards =========================


