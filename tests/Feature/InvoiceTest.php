<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InvoiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_successful_index()
    {
        $response = $this->get('/api/v1/invoice')
            ->assertOk()
            ->assertJsonStructure([
                [
                    'provider_id',
                    'total_sum',
                    'accept',
                    'is_paid',
                ]
            ]);
    }
}
