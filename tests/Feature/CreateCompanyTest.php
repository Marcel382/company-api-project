<?php

namespace Tests\Feature;

use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class CreateCompanyTest extends TestCase
{
    public function test_it_can_create_a_company()
    {
        $response = $this->postJson('/api/companies',
        [
            "name" => "Test Company",
            "organization_number" => 12345678,
            "email" => "test@company.com",
            "phone_number" => "+4512345678",
            "address" => "Test Address",
            "city" => "Test City",
            "postal_code" => 5000,
        ])
            ->assertStatus(201)
            ->assertSee('id');

        $this->assertTrue(Uuid::isValid($response->json()['id']));
    }
}
