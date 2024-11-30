<?php
namespace App\Services;

use App\Models\User;
use App\Http\Resources\Admin\User\UserResource;

class UserService
{
	/**
	* get all users
	* @return \Illuminate\Database\Eloquent\Collection 
	*/
	public function getAll()
	{
		return UserResource::collection(User::all());
	}

	/**
	* get an user by id
	* @return \Illuminate\Database\Eloquent\Collection 
	*/
	public function getById($id)
	{
		$user = User::select('*')
			->where('id', $id)
			->firstOrFail();
		return new UserResource($user);
	}

	/**
	* create an user
	* @param  array $request
	* @return void
	*/	
	public function create($request) 
	{
		try {
			User::create($request);
		} catch (\Exception $e) {
			throw new \Exception('Failed to create an User '.$e->getMessage());
		}
	}

	/**
	* update an user
	* @param array $params
	* @return void
	*/	
	public function update($id, $params)
	{
		try {
			User::find($id)->update($params);
		} catch (\Exception $e) {
			throw new \Exception('Failed to update the User. '.$e->getMessage());
		}
	}

	
	/**
	* delete an user
	* @param  id $id
	* @return void
	*/
	public function destroy($id) {
		try {
			User::find($id)->delete();
		} catch (\Exception $e) {
			throw new \Exception('Failed to delete the User . '.$e->getMessage());
		}
	}

	public function getRoles()
	{
		return User::getRoles();
	}
}