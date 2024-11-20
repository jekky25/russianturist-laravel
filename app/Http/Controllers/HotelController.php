<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\HotelService;
use App\Http\Resources\HotelShortListResource;
use App\Http\Resources\HotelResource;
use App\Http\Resources\HotelFullResource;
use App\Traits\BaseConfig;
use App\Traits\Picture;

class HotelController extends Controller
{
	use BaseConfig, Picture;
	public $boardConfig		= [];
	private $countHotels	= 5;
	/**
	* Create a new controller instance.
	*
	* @return void
	*/
	public function __construct(
		public HotelService $hotelService,
	)
	{
		$this->boardConfig = $this->getBoardConfig();
	}

	/**
	* Get a short list of the hotels
	* @param  int     $id
	* @return json
	*/
	public function getHotelShortList($id)
	{
		$hotels	= $id > 0	? $this->hotelService->getOfCountry($id, 0, $this->boardConfig['limit_out_hotels'])
							: $this->hotelService->getByLimit($this->countHotels);
		return HotelShortListResource::collection($hotels);
	}

	/**
	* Get a short list of the hotels by City
	* @param  int     $id
	* @return json
	*/
	public function getHotelShortListByCity($id)
	{
		$hotels	= $id > 0	? $this->hotelService->getOfTown($id, 0, $this->boardConfig['limit_out_hotels'])
							: $this->hotelService->getByLimit($this->countHotels);
		return HotelShortListResource::collection($hotels);
	}

	/**
	* Get all hotels 
	* @return json
	*/
	public function getHotels()
	{
		$hotels = $this->hotelService->getAll();
		return HotelResource::collection($hotels);
	}

	/**
	* Show a hotel page
	* @param  string  $name
	* @return \Illuminate\Http\Response
	*/
	public function getHotelByName($name)
	{
		$hotel = $this->hotelService->getByName($name);
		return new HotelFullResource($hotel);
	}

	/**
	* Show a hotel picture page
	* @param  string  $name
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function getHotelPicture($name, $id=0)
	{
		$hotel = $this->hotelService->getByNameSelectedPicture($name, $id);
		return new HotelFullResource($hotel);
	}
}