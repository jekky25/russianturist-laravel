<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\Models\User;
use App\Models\Config;

class ConfigTest extends TestCase
{
	use DatabaseMigrations;
	protected $user = null;
	protected $data = [
		'name'	=> 'test',
		'value'	=> 'test222'
	];

	protected $dataNoValid = [
		'name'	=> '',
		'value'	=> ''
	];

	protected function setUp() :void
	{
		parent::setUp();
		$user = User::factory()->create();
		$user->role = User::ROLE_ADMIN;
		$this->user = $user;
	}

	/** @test */
    public function check_adding_data_to_the_config_model(): void
    {
		$url = '/admin/configs/store/';
		$response = $this->post($url, $this->data);
		$response->assertRedirectToRoute('login');

		$response = $this->actingAs($this->user)->post($url, $this->data);
		$response->assertRedirectToRoute('admin.config.index');

		$response = $this->actingAs($this->user)->post($url, $this->dataNoValid);
		$response->assertInvalid(['name', 'value']);

    }

	/** @test */
    public function check_updating_data_to_the_config_model(): void
    {
		$config	= Config::factory()->create();
		$url = '/admin/configs/' . $config->id . '/';
		$response= $this->patch($url, $this->data);
		$response->assertRedirectToRoute('login');

		$response = $this->actingAs($this->user)->patch($url, $this->data);
		$response->assertRedirectToRoute('admin.config.index');

		$response = $this->actingAs($this->user)->patch($url, $this->dataNoValid);
		$response->assertInvalid(['name', 'value']);
	}

	/** @test */
    public function check_deleting_data_from_the_config_model(): void
    {
		$config = Config::factory()->create();
		$url = '/admin/configs/' . $config->id . '/';
		$response = $this->delete($url);
		$response->assertRedirectToRoute('login');

		$response = $this->actingAs($this->user)->delete($url);
		$response->assertRedirectToRoute('admin.config.index');
	}

	/** @test */
	public function check_gettings_all_configs_in_the_admin(): void	
	{
		$url = '/admin/configs/';
		$configs = Config::factory(10)->create();
		$response = $this->get($url);
		$response->assertRedirectToRoute('login');

		$response = $this->actingAs($this->user)->get($url);
		$response->assertStatus(200);
		$response->assertViewHasAll([
			'configs.0' => $configs[0]
		]);
	}

	/** @test */
	public function check_gettings_create_config_page_in_the_admin(): void	
	{
		$url = '/admin/configs/create/';
		$response = $this->get($url);
		$response->assertRedirectToRoute('login');

		$response = $this->actingAs($this->user)->get($url);
		$response->assertViewIs('admin.configs.create');
	}

	/** @test */
	public function check_gettings_edit_config_page_in_the_admin(): void	
	{
		$config = Config::factory()->create();
		$url = '/admin/configs/' . $config->id . '/edit/';
		$response = $this->get($url);
		$response->assertRedirectToRoute('login');
		$response = $this->actingAs($this->user)->get($url);
		$response->assertViewIs('admin.configs.edit');
		$response->assertViewHasAll([
			'config' => $config
		]);
	}
}
