<?php
namespace App\Http\Controllers\Admin\Item;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Item\StoreRequest;
use App\Http\Requests\Admin\Item\UpdateRequest;
use App\Services\ItemService;

class IndexController extends Controller
{
	/**
	* Create a new controller instance.
	*
	* @return void
	*/
	public function __construct(
		private ItemService $item,
	)
	{
	}

	/**
	* show admin item index page
	*
	* @return \Illuminate\Http\Response
	*/
	public function index()
	{
		return response()->view('admin.items.index', ['items' => $this->item->getAll()]);
	}

	/**
	* show admin item create page
	*
	* @return \Illuminate\Http\Response
	*/
	public function create()
	{
		return response()->view('admin.items.create');
	}

	/**
	* create item in admin
	*
	* @param  StoreRequest  $request
	* @return void
	*/
	public function store(StoreRequest $request)
	{
		$this->item->create($request->validated());
		return redirect()->route('admin.item.index');
	}

	/**
	* show admin item detail page
	*
	* @param  int $id
	* @return \Illuminate\Http\Response
	*/
	public function show($id)
	{
		return response()->view('admin.items.show', ['hotel' => $this->item->getById($id)]);
	}

	/**
	* show admin item edit page
	*
	* @param  int $id
	* @return \Illuminate\Http\Response
	*/
	public function edit($id)
	{
		return response()->view('admin.items.edit', ['item' => $this->item->getById($id)]);
	}

	/**
	* update item in admin
	*
	* @param  UpdateRequest  $request
	* @param  int $id
	* @return void
	*/
	public function update(UpdateRequest $request, $id)
	{
		$this->item->update($id, $request->validated());
		return redirect()->route('admin.item.index');
	}

	/**
	* destroy item in admin
	*
	* @param int $id
	* @return void
	*/
	public function destroy($id)
	{
		$this->item->destroy($id);
		return redirect()->route('admin.item.index');
	}
}