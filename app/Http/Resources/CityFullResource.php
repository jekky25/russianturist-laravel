<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CountryShortResource;

class CityFullResource extends JsonResource
{
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
			'img'			=> $this->towns_img,
			'description'	=> $this->towns_description,
			'country'		=> new CountryShortResource($this->country)
		];
	}
}
