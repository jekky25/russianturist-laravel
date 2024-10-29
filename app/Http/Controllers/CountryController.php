<?php
namespace App\Http\Controllers;

use App\Services\CountryService;
use App\Services\HotelService;
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
		public HotelService 	$hotelService
	)
	{
		$this->boardConfig = $this->getBoardConfig();
	}

	/**
	* Show the application dashboard.
	* @return \Illuminate\Http\Response
	*/
	public function index()
	{
		$arMeta = [];
		$title 		= 'Страны, русский турист, сайт про туризм и путешествия';

		$arMeta = [
			'title' => $title
		];
		$countries	= $this->countryService->getAll();
		$data = [
			'boardConfig'	=> $this->boardConfig,
			'arMeta'		=> $arMeta,
			'countries'		=> $countries,
		];
		return response()->view('countries', $data);
	}

	/**
	* Show a country page
	* @param  string  $name
	* @return \Illuminate\Http\Response
	*/
	public function getCountry($name)
	{
		$arMeta = [];
		$country					= $this->countryService->getByName($name);
		$orderBy					= 'countries_name';
		$countries					= $this->countryService->getAll($orderBy);
		$this->hotelService->hotels	= $this->hotelService->getOfCountry($country['countries_id'], 0, $this->boardConfig['limit_out_hotels']);
		
		$title		= $country['countries_name'] . ', страна ' . $country['countries_name'] . ', русский турист, сайт про туризм и путешествия';
		$arMeta = [
			'title' => $title
		];

		$data = [
			'boardConfig'	=> $this->boardConfig,
			'arMeta'		=> $arMeta,
			'country'		=> $country,
			'countries'		=> $countries,
			'hotels'		=> $this->hotelService->hotels
		];
		return response()->view('country_id', $data);
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
