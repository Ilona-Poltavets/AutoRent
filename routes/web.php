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

Route::resource('transport','App\Http\Controllers\TransportController');
Route::resource('owner','App\Http\Controllers\OwnerController');
Route::resource('tenant','App\Http\Controllers\TenantController');
Route::resource('rent','App\Http\Controllers\RentController');
Route::resource('country','App\Http\Controllers\CountryController');
Route::resource('carBodyType','App\Http\Controllers\CarBodyTypeController');
Route::get('currently_rented','App\Http\Controllers\TransportController@create_view')->name('currently_rented');

Route::get('/', function () {
    return view('welcome');
});
