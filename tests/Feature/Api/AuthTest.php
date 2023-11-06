<?php

namespace Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_api(): void
    {
        $password = 'password';
        $user = User::factory()->create(['password' => Hash::make($password)]);

        $this->postJson('api/login', [
                'email' => $user->email,
                'password' => $password,
                'token_name' => 'api',
            ])
            ->assertOk()
            ->assertJsonStructure(['token']);
    }

    public function test_register_api(): void
    {
        $this->postJson('api/register', [
            'name' => 'test',
            'email' => 'test@test.com',
            'password' => '12345678',
            'password_confirmation' => '12345678',
            'token_name' => 'api',
        ])
            ->assertOk()
            ->assertJsonStructure(['token']);
    }
}
