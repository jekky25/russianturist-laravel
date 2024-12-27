<?php
namespace App\Http\Controllers\Admin\Hotel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Hotel\StoreRequest;
use App\Http\Requests\Admin\Hotel\UpdateRequest;
use App\Services\HotelService;
use App\Services\TownService;

class IndexController extends Controller
{
	/**
	* Create a new controller instance.
	*
	* @return void
	*/
	public function __construct(
		private HotelService $hotel,
		private TownService $city
	)
	{
	}

	/**
	* show admin hotel index page
	*
	* @return \Illuminate\Http\Response
	*/
	public function index()
	{
		return response()->view('admin.hotels.index', ['hotels' => $this->hotel->getAll()]);
	}

	/**
	* show admin hotel create page
	*
	* @return \Illuminate\Http\Response
	*/
	public function create()
	{
		return response()->view('admin.hotels.create', ['cities' => $this->city->getAll(), 'stars' => $this->hotel->getAllStars()]);
	}

	/**
	* create hotel in admin
	*
	* @param  StoreRequest  $request
	* @return void
	*/
	public function store(StoreRequest $request)
	{
		$this->hotel->create($request->validated());
		return redirect()->route('admin.hotel.index');
	}

	/**
	* show admin hotel detail page
	*
	* @param  int $id
	* @return \Illuminate\Http\Response
	*/
	public function show($id)
	{
		return response()->view('admin.hotels.show', ['hotel' => $this->hotel->getById($id)]);
	}

	/**
	* show admin hotel edit page
	*
	* @param  int $id
	* @return \Illuminate\Http\Response
	*/
	public function edit($id)
	{
		return response()->view('admin.hotels.edit', ['hotel' => $this->hotel->getById($id), 'cities' => $this->city->getAll(), 'stars' => $this->hotel->getAllStars()]);
	}

	/**
	* update hotel in admin
	*
	* @param  UpdateRequest  $request
	* @param  int $id
	* @return void
	*/
	public function update(UpdateRequest $request, $id)
	{
		$this->hotel->update($id, $request->validated());
		return redirect()->route('admin.hotel.index');
	}

	/**
	* destroy hotel in admin
	*
	* @param int $id
	* @return void
	*/
	public function destroy($id)
	{
		$this->hotel->destroy($id);
		return redirect()->route('admin.hotel.index');
	}
}