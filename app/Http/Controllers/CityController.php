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
		return new CityFullResource($this->city->getByName($name));
	}
}