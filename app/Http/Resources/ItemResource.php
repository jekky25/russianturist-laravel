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
			'id'				=> $this->id,
			'name'				=> $this->name,
			'firstImagePath'	=> asset($this->firstImagePath),
			'description'		=> Helper::cutText($this->description, self::DESCRIPTION_SIZE),
		];
	}
}
