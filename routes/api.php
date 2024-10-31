<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*ajax */
Route::get('/get/config/', 'ConfigController@index')->name('get.config');
Route::get('/get/country/name/{name}', 'CountryController@getCountryByName')->name('get.country');
Route::get('/get/countries/', 'CountryController@getCountries')->name('get.countries');
Route::get('/get/cities/', 'TownController@getCities')->name('get.cities');
Route::get('/get/hotels/short/{id}', 'HotelController@getHotelShortList')->whereNumber('id')->name('get.hotels.short');