<?php

namespace Tests\Feature;

use App\Models\Apartment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class CompareControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_user_can_add_apartment_to_compare()
    {
        $apartment = Apartment::factory()->create();

        // Изначально compare должен быть пуст
        $this->assertEmpty(session('compare', []));

        $response = $this->postJson("/compare/add/{$apartment->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'added',
                 ]);

        // Повторно получить сессию с помощью GET-запроса
        $getResponse = $this->get('/compare');

        // Проверка: в view передаётся нужная квартира
        $getResponse->assertViewHas('apartments', function ($apartments) use ($apartment) {
            return $apartments->pluck('id')->contains($apartment->id);
        });
    }


    /** @test */
    public function user_cannot_add_same_apartment_twice()
    {
        $apartment = Apartment::factory()->create();

        session(['compare' => [$apartment->id]]);

        $response = $this->postJson("/compare/add/{$apartment->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'added',
                 ]);

        $compare = session('compare');
        $this->assertCount(1, $compare);
        $this->assertEquals([$apartment->id], $compare);
    }

    /** @test */
    public function user_can_remove_apartment_from_compare()
    {
        $apartment1 = Apartment::factory()->create();
        $apartment2 = Apartment::factory()->create();

        // Устанавливаем сессию с двумя элементами
        session(['compare' => [$apartment1->id, $apartment2->id]]);

        $response = $this->delete("/compare/remove/{$apartment1->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'removed',
                 ]);

        $this->assertNotContains($apartment1->id, session('compare'));
        $this->assertContains($apartment2->id, session('compare'));
    }

    /** @test */
    public function user_can_view_compared_apartments()
    {
        $apartment1 = Apartment::factory()->create();
        $apartment2 = Apartment::factory()->create();

        session(['compare' => [$apartment1->id, $apartment2->id]]);

        $response = $this->get('/compare');

        $response->assertStatus(200);
        $response->assertViewIs('compare');
        $response->assertViewHas('apartments', function ($apartments) use ($apartment1, $apartment2) {
            return $apartments->contains($apartment1) && $apartments->contains($apartment2);
        });
    }
}
