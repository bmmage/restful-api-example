<?php

namespace Tests\Feature;

use App\User;
use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class JwtControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAUserCanGenerateAJwtWithValidCredentials()
    {
        $response = $this->post(
            "/api/authorize",
            [
                'email' => User::first()->email,
                'password' => 'secret'
            ]
        );
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'token',
            "email",
            "first_name",
            "last_name",
            "full_name"
        ]);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAUserCanNotGenerateAJwtWithValidCredentials()
    {
        $response = $this->post(
            "/api/authorize",
            [
                'email' => User::first()->email,
                'password' => 'secrets'
            ]
        );
        $response->assertStatus(404);
    }
}
