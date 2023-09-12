<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Country;
use App\Models\Hotel;
use App\Models\Item;

class ItemController extends Controller
{
	public $boardingConfig 	= [];
	public $countPerPage 	= 30;
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

		$items		= Item::select('*')->orderBy('items_time')->paginate($this->countPerPage);
		$countries	= Country::select('*')->orderBy('countries_name')->get();
		$pagination = $items->toArray()['links'];
		$pagination[0] = str_replace (' Previous','', $pagination[0]);
		$ind = count ($pagination) - 1;
		$pagination[$ind] = str_replace ('Next ','', $pagination[$ind]);

		foreach ($items as &$row) 
		{
		
			$foto = $row->fotos()
				->where('foto_type','item')
				->orderBy('foto_position')
				->first();
			$row['fotos'] = $foto;
		
			$stars = '';
			$row['fotoStr']		= !empty ($row['fotos']) ? asset('fotos/items/' . $row['fotos']['foto_id'] . '.jpg') : asset ('image/no_foto.jpg');
		}

		$title 		= 'Статьи, русский турист, сайт про туризм и путешествия';

		$arMeta = [
			'title' => $title
		];

		return view('items')
		->with(compact('boardConfig'))
		->with(compact('items'))
		->with(compact('countries'))
		->with(compact('pagination'))
		->with(compact('arMeta'));
	}
}