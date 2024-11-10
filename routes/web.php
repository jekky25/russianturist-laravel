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

Route::middleware('slashes')->group(function () {
	Route::get('/items/', 			'ItemController@index')		->name('items');
});

Route::get('/items/item_{id}.html', 'ItemController@getItem')->whereNumber('id')->name('item_id');

Route::get('/{page}', 'IndexController')->where('page', '.*');

Route::get('/countries/{name}.html', 'CountryController@getCountry')->name('country_name'); //depricated
Route::middleware('slashes')->group(function () {
	Route::get('/countries/', 		'CountryController@index')	->name('countries'); //depricated
	Route::get('/towns/', 			'TownController@index')		->name('towns'); //deprecated
	Route::get('/hotels/', 			'HotelController@index')	->name('hotels'); //deprecated
});
Route::get('/hotels/{name}{foto}{id}.html', 'HotelController@getHotelFotos')->where('foto', '_foto_')->whereNumber('id')->name('hotel_fotos_id'); //depricated
Route::get('/hotels/{name}{foto}.html', 'HotelController@getHotelFotos')->where('foto', '_foto')->name('hotel_fotos'); //depricated
Route::get('/towns/{name}.html', 'TownController@getTown')->name('town_name'); //depricated
Route::get('/hotels/{name}.html', 'HotelController@getHotel')->name('hotel_name'); //depricated

Route::get('/', 'HomeController@index')->name('home');

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
});
Auth::routes();