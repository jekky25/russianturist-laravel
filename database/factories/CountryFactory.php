<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CountryFactory extends Factory
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
			'image'			=> $this->faker->text(10),
		];
	}
}
