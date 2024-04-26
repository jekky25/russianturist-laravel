<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Country;
use App\Models\Hotel;

class CountryController extends Controller
{
	public $boardingConfig = [];
    /**
     * Create a new controller instance.
     *
     * @return void
     */
	public function __construct()
	{
		// $this->middleware('auth');
		$this->boardConfig = getBoardConfig();
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

		$countries	= Country::getAll();

		return view('countries')
		->with(compact('boardConfig'))
		->with(compact('arMeta'))
		->with(compact('countries'));
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

		$country	= Country::getByName($name);
		$countries	= Country::select('*')->orderBy('countries_name')->get();
		$hotels 	= Hotel::select('*')
					->where('countries_id', $country['countries_id'])
					->orderBy('hotels_time','desc')
					->offset(0)
					->limit($boardConfig['limit_out_hotels'])
					->get();

		foreach ($hotels as &$row) 
		{
		
			$foto = $row->fotos()
				->where('foto_type','hotel')
				->orderBy('foto_position')
				->limit(1)
				->get();
			$row['fotos'] = $foto;
		
			$stars = '';
			$row['stars'] = intval ($row['stars']);
			for ($j = 0; $j < $row['stars']; $j++) {
				$stars .= '<img alt="" src="' . asset('image/star.png') . '" />';
			}
			$row['starsStr'] 	= $stars;
			$row['fotoStr'] 	= !empty ($row['fotos']) ? asset('fotos/hotels/' . $row['fotos'][0]['foto_id'] . '.jpg') : asset ('image/no_foto.jpg');
		}

		$title		= $country['countries_name'] . ', страна ' . $country['countries_name'] . ', русский турист, сайт про туризм и путешествия';
		$arMeta = [
			'title' => $title
		];
		
		$foto_out = asset('fotos/countries/'. $country['foto']['foto_id'] . '.jpg');

		$country['countries_img'] = !empty($foto_out) ? '<img title="' . $country['countries_name'] . '" alt="' . $country['countries_name'] . '" src="' . $foto_out . '" width="' . $boardConfig['foto_width_country_id'] . '" height="' . $boardConfig['foto_height_country_id'] . '">' : '';
		$country['countries_description'] = str_replace("\n", "\n<br />\n", $country['countries_description']);


		return view('country_id')
		->with(compact('boardConfig'))
		->with(compact('arMeta'))
		->with(compact('country'))
		->with(compact('countries'))
		->with(compact('hotels'));
	}
}
