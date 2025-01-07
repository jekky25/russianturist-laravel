<?php
namespace App\Http\Controllers\Admin\Picture;

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
		private ImageService $picture
	)
	{
	}

	/**
	* get a list of routes for return
	*
	* @return array
	*/
	public static function getBackRotesPicture()
	{
		return [
			ImageService::getPictureType('ITEM')		=> 'admin.item.edit',
			ImageService::getPictureType('HOTEL')		=> 'admin.hotel.edit',
			ImageService::getPictureType('COUNTRY')		=> 'admin.country.edit',
			ImageService::getPictureType('CITY')		=> 'admin.city.edit',
		];
	}

	/**
	* get a route for return by picture type
	*
	* @param string $type
	* @return string
	*/
	public function getBackRotePictureByType($type)
	{
		return self::getBackRotesPicture()[$type];
	}

	/**
	* destroy picture in admin
	*
	* @param int $id
	* @return void
	*/
	public function destroyBackForm($id)
	{
		$picture = $this->picture->getById($id);
		$route = self::getBackRotePictureByType($picture->type);
		$this->picture->destroyPicture($picture);
		return redirect()->route($route, [$picture->parent_id]);
	}
}