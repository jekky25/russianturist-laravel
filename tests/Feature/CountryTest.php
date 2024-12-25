<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use App\Models\User;
use App\Models\Country;

class CountryTest extends TestCase
{
	use DatabaseMigrations;
	protected $user = null;

	protected $data = [
		'name'			=> 'test',
		'slug'			=> 'ffffff',
		'description'	=> 'sdff dsf fdsf  ffdsf sfsf fs'
	];

	protected $dataNoValid = [
		'name'			=> '',
		'slug'			=> '',
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
	 * A basic feature test country.
	 */
	public function test_country_page(): void
	{
		$_SERVER['REQUEST_URI'] = '/countries/';
		$response = $this->get($_SERVER['REQUEST_URI']);
		$response->assertStatus(200);
	}

	/**
	 * A basic feature test country_name.
	 */
	public function test_country_id_page(): void
	{
		$_SERVER['REQUEST_URI'] = '/countries/bulgary.html';
		$response = $this->get($_SERVER['REQUEST_URI']);
		$response->assertStatus(200);

		$_SERVER['REQUEST_URI'] = '/countries/egypt.html';
		$response = $this->get($_SERVER['REQUEST_URI']);
		$response->assertStatus(200);
	}

	/** @test */
	public function check_adding_data_to_the_country_model(): void
	{
		$url = '/admin/countries/store/';
		$response = $this->post($url, $this->data);
		$response->assertRedirectToRoute('login');

		$this->data['image'] = $this->addImage('file.jpg');
		$response = $this->actingAs($this->user)->post($url, $this->data);
		$response->assertRedirectToRoute('admin.country.index');

		$response = $this->actingAs($this->user)->post($url, $this->dataNoValid);
		$response->assertInvalid(['name', 'slug', 'description', 'image']);
	}

	/** @test */
	public function check_updating_data_to_the_country_model(): void
	{
		$country	= Country::factory()->create();
		$url = '/admin/countries/' . $country->id . '/';
		$response = $this->patch($url, $this->data);
		$response->assertRedirectToRoute('login');

		$response = $this->actingAs($this->user)->patch($url, $this->data);
		$response->assertRedirectToRoute('admin.country.index');

		$response = $this->actingAs($this->user)->patch($url, $this->dataNoValid);
		$response->assertInvalid(['name', 'slug', 'description']);

	}

	/** @test */
	public function check_deleting_data_from_the_country_model(): void
	{
		$country = Country::factory()->create();
		$url = '/admin/countries/' . $country->id . '/';
		$response = $this->delete($url);
		$response->assertRedirectToRoute('login');

		$response = $this->actingAs($this->user)->delete($url);
		$response->assertRedirectToRoute('admin.country.index');
	}

	/** @test */
	public function check_gettings_all_countries_in_the_admin(): void	
	{
		$url = '/admin/countries/';
		$response = $this->get($url);
		$response->assertRedirectToRoute('login');

		$response = $this->actingAs($this->user)->get($url);
		$response->assertStatus(200);
		$response->assertViewHas('countries');
	}

	/** @test */
	public function check_gettings_create_country_page_in_the_admin(): void	
	{
		$url = '/admin/countries/create/';
		$response = $this->get($url);
		$response->assertRedirectToRoute('login');

		$response = $this->actingAs($this->user)->get($url);
		$response->assertViewIs('admin.countries.create');
	}

	/** @test */
	public function check_gettings_edit_country_page_in_the_admin(): void	
	{
		$country = Country::factory()->create();
		$url = '/admin/countries/' . $country->id . '/edit/';
		$response = $this->get($url);
		$response->assertRedirectToRoute('login');
		$response = $this->actingAs($this->user)->get($url);
		$response->assertViewIs('admin.countries.edit');
		$response->assertViewHasAll([
			'country' => $country
		]);
	}
}