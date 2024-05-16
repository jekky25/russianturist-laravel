<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TownTest extends TestCase
{
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
}
