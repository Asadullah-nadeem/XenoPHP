<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SmokeTest extends TestCase
{
    /**
     * A basic smoke test to verify the application is running and returning JSON.
     */
    public function test_the_application_returns_a_successful_json_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'message',
                     'description',
                     'versions' => [
                         'laravel',
                         'php',
                         'cakephp',
                         'symfony',
                         'codeigniter',
                     ],
                 ]);
    }
}
