<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ItemTest extends TestCase
{
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
}
