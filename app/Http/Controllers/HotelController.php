<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Hotel;
use App\Models\Country;
use App\Models\Town;

class HotelController extends Controller
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
     *
     * @return \Illuminate\Http\Response
     */
	public function index(Request $request)
	{
		$boardConfig = $this->boardConfig;
		$arMeta = [];

		$title 		= 'Отели, русский турист, сайт про туризм и путешествия';

		$arMeta = [
			'title' => $title
		];

		$countries	= Country::getAll();
		$hotels		= Hotel::select('*')->orderBy('hotels_name')->get();

		foreach ($hotels as &$row) 
		{
			$foto = $row->fotos()
				->where('foto_type','hotel')
				->orderBy('foto_position')
				->first();
			$row['fotos'] = $foto;

			$stars = '';
			$row['stars'] = intval ($row['stars']);
			for ($j = 0; $j < $row['stars']; $j++) {
				$stars .= '<img alt="" src="' . asset('image/star.png') . '" />';
			}
			$row['stars'] = $stars;

			$row['fotoStr']		= !empty ($row['fotos']) ? asset('fotos/hotels/' . $row['fotos']['foto_id'] . '.jpg') : asset ('image/no_foto.jpg');
		}

		return view('hotels')
		->with(compact('boardConfig'))
		->with(compact('arMeta'))
		->with(compact('hotels'))
		->with(compact('countries'));
	}


	
}
