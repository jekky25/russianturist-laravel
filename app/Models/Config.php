<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
	use HasFactory;
	protected $table = 'vars';

	/**
	* The attributes that are mass assignable.
	*
	* @var array<int, string>
	*/
	protected $fillable = [
		'name',
		'value'
	];

	public $timestamps		= false;
}
