<?php
namespace App\Http\Controllers\Admin\City;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\City\StoreRequest;
use App\Http\Requests\Admin\City\UpdateRequest;
use App\Services\TownService;
use App\Services\CountryService;

class IndexController extends Controller
{
	/**
	* Create a new controller instance.
	*
	* @return void
	*/
	public function __construct(
		private TownService $city,
		private CountryService $country
	)
	{
	}

	/**
	* show admin city index page
	*
	* @return \Illuminate\Http\Response
	*/
	public function index()
	{
		return response()->view('admin.cities.index', ['cities' => $this->city->getAll()]);
	}

	/**
	* show admin city create page
	*
	* @return \Illuminate\Http\Response
	*/
	public function create()
	{
		return response()->view('admin.cities.create', ['countries'	=> $this->country->getAll()]);
	}

	/**
	* create city in admin
	*
	* @param  StoreRequest  $request
	* @return void
	*/
	public function store(StoreRequest $request)
	{
		$this->city->create($request->validated());
		return redirect()->route('admin.city.index');
	}

	/**
	* show admin city detail page
	*
	* @param  int $id
	* @return \Illuminate\Http\Response
	*/
	public function show($id)
	{
		return response()->view('admin.cities.show', ['city' => $this->city->getById($id)]);
	}

	/**
	* show admin city edit page
	*
	* @param  int $id
	* @return \Illuminate\Http\Response
	*/
	public function edit($id)
	{
		return response()->view('admin.cities.edit', [
			'city'		=> $this->city->getById($id),
			'countries'	=> $this->country->getAll()
		]);
	}

	/**
	* update city in admin
	*
	* @param  UpdateRequest  $request
	* @param  int $id
	* @return void
	*/
	public function update(UpdateRequest $request, $id)
	{
		$this->city->update($id, $request->validated());
		return redirect()->route('admin.city.index');
	}

	/**
	* destroy city in admin
	*
	* @param int $id
	* @return void
	*/
	public function destroy($id)
	{
		$this->city->destroy($id);
		return redirect()->route('admin.city.index');
	}
}