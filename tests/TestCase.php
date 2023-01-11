<?php

namespace Tests;

use App\Models\Measurement;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;


    protected function setUp(): void
    {
        parent::setUp();


        Artisan::call('migrate');

        Measurement::factory(5)->create();
    }

    protected function headers(): array
    {
        return [
            'Accept' => 'application/json'
        ];
    }
}
