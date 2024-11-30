<?php
namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Http\Requests\Admin\User\UpdateRequest;
use App\Services\UserService;

class IndexController extends Controller
{
	private $roles;
	/**
	* Create a new controller instance.
	*
	* @return void
	*/
	public function __construct(
		private UserService $user
	)
	{
		$this->roles = $this->user->getRoles();
	}

	/**
	* show admin user index page
	*
	* @return \Illuminate\Http\Response
	*/
	public function index()
	{
		return response()->view('admin.users.index', ['users' => $this->user->getAll()]);
	}

	/**
	* show admin user create page
	*
	* @return \Illuminate\Http\Response
	*/
	public function create()
	{
		return response()->view('admin.users.create', ['roles' => $this->roles]);
	}

	/**
	* create an user in admin
	*
	* @param  StoreRequest  $request
	* @return void
	*/
	public function store(StoreRequest $request)
	{
		$this->user->create($request->validated());
		return redirect()->route('admin.user.index');
	}

	/**
	* show admin user detail page
	*
	* @param  int $id
	* @return \Illuminate\Http\Response
	*/
	public function show($id)
	{
		return response()->view('admin.users.show', ['user' => $this->user->getById($id)]);
	}

	/**
	* show admin user edit page
	*
	* @param  int $id
	* @return \Illuminate\Http\Response
	*/
	public function edit($id)
	{
		$data = [
			'user'	=> $this->user->getById($id),
			'roles'	=> $this->roles
		];
		return response()->view('admin.users.edit', $data);
	}

	/**
	* update user in admin
	*
	* @param  UpdateRequest  $request
	* @param  int $id
	* @return void
	*/
	public function update(UpdateRequest $request, $id)
	{
		$this->user->update($id, $request->validated());
		return redirect()->route('admin.user.index');
	}

	/**
	* destroy the user in admin
	*
	* @param int $id
	* @return void
	*/
	public function destroy($id)
	{
		$this->user->destroy($id);
		return redirect()->route('admin.user.index');
	}
}