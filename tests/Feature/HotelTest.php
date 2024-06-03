<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HotelTest extends TestCase
{
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
}
