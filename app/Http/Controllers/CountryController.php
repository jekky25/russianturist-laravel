<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Services\CountryService;
use App\Services\HotelService;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Traits\BaseConfig;
use App\Models\Country;
use App\Models\Hotel;

class CountryController extends Controller
{
	use BaseConfig;
	public $boardingConfig = [];
    /**
     * Create a new controller instance.
     *
     * @return void
     */
	public function __construct(
		public CountryService $countryService,
		public HotelService $hotelService
	)
	{
		// $this->middleware('auth');
		$this->boardConfig = $this->getBoardConfig();
	}

    /**
     * Show the application dashboard.
	 * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function index(Request $request)
	{
		$boardConfig = $this->boardConfig;
		$arMeta = [];

		$title 		= 'Страны, русский турист, сайт про туризм и путешествия';

		$arMeta = [
			'title' => $title
		];
		$countries	= $this->countryService->getAll();
		$data = [
			'boardConfig'	=> $boardConfig,
			'arMeta'		=> $arMeta,
			'countries'		=> $countries,
		];
		return response()->view('countries', $data);
	}

	/**
     * Show a country page
	 * @param  \Illuminate\Http\Request  $request
	 * @param  string  $name
     * @return \Illuminate\Http\Response
     */
	public function getCountry (Request $request, $name)
	{
		$boardConfig = $this->boardConfig;
		$arMeta = [];

		$country					= $this->countryService->getByName($name);
		$orderBy					= 'countries_name';
		$countries					= $this->countryService->getAll($orderBy);
		$this->hotelService->hotels	= $this->hotelService->getOfCountry($country['countries_id'], 0, $boardConfig['limit_out_hotels']);
		$this->hotelService->addFotos();
		
		$title		= $country['countries_name'] . ', страна ' . $country['countries_name'] . ', русский турист, сайт про туризм и путешествия';
		$arMeta = [
			'title' => $title
		];
		
		$foto_out = asset('fotos/countries/'. $country['foto']['foto_id'] . '.jpg');

		$country['countries_img'] = !empty($foto_out) ? '<img title="' . $country['countries_name'] . '" alt="' . $country['countries_name'] . '" src="' . $foto_out . '" width="' . $boardConfig['foto_width_country_id'] . '" height="' . $boardConfig['foto_height_country_id'] . '">' : '';
		$country['countries_description'] = str_replace("\n", "\n<br />\n", $country['countries_description']);

		$data = [
			'boardConfig'	=> $boardConfig,
			'arMeta'		=> $arMeta,
			'country'		=> $country,
			'countries'		=> $countries,
			'hotels'		=> $this->hotelService->hotels
		];
		return response()->view('country_id', $data);
	}
}
