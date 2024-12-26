<?php
namespace App\Services;

use App\Traits\TStr;
use App\Models\Hotel;

class HotelService
{
	use TStr;
	public $hotels;
	public $selectedPicture = 0;

	/**
	 * get all hotels
	 * @return \Illuminate\Database\Eloquent\Collection 
	*/
	public function getAll()
	{
		$this->hotels = Hotel::select('*')->orderBy('name')->get();
		foreach ($this->hotels as &$row)
		{
			$this->getFotos($row);
		}
		unset ($row);
		return $this->hotels;
	}

	/**
	* get hotels by limit
	* @param  int  $limit
	* @return \Illuminate\Database\Eloquent\Collection 
	*/
	public function getByLimit($limit)
	{
		$this->hotels = Hotel::select('*')->orderBy('create_time','desc')->limit($limit)->get();
		foreach ($this->hotels as &$row)
		{
			$this->getFotos($row);
		}
		unset ($row);
		return $this->hotels;
	}

	/**
	* get hotel by name
	* @param  string  $name
	* @param  int  $pictureId
	* @return \Illuminate\Database\Eloquent\Collection 
	*/
	public function getByName($name)
	{
		$hotel = Hotel::select('*')
			->where('slug', $name)
			->firstOrFail();

		$hotel->description	= $this->replaceSpaces($hotel->description);
		$hotel->town				= $hotel->town()->first();

		$this->hotels = $hotel;
		$this->getFotos($this->hotels, 3);
		$this->getPicturesBlockLink();
		$this->getPictureParams();
		$this->getSliderParams();


		return $this->hotels;
	}

	/**
	* get hotel by name and selected picture
	* @param  string  $name
	* @param  int  $pictureId
	* @return \Illuminate\Database\Eloquent\Collection 
	*/
	public function getByNameSelectedPicture($name, $pictureId = 0)
	{
		$this->selectedPicture = $pictureId > 0 ? $pictureId : 0;
		$this->getByName($name);
		return $this->hotels;
	}

	/**
	* get hotel of the country
	* @param  int  $countryId
	* @param  int  $offset
	* @param  int  $limit
	* @return \Illuminate\Database\Eloquent\Collection 
	*/
	public function getOfCountry($countryId, $offset, $limit)
	{
		$this->hotels = Hotel::select('*')
		->where('country_id', $countryId)
		->orderBy('create_time','desc')
		->offset($offset)
		->limit($limit)
		->get();

		foreach ($this->hotels as &$row)
		{
			$this->getFotos($row);
		}
		unset ($row);
		return $this->hotels;
	}

	/**
	* get hotel of the town
	* @param  int  $townId
	* @param  int  $offset
	* @param  int  $limit
	* @return \Illuminate\Database\Eloquent\Collection 
	*/
	public function getOfTown($townId, $offset, $limit)
	{
		$this->hotels = Hotel::select('*')
		->where('town_id', $townId)
		->orderBy('create_time','desc')
		->offset($offset)
		->limit($limit)
		->get();
		foreach ($this->hotels as &$row)
		{
			$this->getFotos($row);
		}
		unset ($row);
		return $this->hotels;
	}

	/**
	* add fotos to the object
	* @return void
	*/
	public function getFotos(&$row, $limit = 1)
	{
		$foto = $row->fotos()
			->where('type','hotel')
			->orderBy('position')
			->limit($limit)
			->get();
		if ($limit > 1)	
		{
			$row->fotos	= $foto;
			return;
		}
		$row['fotos'] = $foto;
		$stars = '';
		$row['stars'] = intval ($row['stars']);
			for ($j = 0; $j < $row['stars']; $j++) {
				$stars .= '<img alt="" src="' . asset('image/star.png') . '" />';
			}
			$row['starsStr']	= $row['stars'] = $stars;
			$row['fotoStr']		= !empty ($row['fotos']) ? asset('fotos/hotels/' . $row['fotos'][0]['id'] . '.jpg') : asset ('image/no_foto.jpg');
	}

	/**
	* get a link of the pictures block
	* @return void
	*/
	private function getPicturesBlockLink()
	{
		$hotel = &$this->hotels;
		$hotel->hotel_fotos_enter = !empty($hotel->fotos) ? '<a href="' . route('hotel_fotos',[$hotel->slug,'_foto']) . '" alt="' . $hotel->name . '" title="' . $hotel->name . '">Фотографии отеля</a>' : '';
		unset ($hotel);
	}

	/**
	* get a link of the picture 
	* @param  int  $pictureId
	* @return string
	*/
	private function getPictureLink($pictureId)
	{
		return asset('/fotos/hotels/' . $pictureId . '.jpg');
	}
	/**
	* get picture params
	* @return void
	*/
	private function getPictureParams()
	{
		foreach ($this->hotels->fotos as $k => &$row)
		{
			$row['f_act']		= $this->getPictureActiveClass($k);
			$row['foto_out']	= $this->getPictureLink($row['id']);
		}
	}


	/**
	* get slider of the pictures params
	* @return void
	*/
	private function getSliderParams()
	{
		$id = $this->selectedPicture;
		foreach ($this->hotels->fotos as $k => &$row)
		{
			$row['f_act'] = '';
			if ( ($id == 0 && $k == 0) || $id > 0 && $id == $row['id'])
			{
				$row['f_act']	 		= 'f_act';
				$this->hotels->selFoto 		= $row;
				$this->hotels->prevFoto		= $k > 0 ? $this->hotels->fotos[($k-1)] : [];
				$this->hotels->nextFoto		= ($k + 1) < count(($this->hotels->fotos) ) ? $this->hotels->fotos[($k+1)] : [];
				$this->hotels->positionFoto	= ($k + 1);
			}
			$row['foto_out'] = asset('/fotos/hotels/' . $row['id'] . '.jpg');
		}
		$this->hotels->countFoto	= count($this->hotels->fotos);
	}

	/**
	* get a class of the active picture
	* @param  int  $iteration
	* @return string
	*/
	private function getPictureActiveClass($iteration)
	{
		return ($iteration == 0) ? 'f_act' : '';
	}
}