<?php
namespace App\Services;

use App\Traits\TStr;
use App\Models\Hotel;
use App\Services\ImageService;
use Illuminate\Support\Facades\DB;

class HotelService
{
	use TStr;
	public $hotels;
	public $selectedPicture = 0;

	public function __construct(
		private CityService $city,
		private ImageService $image
	)
	{
	}

	/**
	 * get all hotels
	 * @return \Illuminate\Database\Eloquent\Collection 
	*/
	public function getAll()
	{
		$this->hotels = Hotel::select('*')->with(['pictures'])->orderBy('name')->get();
		return $this->hotels;
	}

	/**
	* get hotel by id
	* @return \Illuminate\Database\Eloquent\Collection 
	*/
	public function getById($id)
	{
		return Hotel::select('*')
			->where('id', $id)
			->with(['city', 'pictures'])
			->firstOrFail();
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
			$this->getPictures($row);
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
		$hotel->city				= $hotel->city()->first();

		$this->hotels = $hotel;
		$this->getPictures($this->hotels, 3);
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
			$this->getPictures($row);
		}
		unset ($row);
		return $this->hotels;
	}

	/**
	* get hotel of the city
	* @param  int  $cityId
	* @param  int  $offset
	* @param  int  $limit
	* @return \Illuminate\Database\Eloquent\Collection 
	*/
	public function getOfCity($cityId, $offset, $limit)
	{
		$this->hotels = Hotel::select('*')
		->where('city_id', $cityId)
		->orderBy('create_time','desc')
		->offset($offset)
		->limit($limit)
		->get();
		foreach ($this->hotels as &$row)
		{
			$this->getPictures($row);
		}
		unset ($row);
		return $this->hotels;
	}

	/**
	* add pictures to the object
	* @return void
	*/
	public function getPictures(&$row, $limit = 1)
	{
		$picture = $row->pictures()
			->where('type','hotel')
			->orderBy('position')
			->limit($limit)
			->get();
		if ($limit > 1)	
		{
			$row->pictures	= $picture;
			return;
		}
		$row['pictures'] = $picture;
		$stars = '';
		$row['stars'] = intval ($row['stars']);
			for ($j = 0; $j < $row['stars']; $j++) {
				$stars .= '<img alt="" src="' . asset('image/star.png') . '" />';
			}
			$row['starsStr']	= $row['stars'] = $stars;
			$row['pictureStr']		= !empty ($row['pictures']) ? asset('fotos/hotels/' . $row['pictures'][0]['id'] . '.jpg') : asset ('image/no_foto.jpg');
	}

	/**
	* get a link of the pictures block
	* @return void
	*/
	private function getPicturesBlockLink()
	{
		$hotel = &$this->hotels;
		$hotel->hotel_pictures_enter = !empty($hotel->pictures) ? '<a href="' . route('hotel_pictures',[$hotel->slug,'_picture']) . '" alt="' . $hotel->name . '" title="' . $hotel->name . '">Фотографии отеля</a>' : '';
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
		foreach ($this->hotels->pictures as $k => &$row)
		{
			$row['f_act']		= $this->getPictureActiveClass($k);
			$row['picture_out']	= $this->getPictureLink($row['id']);
		}
	}


	/**
	* get slider of the pictures params
	* @return void
	*/
	private function getSliderParams()
	{
		$id = $this->selectedPicture;
		foreach ($this->hotels->pictures as $k => &$row)
		{
			$row['f_act'] = '';
			if ( ($id == 0 && $k == 0) || $id > 0 && $id == $row['id'])
			{
				$row['f_act']	 		= 'f_act';
				$this->hotels->selPicture 		= $row;
				$this->hotels->prevPicture		= $k > 0 ? $this->hotels->pictures[($k-1)] : [];
				$this->hotels->nextPicture		= ($k + 1) < count(($this->hotels->pictures) ) ? $this->hotels->pictures[($k+1)] : [];
				$this->hotels->positionPicture	= ($k + 1);
			}
			$row['picture_out'] = asset('/fotos/hotels/' . $row['id'] . '.jpg');
		}
		$this->hotels->countPicture	= count($this->hotels->pictures);
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


	/**
	 * get an array of the stars from the model class
	 * @return array
	 */
	public function getAllStars()
	{
		return Hotel::STARS;
	}

	/**
	* create a hotel
	* @param  array $request
	* @return void
	*/	
	public function create($request) 
	{
		try {
			DB::beginTransaction();
			$city = $this->city->getById($request['city_id']);
			$request['country_id']	= $city->country_id;
			$request['create_time']	= time();
			$hotel = Hotel::create($request);
			$this->image->create($hotel->id, Hotel::class, $request['image']);
			DB::commit();
		} catch (\Exception $e) {
			DB::rollBack();
			throw new \Exception('Failed to create a Hotel '.$e->getMessage());
		}
	}

	/**
	* update a hotel
	* @param array $request
	* @return void
	*/	
	public function update($id, $request)
	{
		try {
			DB::beginTransaction();
			$hotel = Hotel::find($id);
			$hotel->update($request);
			if (!empty($request['image'])) $this->image->create($hotel->id, Hotel::class, $request['image']);
			DB::commit();
		} catch (\Exception $e) {
			DB::rollBack();
			throw new \Exception('Failed to update the Hotel. '.$e->getMessage());
		}
	}

	/**
	* delete a hotel
	* @param  id $id
	* @return void
	*/
	public function destroy($id) {
		try {
			$hotel = Hotel::find($id);
			if ($hotel->pictures->count() > 0)
			{
				foreach ($hotel->pictures as $picture)
				{
					$this->image->destroyPicture($picture);
				}
			}
			$hotel->delete();
		} catch (\Exception $e) {
			throw new \Exception('Failed to delete Hotel . '.$e->getMessage());
		}
	}
}