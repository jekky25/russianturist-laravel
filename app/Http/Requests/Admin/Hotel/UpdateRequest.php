<?php
namespace App\Http\Requests\Admin\Hotel;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
	private $table = 'hotels';

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
			'town_id.required'					=> 'Город не заполнен',
			'town_id.min'						=> 'Город не заполнен',
			'image.image'						=> 'Файл не является изображением',
			'stars.required'					=> 'Рейтинг не заполнен',
			'stars.min'							=> 'Рейтинг не заполнен'
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
			'name'					=> ['required', 'string', 'unique:' . $this->table . ',name,' . \Request::instance()->id],
			'slug'					=> ['required', 'string', 'unique:' . $this->table . ',slug,' . \Request::instance()->id, 'regex:/^[A-Za-z0-9_]+$/i'],
			'description'			=> ['required', 'string'],
			'town_id'				=> ['required', 'integer', 'min:1'],
			'image'					=> ['nullable', 'image'],
			'stars'					=> ['required', 'integer', 'min:1']
		];
	}
}