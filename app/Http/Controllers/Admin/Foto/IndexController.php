<?php
namespace App\Http\Controllers\Admin\Foto;

use App\Http\Controllers\Controller;
use App\Services\ImageService;

class IndexController extends Controller
{

	/**
	* Create a new controller instance.
	*
	* @return void
	*/
	public function __construct(
		private ImageService $foto,
	)
	{
	}

	/**
	* get a list of routes for return
	*
	* @return array
	*/
	public static function getBackRotesFoto()
	{
		return [
			ImageService::getFotoType('ITEM')		=> 'admin.city.edit',
			ImageService::getFotoType('HOTEL')		=> 'admin.hotel.edit',
			ImageService::getFotoType('COUNTRY')	=> 'admin.country.edit',
			ImageService::getFotoType('CITY')		=> 'admin.city.edit',
		];
	}

	/**
	* get a route for return by foto type
	*
	* @param string $type
	* @return string
	*/
	public function getBackRoteFotoByType($type)
	{
		return self::getBackRotesFoto()[$type];
	}

	/**
	* destroy foto in admin
	*
	* @param int $id
	* @return void
	*/
	public function destroyBackForm($id)
	{
		$foto = $this->foto->getById($id);
		$route = self::getBackRoteFotoByType($foto->type);
		$this->foto->destroyFoto($foto);
		return redirect()->route($route, [$foto->parent_id]);
	}
}