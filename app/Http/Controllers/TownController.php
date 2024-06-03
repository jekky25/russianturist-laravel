<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Services\CountryService;
use App\Traits\BaseConfig;
use App\Models\Hotel;
use App\Models\Country;
use App\Models\Town;

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
		public CountryService $countryService
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

		$title 		= 'Города, русский турист, сайт про туризм и путешествия';

		$arMeta = [
			'title' => $title
		];

		$countries		= $this->countryService->getAll();
		$towns		= Town::select('*')->orderBy('towns_name')->get();

		foreach ($towns as &$row) 
		{
			$foto = $row->fotos()
				->where('foto_type','town')
				->orderBy('foto_position')
				->first();
			$row['fotos'] = $foto;
		
			$stars = '';
			$row['fotoStr']		= !empty ($row['fotos']) ? asset('fotos/towns/' . $row['fotos']['foto_id'] . '.jpg') : asset ('image/no_foto.jpg');
		}

		$sapeCode 	= \App\Providers\SapeServiceProvider::getSapeCode();


		return view('towns')
		->with(compact('boardConfig'))
		->with(compact('arMeta'))
		->with(compact('towns'))
		->with(compact('countries'));
	}

	/**
     * Show a town page
	 * @param  \Illuminate\Http\Request  $request
	 * @param  string  $name
     * @return \Illuminate\Http\Response
     */
	public function getTown (Request $request, $name)
	{
		$boardConfig 				= $this->boardConfig;
		$arMeta 					= [];

		$town						= Town::getByName($name);
		$countries					= Country::select('*')->orderBy('countries_name')->get();

		$foto_out 					= !empty ($town->foto) ? asset('/fotos/towns/' . $town->foto['foto_id'] . '.jpg') : '';
		$town->towns_img 			= !empty($foto_out) ? '<img title="' . $town->towns_name . '" alt="' . $town->towns_name . '" src="' . $foto_out . '" width="' . $boardConfig['foto_width_town_id'] . '" height="' . $boardConfig['foto_height_town_id'] . '">' : '';
		$town->towns_description 	= \App\Providers\SapeServiceProvider::replaceSapeCode($town->towns_description);

		$hotels 			= Hotel::select('*')
		->where('towns_id', $town->towns_id)
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


		$title = $town['towns_name'] . ', ' . $town->country['countries_name'] . ', информация про город, сайт про туризм и путешествия';
		$arMeta = [
			'title' => $title
		];

		return view('town_id')
		->with(compact('boardConfig'))
		->with(compact('arMeta'))
		->with(compact('town'))
		->with(compact('countries'))
		->with(compact('hotels'))
;
	}

}
