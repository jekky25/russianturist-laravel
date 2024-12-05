<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CountryFullResource extends JsonResource
{
	/**
	* Transform the resource into an array.
	*
	* @return array<string, mixed>
	*/
	public function toArray(Request $request): array
	{
		return [
			'id'			=> $this->countries_id,
			'name'			=> $this->name,
			'slug'			=> $this->slug,
			'img'			=> $this->countries_img,
			'description'	=> $this->description
		];
	}
}
