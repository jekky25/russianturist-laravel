<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Providers\SapeServiceProvider;
use App\Models\Foto;
use App\Traits\Tstr;

class Item extends Model
{
	use HasFactory, Tstr;

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
			'foto_parent_id',
			'items_id');
	}
}