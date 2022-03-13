<?php

use App\Http\Controllers\RentController;
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

Route::resource('transport', 'App\Http\Controllers\TransportController');
Route::resource('owner', 'App\Http\Controllers\OwnerController');
Route::resource('tenant', 'App\Http\Controllers\TenantController');
Route::resource('country', 'App\Http\Controllers\CountryController');
Route::resource('carBodyType', 'App\Http\Controllers\CarBodyTypeController');

Route::controller(RentController::class)->group(function () {
    Route::get('rents', 'index')->name('rent.index');
    Route::get('rents/{transportId}/create', 'create')->name('rent.create');
    Route::get('rents/{rent}', 'show')->name('rent.show');
    Route::get('rents/{rent}/edit', 'edit')->name('rent.edit');
    Route::post('rents', 'store')->name('rent.store');
    Route::put('rents', 'update')->name('rent.update');
    Route::delete('rents/{rent}', 'destroy')->name('rent.destroy');
});

Route::get('currently_rented', 'App\Http\Controllers\TransportController@create_view')->name('currently_rented');
/*
|--------------------------------------------------------------------------
| Search
|--------------------------------------------------------------------------
*/

Route::post('search/transport', 'App\Http\Controllers\SearchController@searchTransporByModel');
