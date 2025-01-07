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
			'id'				=> $this->id,
			'name'				=> $this->name,
			'slug'				=> $this->slug,
			'img'				=> $this->img,
			'description'		=> $this->description,
			'city'				=> new CityShortResource($this->city),
			'pictures'			=> PictureResource::collection($this->pictures),
			'pictureSelected'	=> !empty($this->selPicture)		? new PictureResource($this->selPicture)	: null,
			'picturePosition'	=> !empty($this->positionPicture)	? $this->positionPicture					: null,
			'pictureNext'		=> !empty($this->nextPicture)		? new PictureResource($this->nextPicture)	: null,
			'picturePrev'		=> !empty($this->prevPicture)		? new PictureResource($this->prevPicture)	: null,
			'pictureCount'		=> !empty($this->countPicture)		? (int) $this->countPicture					: 0,
		];
	}
}
