<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CityShortResource;
use App\Http\Resources\PictureResource;

class HotelFullResource extends JsonResource
{
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
			'img'			=> $this->hotels_img,
			'description'	=> $this->hotels_description,
			'city'			=> new CityShortResource($this->town),
			'pictures'		=> PictureResource::collection($this->fotos)
		];
	}
}
