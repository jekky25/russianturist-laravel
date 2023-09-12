<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Hotel;
use App\Models\Country;
use App\Models\Town;

class TownController extends Controller
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

		$title 		= 'Города, русский турист, сайт про туризм и путешествия';

		$arMeta = [
			'title' => $title
		];

		$countries	= Country::getAll();
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

		return view('towns')
		->with(compact('boardConfig'))
		->with(compact('arMeta'))
		->with(compact('towns'))
		->with(compact('countries'));
	}


}
