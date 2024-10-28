<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\BaseConfig;

class ConfigController extends Controller
{
	use BaseConfig;
	public $boardConfig = [];
	/**
	* Create a new controller instance.
	*
	* @return void
	*/
	public function __construct(
	)
	{
		$this->boardConfig = $this->getBoardConfig();
	}

	/**
	* Get config list
	* @return json
	*/
	public function index()
	{
		return response()->json($this->boardConfig);
	}
}