<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\TownService;
use App\Http\Resources\CityResource;
use App\Http\Resources\CityFullResource;
use App\Traits\BaseConfig;

class TownController extends Controller
{
	use BaseConfig;
	public $boardingConfig = [];
	/**
	* Create a new controller instance.
	*
	* @return void
	*/
	public function __construct(
		public TownService		$townService
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
		$cities	= $this->townService->getAll();
		return CityResource::collection($cities);
	}

	/**
	* Show a city page
	* @param  string  $name
	* @return \Illuminate\Http\Response
	*/
	public function getCityByName($name)
	{
		$city	= $this->townService->getByName($name);
		$city	= $this->townService->getPictureLink($city, $this->boardConfig['foto_width_town_id'], $this->boardConfig['foto_height_town_id']);
		return new CityFullResource($city);
	}
}