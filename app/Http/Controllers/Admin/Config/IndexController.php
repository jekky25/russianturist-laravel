<?php
namespace App\Http\Controllers\Admin\Config;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Config\StoreRequest;
use App\Http\Requests\Admin\Config\UpdateRequest;
use App\Models\Config;

class IndexController extends Controller
{

	/**
	* show admin config index page
	*
	* @return \Illuminate\Http\Response
	*/
	public function index()
	{
		return response()->view('admin.configs.index', ['configs' => Config::all()]);
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
		$data = $request->validated();
		Config::create($data);
		return redirect()->route('admin.config.index');
	}

	/**
	* show admin config detail page
	*
	* @param  Config $config
	* @return \Illuminate\Http\Response
	*/
	public function show(Config $config)
	{
		return response()->view('admin.configs.show', ['config' => $config]);
	}

	/**
	* show admin config edit page
	*
	* @param  Config $config
	* @return \Illuminate\Http\Response
	*/
	public function edit(Config $config)
	{
		return response()->view('admin.configs.edit', ['config' => $config]);
	}

	/**
	* update config in admin
	*
	* @param  UpdateRequest  $request
	* @param  Config $config
	* @return void
	*/
	public function update(UpdateRequest $request, Config $config)
	{
		$data = $request->validated();
		Config::find($config->id)->update($data);
		return redirect()->route('admin.config.index');
	}

	/**
	* destroy config in admin
	*
	* @param  Config $config
	* @return void
	*/
	public function destroy(Config $config)
	{
		$config->delete();
		return redirect()->route('admin.config.index');
	}
}