<?php

namespace Database\Factories;

use App\Models\Places;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Place>
 */
class PlacesFactory extends Factory
{
    protected $model = Places::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'slug' => $this->faker->slug,
            'city' => $this->faker->city,
            'state' => $this->faker->state,
        ];
    }
}
