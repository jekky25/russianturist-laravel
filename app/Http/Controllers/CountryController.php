<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Country;

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
     *
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
}
