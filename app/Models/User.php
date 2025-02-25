<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
	use HasApiTokens, HasFactory, Notifiable;

	const ROLE_ADMIN	= 0;
	const ROLE_READER	= 1;

	/**
	* The attributes that are mass assignable.
	*
	* @var array<int, string>
	*/
	protected $fillable = [
		'name',
		'email',
		'password',
		'role'
	];

	/**
	* The attributes that should be hidden for serialization.
	*
	* @var array<int, string>
	*/
	protected $hidden = [
		'password',
		'remember_token',
	];

	/**
	* The attributes that should be cast.
	*
	* @var array<string, string>
	*/
	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	public static function getRoles()
	{
		return [
			self::ROLE_ADMIN	=> 'Админ',
			self::ROLE_READER	=> 'Читатель'
		];
	}

	public function setPasswordAttribute($value)
	{
		$this->attributes['password'] = Hash::make($value);
	}
}