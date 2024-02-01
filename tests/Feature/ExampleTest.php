<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        //$response = $this->get('/test');

        $user = User::find(1);

        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200);
    }
}
