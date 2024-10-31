<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Helpers\Helper;

class HotelResource extends JsonResource
{
	const DESCRIPTION_SIZE	= 300;
	
	/**
	* Transform the resource into an array.
	*
	* @return array<string, mixed>
	*/
	public function toArray(Request $request): array
	{
		return [
			'id'			=> $this->hotels_id,
			'name'			=> $this->hotels_name,
			'slug'			=> $this->hotels_eng_name,
			'fotoStr'		=> $this->fotoStr,
			'description'	=> Helper::cutText($this->hotels_description, self::DESCRIPTION_SIZE),
		];
	}
}
