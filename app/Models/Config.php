<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Events\RemoveConfigCache;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
	use HasFactory;

	const CASHE_TIME		= 60*60*24*7; //1 week

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

	protected $dispatchesEvents = [
        'updating' => RemoveConfigCache::class,
		'deleting' => RemoveConfigCache::class
    ];
}
