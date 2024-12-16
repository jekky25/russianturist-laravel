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
			'id'			=> $this->id,
			'name'			=> $this->name,
			'slug'			=> $this->slug,
			'img'			=> $this->towns_img,
			'description'	=> $this->description,
			'country'		=> new CountryShortResource($this->country)
		];
	}
}
