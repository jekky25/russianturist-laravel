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

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function() {
	Route::group(['namespace' => 'Main'], function() {
		Route::get('/', 'IndexController');
	});

	Route::group(['namespace' => 'Config', 'prefix' => 'configs'], function() {
		Route::get('/', 'IndexController@index')->name('admin.config.index');
		Route::get('/create', 'IndexController@create')->name('admin.config.create');
		Route::post('/store', 'IndexController@store')->name('admin.config.store');
		Route::get('/{id}', 'IndexController@show')->name('admin.config.show');
		Route::get('/{id}/edit', 'IndexController@edit')->name('admin.config.edit');
		Route::patch('/{id}', 'IndexController@update')->name('admin.config.update');
		Route::delete('/{id}', 'IndexController@destroy')->name('admin.config.destroy');
	});
});

Route::get('/{page}', 'IndexController')->where('page', '.*');
Route::get('/hotels/{name}{foto}.html', 'HotelController@getHotelFotos')->where('foto', '_foto')->name('hotel_fotos');
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
//		Artisan::call('make:provider SapeServiceProvider');
		//Artisan::call('make:model Hotel');
	    //return "Артисан выполнен!";
});

Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Сброс кэша выполнен!";
});
Auth::routes();