<?php
namespace App\Services;

use App\Models\Config;
use App\Http\Resources\Admin\Config\ConfigResource;

class ConfigService
{
	/**
	* get all configs
	* @return \Illuminate\Database\Eloquent\Collection 
	*/
	public function getAll()
	{
		return ConfigResource::collection(Config::all());
	}

	/**
	* get config by id
	* @return \Illuminate\Database\Eloquent\Collection 
	*/
	public function getById($id)
	{
		$config = Config::select('*')
			->where('id', $id)
			->firstOrFail();
		return new ConfigResource($config);
	}

	/**
	* create a config
	* @param  array $request
	* @return void
	*/	
	public function create($request) 
	{
		try {
			Config::create($request);
		} catch (\Exception $e) {
			throw new \Exception('Failed to create a Config '.$e->getMessage());
		}
	}

	/**
	* update a config
	* @param array $params
	* @return void
	*/	
	public function update($id, $params)
	{
		try {
			Config::find($id)->update($params);
		} catch (\Exception $e) {
			throw new \Exception('Failed to update the Config. '.$e->getMessage());
		}
	}

	
	/**
	* delete a config
	* @param  id $id
	* @return void
	*/
	public function destroy($id) {
		try {
			Config::find($id)->delete();
		} catch (\Exception $e) {
			throw new \Exception('Failed to delete Config . '.$e->getMessage());
		}
	}

}