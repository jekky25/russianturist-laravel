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
			'name'			=> $this->countries_name,
			'slug'			=> $this->countries_eng_name,
			'img'			=> $this->countries_img,
			'description'	=> $this->countries_description
		];
	}
}
