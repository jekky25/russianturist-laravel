<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CountryTest extends TestCase
{
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
}