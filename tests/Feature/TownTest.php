<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use App\Models\User;
use App\Models\Town;

class TownTest extends TestCase
{
	use DatabaseMigrations;
	protected $user = null;

    protected $data = [
		'name'			=> 'test',
		'slug'			=> 'ffffff',
		'country_id'	=> '1',
		'description'	=> 'sdff dsf fdsf  ffdsf sfsf fs'
	];

    protected $dataNoValid = [
		'name'			=> '',
		'slug'			=> '',
		'country_id'	=> '',
		'description'	=> ''
	];

	/**
	 * Set up variables
	 */
	protected function setUp() :void
	{
		parent::setUp();
		$user = User::factory()->create();
		$user->role = User::ROLE_ADMIN;
		$this->user = $user;
	}

	/**
	 * Add a fake image to the storage
	 * 
	 * @param string $name
	 * @return string
	 */
    protected function addImage($name)
	{
		Storage::fake();
		return UploadedFile::fake()->create($name);
	}

	/**
	 * A basic feature test town.
	 */
	public function test_town_page(): void
	{
		$_SERVER['REQUEST_URI'] = '/towns/';
		$response = $this->get($_SERVER['REQUEST_URI']);
		$response->assertStatus(200);
	}

	/**
	 * A basic feature test town_name.
	 */
	public function test_town_id_page(): void
	{
		$_SERVER['REQUEST_URI'] = '/towns/alexandria.html';
		$response = $this->get($_SERVER['REQUEST_URI']);
		$response->assertStatus(200);

		$_SERVER['REQUEST_URI'] = '/towns/balchik.html';
		$response = $this->get($_SERVER['REQUEST_URI']);
		$response->assertStatus(200);
	}

	/** @test */
	public function check_adding_data_to_the_city_model(): void
	{
		$url = '/admin/cities/store/';
		$response = $this->post($url, $this->data);
		$response->assertRedirectToRoute('login');

		$this->data['image'] = $this->addImage('file.jpg');
		$response = $this->actingAs($this->user)->post($url, $this->data);
		$response->assertRedirectToRoute('admin.city.index');

		$response = $this->actingAs($this->user)->post($url, $this->dataNoValid);
		$response->assertInvalid(['name', 'slug', 'description', 'image']);
	}

	/** @test */
	public function check_updating_data_to_the_city_model(): void
	{
		$city	= Town::factory()->create();
		$url = '/admin/cities/' . $city->id . '/';
		$response = $this->patch($url, $this->data);
		$response->assertRedirectToRoute('login');

		$response = $this->actingAs($this->user)->patch($url, $this->data);
		$response->assertRedirectToRoute('admin.city.index');

		$response = $this->actingAs($this->user)->patch($url, $this->dataNoValid);
		$response->assertInvalid(['name', 'slug', 'country_id', 'description']);
	}

	/** @test */
	public function check_deleting_data_from_the_city_model(): void
	{
		$city = Town::factory()->create();
		$url = '/admin/cities/' . $city->id . '/';
		$response = $this->delete($url);
		$response->assertRedirectToRoute('login');

		$response = $this->actingAs($this->user)->delete($url);
		$response->assertRedirectToRoute('admin.city.index');
	}

	/** @test */
	public function check_gettings_all_cities_in_the_admin(): void	
	{
		$url = '/admin/cities/';
		$response = $this->get($url);
		$response->assertRedirectToRoute('login');

		$response = $this->actingAs($this->user)->get($url);
		$response->assertStatus(200);
		$response->assertViewHas('cities');
	}

	/** @test */
	public function check_gettings_create_city_page_in_the_admin(): void
	{
		$url = '/admin/cities/create/';
		$response = $this->get($url);
		$response->assertRedirectToRoute('login');

		$response = $this->actingAs($this->user)->get($url);
		$response->assertViewIs('admin.cities.create');

	}

    /** @test */
	public function check_gettings_edit_city_page_in_the_admin(): void
	{
		$city = Town::factory()->create();
		$url = '/admin/cities/' . $city->id . '/edit/';
		$response = $this->get($url);
		$response->assertRedirectToRoute('login');
		$response = $this->actingAs($this->user)->get($url);
		$response->assertViewIs('admin.cities.edit');
		$response->assertViewHasAll([
			'city' => $city
		]);
	}
}
