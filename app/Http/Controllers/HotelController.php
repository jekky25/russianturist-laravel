<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\CountryService;
use App\Services\HotelService;
use App\Http\Resources\HotelShortListResource;
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
		public CountryService $countryService,
		public HotelService $hotelService,
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
		$countries			= $this->countryService->getAll();
		$hotels				= $this->hotelService->getAll();
		$title				= 'Отели, русский турист, сайт про туризм и путешествия';
		$data = [
			'boardConfig'	=> $this->boardConfig,
			'arMeta'		=> ['title' => $title],
			'hotels'		=> $hotels,
			'countries'		=> $countries,
		];
		return response()->view('hotels', $data);
	}

	/**
	* Show a hotel page
	* @param  string  $name
	* @return \Illuminate\Http\Response
	*/
	public function getHotel($name)
	{
		$hotel						= $this->hotelService->getByName($name);
		$countries					= $this->countryService->getAll();
		if (empty ($hotel)) abort(404);
		$title 						= $hotel['hotels_name'] . ', отель ' . $hotel['hotels_name'] . ', русский турист, сайт про туризм и путешествия';

		\App\Providers\SapeServiceProvider::getSapeCode();
		
		$data = [
			'boardConfig'	=> $this->boardConfig,
			'arMeta'		=> ['title' => $title],
			'hotel'			=> $hotel,
			'countries'		=> $countries,
		];
		return response()->view('hotel_id', $data);
	}

	/**
	* Show a photos of hotel page
	* @param  string  $name
	* @param  string  $foto
	* @param  int     $id
	* @return \Illuminate\Http\Response
	*/
	public function getHotelFotos($name, $foto, $id=0)
	{
		$this->hotelService->selectedPicture	= $id;
		$hotel									= $this->hotelService->getByName($name);
		$countries								= $this->countryService->getAll();
		//draw width and height of the picture
		$resultIm								= $this->getSizeParams($hotel->selFoto['foto_id'], $this->boardConfig['max_foto_width_big']);
		$title 									= $hotel['hotels_name'] . ', отель ' . $hotel['hotels_name'] . ', русский турист, сайт про туризм и путешествия';
		$data = [
			'boardConfig'	=> $this->boardConfig,
			'arMeta'		=> ['title' => $title],
			'hotel'			=> $hotel,
			'countries'		=> $countries,
			'resultX_im'	=> $resultIm['resultX_im_l'],
			'resultY_im'	=> $resultIm['resultY_im_l']
		];
		return response()->view('hotel_foto', $data);
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
}