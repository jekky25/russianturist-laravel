<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CityShortResource extends JsonResource
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
			'slug'			=> $this->slug,
		];
	}
}
