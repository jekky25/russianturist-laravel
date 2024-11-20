<?php
namespace App\Http\Controllers;

use App\Services\CountryService;
use App\Http\Controllers\Controller;
use App\Http\Resources\CountryResource;
use App\Http\Resources\CountryFullResource;
use App\Traits\BaseConfig;

class CountryController extends Controller
{
	use BaseConfig;
	public $boardConfig = [];
	/**
	* Create a new controller instance.
	*
	* @return void
	*/
	public function __construct(
		public CountryService 	$countryService,
	)
	{
		$this->boardConfig = $this->getBoardConfig();
	}

	/**
	* Get all countrires 
	* @return json
	*/
	public function getCountries()
	{
		$countries	= $this->countryService->getAll();		
		return CountryResource::collection($countries);
	}

	/**
	* Show a country page
	* @param  string  $name
	* @return \Illuminate\Http\Response
	*/
	public function getCountryByName($name)
	{
		$country	= $this->countryService->getByName($name);
		return new CountryFullResource($country);
	}
}
