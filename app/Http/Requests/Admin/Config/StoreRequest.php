<?php

namespace App\Http\Requests\Admin\Config;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
			'name.unique'			=> 'Имя не уникально',
			'name.regex'			=> 'Данные некорректно заполнены',
			'value.required'		=> 'Значение не уникально',
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
			'name'  => ['required', 'string', 'unique:vars', 'regex:/^[A-Za-z0-9]+$/i'],
			'value' => ['required', 'string']
		];
	}
}