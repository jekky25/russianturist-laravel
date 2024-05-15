<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Traits\BaseConfig;
use App\Models\Hotel;
use App\Models\Country;
use App\Models\Town;

class HotelController extends Controller
{
	use BaseConfig;
	public $boardingConfig = [];
    /**
     * Create a new controller instance.
     *
     * @return void
     */
	public function __construct()
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

	/**
     * Show a hotel page
	 * @param  \Illuminate\Http\Request  $request
	 * @param  string  $name
     * @return \Illuminate\Http\Response
     */
	public function getHotel (Request $request, $name)
	{
		$boardConfig 				= $this->boardConfig;
		$arMeta 					= [];

		$hotel						= Hotel::getByName($name);

		if (empty ($hotel)) abort(404);

		$countries					= Country::select('*')->orderBy('countries_name')->get();
		$town						= Town::select('*')->where('towns_id', $hotel['towns_id'])->first();
		
		$hotel->town				= $town;

		$hotel->hotel_fotos_enter 	= !empty($hotel->fotos) ? '<a href="' . route('hotel_fotos',[$hotel['hotels_eng_name'],'_foto']) . '" alt="' . $hotel['hotels_name'] . '" title="' . $hotel['hotels_name'] . '">Фотографии отеля</a>' : '';
		$hotel->hotels_description 	= \App\Providers\SapeServiceProvider::replaceSapeCode($hotel->hotels_description);
			
		foreach ($hotel->fotos as $k => &$row)
		{
			$row['f_act']	 = ($k == 0) ? 'class="f_act"' : '';
			$row['foto_out'] = asset ('/fotos/hotels/' . $row['foto_id'] . '.jpg');
		}
		


		$title = $hotel['hotels_name'] . ', отель ' . $hotel['hotels_name'] . ', русский турист, сайт про туризм и путешествия';
		$arMeta = [
			'title' => $title
		];

		\App\Providers\SapeServiceProvider::getSapeCode();
		
		return view('hotel_id')
		->with(compact('boardConfig'))
		->with(compact('arMeta'))
		->with(compact('hotel'))
		->with(compact('countries'))
;
	}

	/**
     * Show a photos of hotel page
	 * @param  \Illuminate\Http\Request  $request
	 * @param  string  $name
	 * @param  string  $foto
	 * @param  int     $id
     * @return \Illuminate\Http\Response
     */
	public function getHotelFotos (Request $request, $name, $foto, $id=0)
	{
		$boardConfig 				= $this->boardConfig;
		$arMeta 					= [];

		$hotel						= Hotel::getByName($name);
		$countries					= Country::select('*')->orderBy('countries_name')->get();
		$town						= Town::select('*')->where('towns_id', $hotel['towns_id'])->first();
		
		$hotel->town				= $town;

		$hotel->hotel_fotos_enter 	= !empty($hotel->fotos) ? '<a href="' . route('hotel_fotos',[$hotel['hotels_eng_name'],'_foto']) . '" alt="' . $hotel['hotels_name'] . '" title="' . $hotel['hotels_name'] . '">Фотографии отеля</a>' : '';

	
		foreach ($hotel->fotos as $k => &$row)
		{
			$row['f_act'] = '';
			if ( ($id == 0 && $k == 0) || $id > 0 && $id == $row['foto_id'])
			{
				$row['f_act']	 		= 'class="f_act"';
				$hotel->selFoto 		= $row;
				$hotel->prevFoto		= $k > 0 ? $hotel->fotos[($k-1)] : [];
				$hotel->nextFoto		= ($k + 1) < count (($hotel->fotos) ) ? $hotel->fotos[($k+1)] : [];
				$hotel->positionFoto	= ($k + 1);
			}
			$row['foto_out'] = asset ('/fotos/hotels/' . $row['foto_id'] . '.jpg');
		}
		$hotel->countFoto	= count ($hotel->fotos);
		
		
		//draw width and height of the picture

		$img = asset ('/fotos/hotels/' . $hotel->selFoto['foto_id'] . '.jpg');

		$im = imagecreatefromjpeg( $img );

		$resultX_im =imageSX($im);
		$resultY_im =imageSY($im);
		$img_koefficient = $resultX_im / $resultY_im;

		$img_width = $boardConfig['max_foto_width_big'];

		if ($resultX_im > $img_width)
		{
			$resultX_im = $img_width;
  			$resultY_im = $resultX_im / $img_koefficient;
		}

		imageDestroy($im);

		$resultX_im_l = $resultX_im - 3;
		if ($resultX_im_l < 0)
			$resultX_im_l = 0;

		$resultY_im_l = $resultY_im - 3;
		if ($resultY_im_l < 0)
  			$resultY_im_l = 0;



		$title = $hotel['hotels_name'] . ', отель ' . $hotel['hotels_name'] . ', русский турист, сайт про туризм и путешествия';
		$arMeta = [
			'title' => $title
		];
		

		$prev 	= 	!empty ($prev) 		?		$prev 	:	'';
		$next 	= 	!empty ($next) 		?		$next 	:	'';



		return view('hotel_foto')
		->with(compact('boardConfig'))
		->with(compact('hotel'))
		->with(compact('resultX_im'))
		->with(compact('resultY_im'))
		->with(compact('arMeta'))
		->with(compact('countries'))
		;
	}

}