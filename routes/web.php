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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/countries/{name}.html', 'CountryController@getCountry')->name('country_name');
Route::get('/countries/', 'CountryController@index')->name('countries');

Route::get('/towns/{name}.html', 'TownController@getTown')->name('town_name');
Route::get('/towns/', 'TownController@index')->name('towns');

Route::get('/items/item_{id}.html', 'ItemController@getItem')->where('id', '[0-9]+')->name('item_id');
Route::get('/items/', 'ItemController@index')->name('items');

Route::get('/hotels/{name}{foto}{id}.html', 'HotelController@getHotelFotos')->where('foto', '_foto_')->where('id', '[0-9]+')->name('hotel_fotos_id');
Route::get('/hotels/{name}{foto}.html', 'HotelController@getHotelFotos')->where('foto', '_foto')->name('hotel_fotos');
Route::get('/hotels/{name}.html', 'HotelController@getHotel')->name('hotel_name');
Route::get('/hotels/', 'HotelController@index')->name('hotels');



if (!function_exists('pr')) {
	function pr (...$ar)
	{
		foreach ($ar as $_ar)
		{
			echo '<pre>'; print_r ($_ar); echo '</pre>';
		}
	}
}

Route::get('/migr', function () {
//	Artisan::call('make:migration create_users_table');
//    return "Миграция выполнена!";
});

Route::get('/artis', function () {
		//Artisan::call('make:model Hotel');
	    //return "Артисан выполнен!";
});

Route::get('/clear', function () {
    /*
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Сброс кэша выполнен!";
    */
});