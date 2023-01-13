<?php

namespace Tests;

use App\Models\Department;
use App\Models\Filial;
use App\Models\Measurement;
use App\Models\Product;
use App\Models\Provider;
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
        Filial::factory(5)->create();
        Department::factory(5)->create();
        Product::factory(5)->create();
        Provider::factory(5)->create();
    }

    protected function headers(): array
    {
        return [
            'Accept' => 'application/json'
        ];
    }
}
