<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;

class ItemTest extends TestCase
{
	use DatabaseMigrations;
	protected $user = null;
	protected $item = null;

    protected $data = [
		'name'			=> 'test',
		'description'	=> 'sdff dsf fdsf  ffdsf sfsf fs'
	];

    protected $dataNoValid = [
		'name'			=> '',
		'description'	=> ''
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
		$this->item				= Item::factory()->create();
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
	 * A basic feature test item.
	 */
	public function test_item_page(): void
	{
		$_SERVER['REQUEST_URI'] = '/items/';
		$response = $this->get($_SERVER['REQUEST_URI']);
		$response->assertStatus(200);
	}

	/**
	 * A basic feature test item id.
	 */
	public function test_item_id_page(): void
	{
		$_SERVER['REQUEST_URI'] = '/items/item_2.html';
		$response = $this->get($_SERVER['REQUEST_URI']);
		$response->assertStatus(200);

		$_SERVER['REQUEST_URI'] = '/items/item_4.html';
		$response = $this->get($_SERVER['REQUEST_URI']);
		$response->assertStatus(200);
	}

	/** @test */
	public function check_adding_data_to_the_item_model(): void
	{
		$url = '/admin/items/store/';
		$response = $this->post($url, $this->data);
		$response->assertRedirectToRoute('login');

		$this->data['image'] = $this->addImage('file.jpg');
		$response = $this->actingAs($this->user)->post($url, $this->data);
		$response->assertRedirectToRoute('admin.item.index');

		$response = $this->actingAs($this->user)->post($url, $this->dataNoValid);
		$response->assertInvalid(['name', 'description']);
	}

	/** @test */
	public function check_updating_data_to_the_item_model(): void
	{
		$item	= Item::factory()->create();
		$url = '/admin/items/' . $item->id . '/';
		$response = $this->patch($url, $this->data);
		$response->assertRedirectToRoute('login');

		$response = $this->actingAs($this->user)->patch($url, $this->data);
		$response->assertRedirectToRoute('admin.item.index');

		$response = $this->actingAs($this->user)->patch($url, $this->dataNoValid);
		$response->assertInvalid(['name', 'description']);
	}

	/** @test */
	public function check_gettings_all_items_in_the_admin(): void
	{
		$url = '/admin/items/';
		$response = $this->get($url);
		$response->assertRedirectToRoute('login');

		$response = $this->actingAs($this->user)->get($url);
		$response->assertStatus(200);
		$response->assertViewHas('items');
	}

	/** @test */
	public function check_gettings_create_item_page_in_the_admin(): void
	{
		$url = '/admin/items/create/';
		$response = $this->get($url);
		$response->assertRedirectToRoute('login');

		$response = $this->actingAs($this->user)->get($url);
		$response->assertViewIs('admin.items.create');
	}

	/** @test */
	public function check_gettings_edit_item_page_in_the_admin(): void
	{
		$item = Item::factory()->create();
		$url = '/admin/items/' . $item->id . '/edit/';
		$response = $this->get($url);
		$response->assertRedirectToRoute('login');
		$response = $this->actingAs($this->user)->get($url);
		$response->assertViewIs('admin.items.edit');
		$response->assertViewHasAll([
			'item' => $item
		]);
	}
}
