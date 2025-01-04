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
Route::get('/get/city/name/{name}', 'CityController@getCityByName')->name('get.city');
Route::get('/get/cities/', 'CityController@getCities')->name('get.cities');
Route::get('/get/hotels/short/city/{id}', 'HotelController@getHotelShortListByCity')->whereNumber('id')->name('get.hotels.short.city');
Route::get('/get/hotels/short/{id}', 'HotelController@getHotelShortList')->whereNumber('id')->name('get.hotels.short');
Route::get('/get/hotel/name/{name}/picture/{id}', 'HotelController@getHotelPicture')->whereNumber('id')->name('get.hotel');
Route::get('/get/hotel/name/{name}', 'HotelController@getHotelByName')->name('get.hotel');
Route::get('/get/hotels/', 'HotelController@getHotels')->name('get.hotels');
Route::get('/get/item/id/{id}', 'ItemController@getItemById')->name('get.item');
Route::get('/get/items/', 'ItemController@getItems')->name('get.items');