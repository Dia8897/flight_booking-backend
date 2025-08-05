<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Flight>
 */
class FlightFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $departure = $this->faker->dateTimeBetween('+1 day', '+30 days');
        $arrival = (clone $departure)->modify('+' . rand(1, 10) . ' hours');

        return [
            'number' => 'FL' . $this->faker->unique()->numberBetween(1000, 9999),
            'departure_city' => $this->faker->city,
            'arrival_city' => $this->faker->city,
            'departure_time' => $departure,
            'arrival_time' => $arrival,
        ];
    }
}
