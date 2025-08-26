<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Location;
use App\Models\ProjectMedia;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company . ' ЖК',
            'description' => $this->faker->paragraph(3),
            'id_location' => Location::factory(),
            'infrastucture_info' => $this->faker->sentence(10),
            'architecture_info' => $this->faker->sentence(10),
            'environment_info' => $this->faker->sentence(10),
            'transport_info' => $this->faker->sentence(10),
            'status' => $this->faker->randomElement(['Completed', 'In process', 'Uncompleted']),
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Project $project) {
            ProjectMedia::factory()->create([
                'project_id' => $project->id,
                'media_path' => 'images/sample.jpg',
                'type' => 'title',
            ]);
        });
    }
}

