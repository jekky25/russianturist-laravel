<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class HotelFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition()
	{
		return [
			'name'			=> $this->faker->name(10),
			'slug'			=> $this->faker->text(10),
			'description'	=> $this->faker->text(30),
			'country_id'	=> 1,
			'create_time'	=> time(),
			'stars'			=> 4,
			'town_id'		=> 1
		];
	}
}
