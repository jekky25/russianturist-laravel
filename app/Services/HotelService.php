<?php
namespace App\Services;

use App\Models\Hotel;

class HotelService
{
	public $hotels = [];

	/**
	 * get hotel of the country
	 * @param  int  $countryId
	 * @param  int  $offset
	 * @param  int  $limit
	 * @return \Illuminate\Database\Eloquent\Collection 
	*/
	public function getOfCountry($countryId, $offset, $limit)
	{
		return Hotel::select('*')
		->where('countries_id', $countryId)
		->orderBy('hotels_time','desc')
		->offset($offset)
		->limit($limit)
		->get();
	}

	/**
	 * add fotos to the object
	 * @return void
	*/
	public function addFotos()
	{
		foreach ($this->hotels as &$row)
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
	}
}