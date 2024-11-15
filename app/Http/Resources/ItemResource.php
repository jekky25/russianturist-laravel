<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Helpers\Helper;

class ItemResource extends JsonResource
{
	const DESCRIPTION_SIZE	= 300;

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
			'fotoStr'		=> $this->fotoStr,
			'description'	=> Helper::cutText($this->items_description, self::DESCRIPTION_SIZE),
		];
	}
}
