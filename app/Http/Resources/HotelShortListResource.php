<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Helpers\Helper;

class HotelShortListResource extends JsonResource
{
	const NAME_SIZE			= 40;
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
			'shortName'		=> Helper::cutText($this->hotels_name, self::NAME_SIZE),
			'slug'			=> $this->hotels_eng_name,
			'description'	=> Helper::cutText($this->hotels_description, self::DESCRIPTION_SIZE),
			'fotoStr'		=> $this->fotoStr,
			'starsStr'		=> $this->starsStr
		];
	}
}
