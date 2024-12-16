<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Helpers\Helper;

class CityResource extends JsonResource
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
			'id'			=> $this->towns_id,
			'name'			=> $this->towns_name,
			'slug'			=> $this->towns_eng_name,
			'fotoStr'		=> $this->fotoStr,
			'description'	=> Helper::cutText($this->description, self::DESCRIPTION_SIZE),
		];
	}
}
