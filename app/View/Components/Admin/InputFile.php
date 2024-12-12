<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputFile extends Component
{
	public $title;
	public $name;
	public $placeholder;
	public $image = null;
	public $imagePath = null;
	
	/**
	* Create a new component instance.
	*/
	public function __construct($title, $name, $placeholder, $image = null, $imagePath = null)
	{
		$this->title		= $title;
		$this->name			= $name;
		$this->placeholder	= $placeholder;
		$this->image		= $image;
		$this->imagePath	= $imagePath;
	}

	/**
	* Get the view / contents that represent the component.
	*/
	public function render(): View|Closure|string
	{
		return view('components.admin.fields.input_file');
	}
}