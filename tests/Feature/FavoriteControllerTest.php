<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Apartment;
use App\Models\Favorite;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FavoriteControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_cannot_add_favorite()
    {
        $response = $this->postJson('/favorites/add', [
            'apartment_id' => 1,
        ]);

        // Laravel возвращает 302 (redirect) на /login при web auth, или 401 при API auth
        $response->assertStatus(401);
    }

    /** @test */
    public function user_can_add_apartment_to_favorites()
    {
        $user = User::factory()->create();
        $apartment = Apartment::factory()->create();

        $response = $this->actingAs($user)->postJson('/favorites/add', [
            'apartment_id' => $apartment->id,
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Квартира успешно добавлена в избранное!',
                 ]);

        $this->assertDatabaseHas('favorites', [
            'user_id' => $user->id,
            'apartment_id' => $apartment->id,
        ]);
    }

    /** @test */
    public function user_cannot_add_same_apartment_twice()
    {
        $user = User::factory()->create();
        $apartment = Apartment::factory()->create();

        $this->actingAs($user)->postJson('/favorites/add', [
            'apartment_id' => $apartment->id,
        ]);

        // Повторная попытка
        $response = $this->actingAs($user)->postJson('/favorites/add', [
            'apartment_id' => $apartment->id,
        ]);

        $response->assertStatus(409) // предполагаем, что ты вернёшь 409 Conflict
                 ->assertJson([
                     'message' => 'Уже в избранном',
                 ]);
    }

    /** @test */
    public function user_can_remove_apartment_from_favorites()
    {
        $user = User::factory()->create();
        $apartment = Apartment::factory()->create();

        // Добавим в избранное вручную
        $user->favorites()->attach($apartment->id);

        $response = $this->actingAs($user)->deleteJson("/favorites/{$apartment->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Квартира удалена из избранного',
                 ]);

        $this->assertDatabaseMissing('favorites', [
            'user_id' => $user->id,
            'apartment_id' => $apartment->id,
        ]);
    }
}
