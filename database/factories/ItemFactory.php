<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
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
			'description'	=> $this->faker->text(30),
			'create_time'	=> time()
		];
	}
}
