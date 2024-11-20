<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\BaseConfig;

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
	)
	{
	}
}