<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JetBrains\PhpStorm\NoReturn;
use Tests\TestCase;

class FilialTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
     public function test_successful_index(): void
     {
        $this->get('/api/v1/filial')
            ->assertOk()
            ->assertJsonStructure([
                [
                    'name_uz',
                    'name_ru',
                    'name_en',
                ]
            ]);

    }
}
