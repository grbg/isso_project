<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function register_requires_valid_data_and_sends_verification_email()
    {
        Notification::fake();

        $response = $this->postJson('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '1234567890',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertStatus(200)
                 ->assertJson(['status' => 'verification_required']);

        $user = User::where('email', 'test@example.com')->first();
        $this->assertNotNull($user);
        $this->assertTrue(\Hash::check('password123', $user->password));

        // Проверяем, что уведомление о верификации отправлено
        Notification::assertSentTo($user, VerifyEmail::class);
    }

    /** @test */
    public function register_fails_with_invalid_data()
    {
        $response = $this->postJson('/register', [
            'name' => '',
            'email' => 'not-an-email',
            'phone' => '123',
            'password' => 'short',
            'password_confirmation' => 'nomatch',
        ]);

        $response->assertStatus(422)
                 ->assertJsonStructure(['errors' => ['name', 'email', 'phone', 'password']]);
    }

    /** @test */
    public function login_succeeds_with_correct_credentials()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password123'),
        ]);

        $response = $this->postJson('/login', [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure(['redirect']);
    }

    /** @test */
    public function login_fails_with_wrong_credentials()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password123'),
        ]);

        $response = $this->postJson('/login', [
            'email' => $user->email,
            'password' => 'wrongpassword',
        ]);

        $response->assertStatus(422)
                 ->assertJson(['errors' => ['email' => ['Неверные учетные данные']]]);
    }

    /** @test */
    public function logout_logs_out_user_and_redirects()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get('/logout');

        $response->assertRedirect('/auth-toggle');

        $this->assertGuest();
    }

    /** @test */
    public function user_can_update_phone()
    {
        $user = User::factory()->create([
            'phone' => '1234567890',
        ]);

        $this->actingAs($user);

        $response = $this->postJson('/update-phone', [
            'phone' => '0987654321',
        ]);

        $response->assertStatus(200)
                 ->assertJson(['success' => true, 'message' => 'Телефон обновлён']);

        $this->assertEquals('0987654321', $user->fresh()->phone);
    }

    /** @test */
    public function user_can_update_email()
    {
        $user = User::factory()->create([
            'email' => 'old@example.com',
        ]);

        $this->actingAs($user);

        $response = $this->postJson('/update-email', [
            'email' => 'new@example.com',
        ]);

        $response->assertStatus(200)
                 ->assertJson(['success' => true, 'message' => 'Почта обновлена']);

        $this->assertEquals('new@example.com', $user->fresh()->email);
    }

    /** @test */
    public function user_can_update_password()
    {
        $user = User::factory()->create([
            'password' => bcrypt('oldpassword'),
        ]);

        $this->actingAs($user);

        $response = $this->postJson('/update-password', [
            'password' => 'newpassword123',
        ]);

        $response->assertStatus(200)
                 ->assertJson(['success' => true, 'message' => 'Пароль обновлён']);

        $this->assertTrue(\Hash::check('newpassword123', $user->fresh()->password));
    }
}
