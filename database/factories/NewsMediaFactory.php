<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\NewsMedia;

class NewsMediaFactory extends Factory
{
    protected $model = NewsMedia::class;

    public function definition()
    {
        return [
            'media_path' => $this->faker->imageUrl(640, 480, 'nature', true),
        ];
    }
}
