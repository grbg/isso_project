<?php

namespace Database\Factories;

use App\Models\ApartmentMedia;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApartmentMediaFactory extends Factory
{
    protected $model = ApartmentMedia::class;

    public function definition(): array
    {
        return [
            'path' => $this->faker->imageUrl(),
        ];
    }
}
