<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;

use App\Models\User;
use App\Models\Hotel;
use App\Models\Foto;
use App\Models\Country;

class HomeController extends Controller
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
		$arMeta = [];

		$title 		= 'Страны, русский турист, сайт про туризм и путешествия';
		$hotels 	= Hotel::select('*')->orderBy('hotels_time','desc')->limit(5)->get();
		$countries	= Country::select('*')->orderBy('countries_name')->get();

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

		$arMeta = [
			'title' => $title
		];

		$boardConfig = $this->boardConfig;
		
		return view('home')
		->with(compact('arMeta'))
		->with(compact('boardConfig'))
		->with(compact('countries'))
		->with(compact('hotels'));
	}
}
