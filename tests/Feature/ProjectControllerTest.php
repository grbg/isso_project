<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Project;
use App\Models\Location;
use App\Models\ProjectMedia;
use App\Models\Apartment;

class ProjectControllerTest extends TestCase
{

    public function test_home_page_loads_successfully()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewIs('home');
        $response->assertViewHas('projects');
        $response->assertViewHas('news');
    }

    public function test_project_show_page_displays_correct_data()
    {

        $location = Location::factory()->create();

        $project = Project::factory()->create([
            'id_location' => $location->id,
        ]);

        ProjectMedia::factory()->create([
            'project_id' => $project->id,
            'type' => 'title',
            'media_path' => 'title.jpg'
        ]);

        ProjectMedia::factory()->create([
            'project_id' => $project->id,
            'type' => 'description',
            'media_path' => 'description.jpg'
        ]);

        $response = $this->get("/projects/{$project->id}");

        $response->assertStatus(200);
        $response->assertViewIs('project');
        $response->assertViewHasAll(['project', 'titleImage', 'descriptionImage', 'galleryImages']);
    }

    public function test_all_projects_page_returns_projects_with_apartment_stats()
    {
        $response = $this->get('/project');

        $response->assertStatus(200);
        $response->assertViewHas('projects');
        $response->assertViewHas('cities');
    }

    public function test_filter_projects_by_city_and_type()
    {
        $response = $this->getJson('/projects/filter?city=TestCity&type=TestType');

        $response->assertStatus(200);
        $response->assertJsonStructure(['html']);
    }

    public function test_filter_apartments_returns_correct_data()
    {
        $response = $this->getJson('/projects/1/apartments?type=TestType');

        $response->assertStatus(200);
        $response->assertJsonStructure(['apartments', 'lastApartment']);
    }
}
