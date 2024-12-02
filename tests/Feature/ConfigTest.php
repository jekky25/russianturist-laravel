<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\Models\User;

class ConfigTest extends TestCase
{
	use DatabaseMigrations;

	const ADMIN_ID = 1;
	/** @test */
    public function test_check_adding_data_to_theConfig_model(): void
    {
		$this->withoutExceptionHandling();

		$userData = [
			'id'		=> 1,
			'name'		=> 'Admin',
			'email' 	=> 'admin@admin',
			'password'	=> '123123'
		];

		User::create($userData);

		$data = [
			'name'	=> 'test',
			'value'	=> 'test222'
		];

		Auth::loginUsingId(self::ADMIN_ID);
		$response = $this->post('/admin/configs/store/', $data);
		$response->assertRedirect();
	
    }
}
