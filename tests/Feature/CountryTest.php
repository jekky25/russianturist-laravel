<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CountryTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_country_page(): void
    {
        $_SERVER['REQUEST_URI'] = '/countries/';
        $response = $this->get($_SERVER['REQUEST_URI']);
        $response->assertStatus(200);
    }
}
