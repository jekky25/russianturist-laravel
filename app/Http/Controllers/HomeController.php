<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Services\HotelService;
use App\Services\CountryService;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Traits\BaseConfig;

use App\Models\User;
use App\Models\Hotel;
use App\Models\Foto;
use App\Models\Country;

class HomeController extends Controller
{
	use BaseConfig;
	public $boardingConfig 	= [];
	private $countHotels 	= 5;
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
		$this->boardConfig = $this->getBoardConfig();
	}

    /**
     * Show the application dashboard.
	 * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function index(Request $request)
	{
		$hotels			= $this->hotelService->getByLimit($this->countHotels);
		$countries		= $this->countryService->getAll();
		
		$arMeta = [];

		$title 		= 'Страны, русский турист, сайт про туризм и путешествия';
		$arMeta = [
			'title' => $title
		];

		$boardConfig = $this->boardConfig;

		$data = [
			'boardConfig'	=> $boardConfig,
			'arMeta'		=> $arMeta,
			'countries'		=> $countries,
			'hotels'		=> $hotels,
		];
		return response()->view('home', $data);
	}
}
