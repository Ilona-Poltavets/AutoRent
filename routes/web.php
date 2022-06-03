<?php

use App\Http\Controllers\RentController;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
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

Auth::routes(['verify' => true]);

Route::get('/', function () {
    return view('home');
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
Route::post('search/country', 'App\Http\Controllers\SearchController@searchCountryByName');
Route::post('search/owner', 'App\Http\Controllers\SearchController@searchOwnerByName');
Route::post('search/tenant', 'App\Http\Controllers\SearchController@searchTenantByName');
Route::post('search/rent', 'App\Http\Controllers\SearchController@searchRent');

/*
|--------------------------------------------------------------------------
| Filters
|--------------------------------------------------------------------------
*/
Route::get('filter/transport', 'App\Http\Controllers\FiltersController@transportFilter');
Route::get('filter/country', 'App\Http\Controllers\FiltersController@countryFilter');
Route::get('filter/owner', 'App\Http\Controllers\FiltersController@ownerFilter');
Route::get('filter/tenant', 'App\Http\Controllers\FiltersController@tenantFilter');
Route::get('filter/rent', 'App\Http\Controllers\FiltersController@rentFilter');

/*
|--------------------------------------------------------------------------
| Edit photo transport
|--------------------------------------------------------------------------
*/
Route::get('editMainPhoto', 'App\Http\Controllers\TransportController@editMainPhoto');
Route::get('deletePhoto', 'App\Http\Controllers\TransportController@deletePhoto');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/get_role',function (){
    $permissionsArr=explode(';',Auth::user()->role->permissions);
    var_dump($permissionsArr);
    var_dump(in_array('edit_transport',$permissionsArr));
});
