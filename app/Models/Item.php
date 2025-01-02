<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Providers\SapeServiceProvider;
use App\Models\Foto;

class Item extends Model
{
	use HasFactory;

	const IMAGES_DIRECTORY	= 'images/item';
	const IMAGES_TYPE		= 'item';

	public $timestamps		= false;
	protected $fillable		= [
		'id',
		'create_time',
		'name',
		'description'
	];

	public function getFirstImagePathAttribute()
	{
		if ($this->fotos->count() == 0 || $this->fotos[0] == null) return null;
		return $this->fotos[0]->image_path;
	}

	public function getDescriptionAttribute($val)
	{
		return SapeServiceProvider::replaceSapeCode($val);
	}
	
	/**
	* get fotos
	*/
	public function fotos()
	{
		return $this->hasMany(Foto::class, 'parent_id', 'id')->where('type', 'item');
	}
}