<?php

namespace Database\Factories;

use App\Models\Apartment;
use App\Models\Project;
use App\Models\ApartmentMedia;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApartmentFactory extends Factory
{
    protected $model = Apartment::class;

    public function definition(): array
    {
        return [
            'id_project' => Project::factory(),     
            'id_media' => ApartmentMedia::factory(),
            'type' => $this->faker->randomElement(['1_room', '2_room', '3_room', 'studio']),
            'area' => $this->faker->numberBetween(30, 120),
            'floor' => $this->faker->numberBetween(1, 20),
        ];
    }
}
