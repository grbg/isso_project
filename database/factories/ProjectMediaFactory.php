<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ProjectMedia;

class ProjectMediaFactory extends Factory
{
    protected $model = ProjectMedia::class;

    public function definition(): array
    {
        return [
            'project_id' => null,
            'media_path' => $this->faker->image('public/storage/images', 640, 480, null, false),
            'type' => $this->faker->randomElement(['title', 'description', 'gallery']),
        ];
    }
}

