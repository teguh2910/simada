<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function registration_page_can_be_rendered()
    {
        $response = $this->get('/register');
        
        $response->assertStatus(200);
    }

    /** @test */
    public function new_users_can_register()
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'dept' => 'DEV',
            'npk' => 'NPK-1234',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect('/home');
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
            'name' => 'Test User',
            'dept' => 'DEV',
            'npk' => 'NPK-1234',
        ]);
    }

    /** @test */
    public function email_must_be_unique_for_registration()
    {
        $user = User::factory()->create([
            'email' => 'existing@example.com',
        ]);

        $response = $this->post('/register', [
            'name' => 'New User',
            'email' => 'existing@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'dept' => 'DEV',
            'npk' => 'NPK-5678',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function password_must_be_confirmed_for_registration()
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'different-password',
            'dept' => 'DEV',
            'npk' => 'NPK-1234',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors('password');
    }
}
