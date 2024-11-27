<?php
namespace App\Http\Controllers\Admin\Config;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Config\StoreRequest;
use App\Http\Requests\Admin\Config\UpdateRequest;
use App\Services\ConfigService;

class IndexController extends Controller
{
	/**
	* Create a new controller instance.
	*
	* @return void
	*/
	public function __construct(
		private ConfigService $config
	)
	{
	}

	/**
	* show admin config index page
	*
	* @return \Illuminate\Http\Response
	*/
	public function index()
	{
		return response()->view('admin.configs.index', ['configs' => $this->config->getAll()]);
	}

	/**
	* show admin config create page
	*
	* @return \Illuminate\Http\Response
	*/
	public function create()
	{
		return response()->view('admin.configs.create');
	}

	/**
	* create config in admin
	*
	* @param  StoreRequest  $request
	* @return void
	*/
	public function store(StoreRequest $request)
	{
		$this->config->create($request->validated());
		return redirect()->route('admin.config.index');
	}

	/**
	* show admin config detail page
	*
	* @param  int $id
	* @return \Illuminate\Http\Response
	*/
	public function show($id)
	{
		return response()->view('admin.configs.show', ['config' => $this->config->getById($id)]);
	}

	/**
	* show admin config edit page
	*
	* @param  int $id
	* @return \Illuminate\Http\Response
	*/
	public function edit($id)
	{
		return response()->view('admin.configs.edit', ['config' => $this->config->getById($id)]);
	}

	/**
	* update config in admin
	*
	* @param  UpdateRequest  $request
	* @param  int $id
	* @return void
	*/
	public function update(UpdateRequest $request, $id)
	{
		$this->config->update($id, $request->validated());
		return redirect()->route('admin.config.index');
	}

	/**
	* destroy config in admin
	*
	* @param int $id
	* @return void
	*/
	public function destroy($id)
	{
		$this->config->destroy($id);
		return redirect()->route('admin.config.index');
	}
}