<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $this->mockApi();

        $this->actingAs($user)
            ->get('api/home')
            ->assertJsonFragment(['first_name' => $user->first_name, 'email' => $user->email])
            ->assertJsonFragment(['temp' => 20, 'pressure' => 1015]);
    }

    protected function mockApi(): void
    {
        Http::fake();

        $responseMock = \Mockery::mock(Response::class);
        $response = json_decode(file_get_contents(__DIR__ . '/stub/location.json'), true);
        $responseMock->shouldReceive('json')->andReturn($response)->once();
        Http::shouldReceive('retry->send')->andReturn($responseMock)->once();

        $responseMock = \Mockery::mock(Response::class);
        $response = json_decode(file_get_contents(__DIR__ . '/stub/weather.json'), true);
        $responseMock->shouldReceive('json')->andReturn($response)->once();
        Http::shouldReceive('retry->send')->andReturn($responseMock)->once();
    }
}
