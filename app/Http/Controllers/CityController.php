<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\CityService;
use App\Http\Resources\CityResource;
use App\Http\Resources\CityFullResource;
use App\Traits\BaseConfig;

class CityController extends Controller
{
	use BaseConfig;
	public $boardingConfig = [];
	/**
	* Create a new controller instance.
	*
	* @return void
	*/
	public function __construct(
		public CityService		$city
	)
	{
		$this->boardConfig = $this->getBoardConfig();
	}

	/**
	* Get all cities 
	* @return json
	*/
	public function getCities()
	{
		$cities	= $this->city->getAll();
		return CityResource::collection($cities);
	}

	/**
	* Show a city page
	* @param  string  $name
	* @return \Illuminate\Http\Response
	*/
	public function getCityByName($name)
	{
		$city	= $this->city->getByName($name);
		$city	= $this->city->getPictureLink($city, $this->boardConfig['picture_width_city_id'], $this->boardConfig['picture_height_city_id']);
		return new CityFullResource($city);
	}
}