<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TitleBlock extends Component
{
	public $title;
	/**
	* Create a new component instance.
	*/
	public function __construct($title)
	{
		$this->title = $title;
	}

	/**
	* Get the view / contents that represent the component.
	*/
	public function render(): View|Closure|string
	{
		return view('components.admin.blocks.title');
	}
}