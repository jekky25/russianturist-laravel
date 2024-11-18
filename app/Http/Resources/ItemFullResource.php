<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Traits\Tstr;

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
			'id'			=> $this->items_id,
			'name'			=> $this->items_name,
			'description'	=> $this->replaceSpaces($this->items_description),
			'img'			=> $this->items_img
		];
	}
}
