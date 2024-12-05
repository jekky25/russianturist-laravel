<?php
namespace App\Http\Controllers\Admin\Country;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Country\StoreRequest;
use App\Http\Requests\Admin\Country\UpdateRequest;
use App\Services\CountryService;

class IndexController extends Controller
{
	/**
	* Create a new controller instance.
	*
	* @return void
	*/
	public function __construct(
		private CountryService $country
	)
	{
	}

	/**
	* show admin country index page
	*
	* @return \Illuminate\Http\Response
	*/
	public function index()
	{
		return response()->view('admin.countries.index', ['countries' => $this->country->getAll()]);
	}

	/**
	* show admin country create page
	*
	* @return \Illuminate\Http\Response
	*/
	public function create()
	{
		return response()->view('admin.countries.create');
	}

	/**
	* create country in admin
	*
	* @param  StoreRequest  $request
	* @return void
	*/
	public function store(StoreRequest $request)
	{
		$this->country->create($request->validated());
		return redirect()->route('admin.country.index');
	}

	/**
	* show admin country detail page
	*
	* @param  int $id
	* @return \Illuminate\Http\Response
	*/
	public function show($id)
	{
		return response()->view('admin.countries.show', ['country' => $this->country->getById($id)]);
	}

	/**
	* show admin country edit page
	*
	* @param  int $id
	* @return \Illuminate\Http\Response
	*/
	public function edit($id)
	{
		return response()->view('admin.countries.edit', ['country' => $this->country->getById($id)]);
	}

	/**
	* update country in admin
	*
	* @param  UpdateRequest  $request
	* @param  int $id
	* @return void
	*/
	public function update(UpdateRequest $request, $id)
	{
		$this->country->update($id, $request->validated());
		return redirect()->route('admin.country.index');
	}

	/**
	* destroy country in admin
	*
	* @param int $id
	* @return void
	*/
	public function destroy($id)
	{
		$this->country->destroy($id);
		return redirect()->route('admin.country.index');
	}
}