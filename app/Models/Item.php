<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Providers\SapeServiceProvider;
use App\Models\Foto;

class Item extends Model
{
	use HasFactory;

	public function getItemsDescriptionAttribute ($val)
	{
		return SapeServiceProvider::replaceSapeCode($val);
	}
	
	/**
	* get fotos
	*/
	public function fotos()
	{
		return $this->hasMany(
			Foto::class,
			'parent_id',
			'items_id');
	}
}