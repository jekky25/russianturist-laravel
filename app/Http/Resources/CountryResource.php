<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Helpers\Helper;

class CountryResource extends JsonResource
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
			'id'			=> $this->countries_id,
			'name'			=> $this->countries_name,
			'slug'			=> $this->countries_eng_name,
			'fotoStr'		=> $this->fotoStr,
			'description'	=> Helper::cutText($this->countries_description, self::DESCRIPTION_SIZE),
		];
	}
}
