<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Providers\SapeServiceProvider;

class Hotel extends Model
{
	use HasFactory;

	public function getHotelsDescriptionAttribute ($val)
	{
		return SapeServiceProvider::replaceSapeCode($val);
	}

	public function getFirstImagePathAttribute ()
	{
		if ($this->fotos->count() == 0) return null;
		return $this->fotos[0]->image_path;
	}

	/**
	* get fotos
	*/
	public function fotos()
	{
		return $this->hasMany(Foto::class, 'parent_id', 'id')->where('type', 'hotel');
	}

	/**
	* get town
	*/
	public function town()
	{
		return $this->belongsTo(Town::class, 'town_id', 'id');
	}
}