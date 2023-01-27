<?php

namespace Tests;

use App\Models\Department;
use App\Models\Filial;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Measurement;
use App\Models\Product;
use App\Models\Provider;
use App\Models\Storage;
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
        Filial::factory(10)->create();
        Department::factory(10)->create();
        Product::factory(30)->create();
        Provider::factory(5)->create();
        Invoice::factory(7)->create();
        InvoiceItem::factory(10)->create();
        Storage::factory(5)->create();
    }

    protected function headers(): array
    {
        return [
            'Accept' => 'application/json'
        ];
    }
}
