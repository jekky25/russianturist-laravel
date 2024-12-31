<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Traits\TStr;

class ItemFullResource extends JsonResource
{
	use TStr;
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
			'description'	=> $this->replaceSpaces($this->description),
			'img'			=> $this->items_img
		];
	}
}
