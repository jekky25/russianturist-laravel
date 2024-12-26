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
			'id'				=> $this->hotels_id,
			'name'				=> $this->hotels_name,
			'slug'				=> $this->hotels_eng_name,
			'img'				=> $this->hotels_img,
			'description'		=> $this->description,
			'city'				=> new CityShortResource($this->town),
			'pictures'			=> PictureResource::collection($this->fotos),
			'pictureSelected'	=> !empty($this->selFoto)		? new PictureResource($this->selFoto)	: null,
			'picturePosition'	=> !empty($this->positionFoto)	? $this->positionFoto					: null,
			'pictureNext'		=> !empty($this->nextFoto)		? new PictureResource($this->nextFoto)	: null,
			'picturePrev'		=> !empty($this->prevFoto)		? new PictureResource($this->prevFoto)	: null,
			'pictureCount'		=> !empty($this->countFoto)		? (int) $this->countFoto				: 0,
		];
	}
}
