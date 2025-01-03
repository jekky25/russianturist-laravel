<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;

class ItemTest extends TestCase
{
	use DatabaseMigrations;
	protected $user = null;
	protected $item = null;

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
	public function check_gettings_all_items_in_the_admin(): void
	{
		$url = '/admin/items/';
		$response = $this->get($url);
		$response->assertRedirectToRoute('login');

		$response = $this->actingAs($this->user)->get($url);
		$response->assertStatus(200);
		$response->assertViewHas('items');
	}	
}
