<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use App\Models\User;
use App\Models\Hotel;
use App\Models\City;

class HotelTest extends TestCase
{
	use DatabaseMigrations;
	protected $user = null;
	protected $city = null;

    protected $data = [
		'name'			=> 'test',
		'slug'			=> 'ffffff',
		'country_id'	=> 1,
		'description'	=> 'sdff dsf fdsf  ffdsf sfsf fs',
		'city_id'		=> 1,
		'stars'			=> 4
	];

    protected $dataNoValid = [
		'name'			=> '',
		'slug'			=> '',
		'country_id'	=> '',
		'description'	=> '',
		'city_id'		=> ''
	];

	/**
	 * Set up variables
	 */
	protected function setUp() :void
	{
		parent::setUp();
		$user					= User::factory()->create();
		$user->role				= User::ROLE_ADMIN;
		$this->user				= $user;
		$this->city				= City::factory()->create();
		$this->data['city_id']	= $this->city->id;
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
	 * A basic feature test hotel.
	 */
	public function test_hotel_page(): void
	{
		$_SERVER['REQUEST_URI'] = '/hotels/';
		$response = $this->get($_SERVER['REQUEST_URI']);
		$response->assertStatus(200);
	}

	/**
	 * A basic feature test hotel_name.
	 */
	public function test_hotel_id_page(): void
	{
		$_SERVER['REQUEST_URI'] = '/hotels/3s_beach_club.html';
		$response = $this->get($_SERVER['REQUEST_URI']);
		$response->assertStatus(200);

		$_SERVER['REQUEST_URI'] = '/hotels/a_one_bangkok.html';
		$response = $this->get($_SERVER['REQUEST_URI']);
		$response->assertStatus(200);
	}


    
	/**
	 * A basic feature test hotel_picture.
	 */
	public function test_hotel_picture_page(): void
	{
		$_SERVER['REQUEST_URI'] = '/hotels/3s_beach_club_foto_212.html';
		$response = $this->get($_SERVER['REQUEST_URI']);
		$response->assertStatus(200);
	}

	/** @test */
	public function check_adding_data_to_the_hotel_model(): void
	{
		$url = '/admin/hotels/store/';
		$response = $this->post($url, $this->data);
		$response->assertRedirectToRoute('login');

		$this->data['image'] = $this->addImage('file.jpg');
		$response = $this->actingAs($this->user)->post($url, $this->data);
		$response->assertRedirectToRoute('admin.hotel.index');

		$response = $this->actingAs($this->user)->post($url, $this->dataNoValid);
		$response->assertInvalid(['name', 'slug', 'description', 'city_id', 'stars']);
	}

	/** @test */
	public function check_updating_data_to_the_hotel_model(): void
	{
		$hotel	= Hotel::factory()->create();
		$url = '/admin/hotels/' . $hotel->id . '/';
		$response = $this->patch($url, $this->data);
		$response->assertRedirectToRoute('login');

		$response = $this->actingAs($this->user)->patch($url, $this->data);
		$response->assertRedirectToRoute('admin.hotel.index');

		$response = $this->actingAs($this->user)->patch($url, $this->dataNoValid);
		$response->assertInvalid(['name', 'slug', 'description', 'city_id', 'stars']);
	}

	/** @test */
	public function check_deleting_data_from_the_hotel_model(): void
	{
		$hotel = Hotel::factory()->create();
		$url = '/admin/hotels/' . $hotel->id . '/';
		$response = $this->delete($url);
		$response->assertRedirectToRoute('login');

		$response = $this->actingAs($this->user)->delete($url);
		$response->assertRedirectToRoute('admin.hotel.index');
	}

	/** @test */
	public function check_gettings_all_hotels_in_the_admin(): void	
	{
		$url = '/admin/hotels/';
		$response = $this->get($url);
		$response->assertRedirectToRoute('login');

		$response = $this->actingAs($this->user)->get($url);
		$response->assertStatus(200);
		$response->assertViewHas('hotels');
	}

	/** @test */
	public function check_gettings_create_hotel_page_in_the_admin(): void
	{
		$url = '/admin/hotels/create/';
		$response = $this->get($url);
		$response->assertRedirectToRoute('login');

		$response = $this->actingAs($this->user)->get($url);
		$response->assertViewIs('admin.hotels.create');
	}

	/** @test */
	public function check_gettings_edit_hotel_page_in_the_admin(): void
	{
		$hotel = Hotel::factory()->create();
		$url = '/admin/hotels/' . $hotel->id . '/edit/';
		$response = $this->get($url);
		$response->assertRedirectToRoute('login');
		$response = $this->actingAs($this->user)->get($url);
		$response->assertViewIs('admin.hotels.edit');
		$response->assertViewHasAll([
			'hotel' => $hotel
		]);
	}
}