<?php

namespace App\Http\Requests\Admin\Country;

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
			'name.required'						=> 'Название не заполнено',
			'name.unique'						=> 'Название не уникально',
			'slug.required'						=> 'Имя для ссылки не заполнено',
			'slug.unique'						=> 'Имя для ссылки не уникально',
			'slug.regex'						=> 'Имя для ссылки не корректно заполнено',
			'description.required'				=> 'Описание не заполнено',
			'image.required'					=> 'Изображение не загружено',
			'image.image'						=> 'Файл не является изображением'
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
			'name'					=> ['required', 'string', 'unique:countries'],
			'slug'					=> ['required', 'string', 'unique:countries', 'regex:/^[A-Za-z0-9_]+$/i'],
			'description'			=> ['required', 'string'],
			'image'					=> ['required', 'image']
		];
	}
}