<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminLoginApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_user_can_login_successfully()
    {
        $admin = User::factory()->create([
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'role' => 'Admin',
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'admin@example.com',
            'password' => 'admin123',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['token', 'user']);
        $this->assertEquals('Admin', $response->json('user.role'));
    }

    /** @test */
    public function non_admin_user_cannot_login()
    {
        $user = User::factory()->create([
            'email' => 'user@example.com',
            'password' => Hash::make('user123'),
            'role' => 'User', // Bukan admin
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'user@example.com',
            'password' => 'user123',
        ]);

        $response->assertStatus(403); // atau 401 jika unauthorized
        $response->assertJson(['message' => 'Unauthorized']);
    }

    /** @test */
    public function login_fails_with_invalid_credentials()
    {
        $user = User::factory()->create([
            'email' => 'admin2@example.com',
            'password' => Hash::make('admin123'),
            'role' => 'Admin',
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'admin2@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertStatus(401);
        $response->assertJson(['message' => 'Unauthorized']);
    }
}
