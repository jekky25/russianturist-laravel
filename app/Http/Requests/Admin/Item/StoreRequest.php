<?php
namespace App\Http\Requests\Admin\Item;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
	private $table = 'items';
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
			'name'					=> ['required', 'string', 'unique:' . $this->table],
			'description'			=> ['required', 'string'],
			'image'					=> ['required', 'image']
		];
	}
}