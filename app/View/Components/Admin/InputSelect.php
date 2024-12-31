<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputSelect extends Component
{
	public $title;
	public $name;
	public $items = null;
	public $value = null;
	
	/**
	* Create a new component instance.
	*/
	public function __construct($title, $name, $value = null, $items = null)
	{
		$this->title		= $title;
		$this->name			= $name;
		$this->items		= $this->prepareArray($items);
		$this->value		= $value;
	}

	/**
	* Get the view / contents that represent the component.
	*/
	public function render(): View|Closure|string
	{
		return view('components.admin.fields.input_select');
	}

	private function prepareArray($items)
	{
		if (!is_array($items)) return $items;
		$_arr = collect([]);
		$i = 0;
		foreach ($items as $item)
		{
			$_arr->put($i, (object) [
				'id'	=> $item,
				'name'	=> $item
			]);
			$i++;
		}
		return $_arr;
	}
}