<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Services\CountryService;
use App\Services\HotelService;
use App\Traits\BaseConfig;
use App\Traits\Picture;

class HotelController extends Controller
{
	use BaseConfig, Picture;
	public $boardingConfig = [];
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function index(Request $request)
	{
		$boardConfig 	= $this->boardConfig;
		$countries		= $this->countryService->getAll();
		$hotels			= $this->hotelService->getAll();

		$arMeta = [];

		$title 		= 'Отели, русский турист, сайт про туризм и путешествия';

		$arMeta = [
			'title' => $title
		];

		$data = [
			'boardConfig'	=> $boardConfig,
			'arMeta'		=> $arMeta,
			'hotels'		=> $hotels,
			'countries'		=> $countries,
		];
		return response()->view('hotels', $data);
	}

	/**
     * Show a hotel page
	 * @param  \Illuminate\Http\Request  $request
	 * @param  string  $name
     * @return \Illuminate\Http\Response
     */
	public function getHotel (Request $request, $name)
	{
		$boardConfig 				= $this->boardConfig;
		$hotel						= $this->hotelService->getByName($name);
		$countries					= $this->countryService->getAll();
		if (empty ($hotel)) abort(404);
		
		$hotel->hotels_description 	= \App\Providers\SapeServiceProvider::replaceSapeCode($hotel->hotels_description);

		$arMeta 					= [];
		$title 						= $hotel['hotels_name'] . ', отель ' . $hotel['hotels_name'] . ', русский турист, сайт про туризм и путешествия';
		$arMeta = [
			'title' => $title
		];

		\App\Providers\SapeServiceProvider::getSapeCode();
		
		$data = [
			'boardConfig'	=> $boardConfig,
			'arMeta'		=> $arMeta,
			'hotel'			=> $hotel,
			'countries'		=> $countries,
		];
		return response()->view('hotel_id', $data);
	}

	/**
     * Show a photos of hotel page
	 * @param  \Illuminate\Http\Request  $request
	 * @param  string  $name
	 * @param  string  $foto
	 * @param  int     $id
     * @return \Illuminate\Http\Response
     */
	public function getHotelFotos (Request $request, $name, $foto, $id=0)
	{
		$boardConfig 							= $this->boardConfig;
		$this->hotelService->selectedPicture	= $id;
		$hotel									= $this->hotelService->getByName($name);
		$countries								= $this->countryService->getAll();

		//draw width and height of the picture
		$resultIm								= $this->getSizeParams($hotel->selFoto['foto_id'], $boardConfig['max_foto_width_big']);

		$arMeta 					= [];
		$title = $hotel['hotels_name'] . ', отель ' . $hotel['hotels_name'] . ', русский турист, сайт про туризм и путешествия';
		$arMeta = [
			'title' => $title
		];
		
		$data = [
			'boardConfig'	=> $boardConfig,
			'arMeta'		=> $arMeta,
			'hotel'			=> $hotel,
			'countries'		=> $countries,
			'resultX_im'	=> $resultIm['resultX_im_l'],
			'resultY_im'	=> $resultIm['resultY_im_l']
		];
		return response()->view('hotel_foto', $data);
	}

}