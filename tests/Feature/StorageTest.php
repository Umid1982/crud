<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StorageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_successful_index(): void
    {
        $this->get('/api/v1/storage')
            ->assertOk()
            ->assertJsonStructure([
                [
                    'product_id',
                    'amount',
                    'default_amount',
                ]
            ]);
    }
}
