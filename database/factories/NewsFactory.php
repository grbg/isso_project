<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\News;
use App\Models\NewsMedia; 

class NewsFactory extends Factory
{
    protected $model = News::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(6, true),
            'text' => $this->faker->paragraphs(3, true),
            'author' => $this->faker->name(),
            'id_media' => NewsMedia::factory(),
        ];
    }
}
