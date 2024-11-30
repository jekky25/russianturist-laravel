<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
	/**
	* Determine if the user is authorized to make this request.
	*/
	public function authorize(): bool
	{
		return true;
	}

	/**
	* messages for the request
	* @return string array
	*/
	public function messages():array
	{
		return	[
			'name.required'			=> 'Имя не заполнено',
			'name.min'				=> 'Имя слишком короткое',
			'name.max'				=> 'Имя слишком длинное',
			'email.required'		=> 'Емайл не заполнен',
			'email.email'			=> 'Емайл не корректно введен',
			'email.unique'			=> 'Такой Емайл уже используется',
			'role.required'			=> 'Роль не указана'
		];
	}

	/**
	* Get the validation rules that apply to the request.
	*
	* @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
	*/
	public function rules(): array
	{
		return [
			'name'		=> ['required', 'string', 'min:2', 'max:30'],
			'email'		=> ['required', 'string', 'email', 'unique:users,email, ' . \Request::instance()->id],
			'role'		=> ['required', 'integer']
		];
	}
}