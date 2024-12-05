<?php

namespace App\Http\Requests\Admin\Country;

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
			'countries_name.required'			=> 'Название не заполнено',
			'countries_name.unique'				=> 'Название не уникально',
			'countries_eng_name.required'		=> 'Имя для ссылки не заполнено',
			'countries_eng_name.unique'			=> 'Имя для ссылки не уникально',
			'countries_eng_name.regex'			=> 'Имя для ссылки не корректно заполнено',
			'countries_description.required'	=> 'Описание не заполнено'
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
			'countries_name'		=> ['required', 'string', 'unique:countries,countries_name,' . \Request::instance()->id . ',countries_id'],
			'countries_eng_name'	=> ['required', 'string', 'unique:countries,countries_eng_name,' . \Request::instance()->id . ',countries_id', 'regex:/^[A-Za-z0-9_]+$/i'],
			'countries_description'	=> ['required', 'string']

		];
	}
}