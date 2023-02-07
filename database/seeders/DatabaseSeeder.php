<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Department;
use App\Models\Filial;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Measurement;
use App\Models\Product;
use App\Models\Provider;
use App\Models\Storage;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            MeasurementSeedder::class
        ]);
        Filial::factory(5)->create();
        Department::factory(5)->create();
        Product::factory(5)->create();
        Provider::factory(5)->create();
        Invoice::factory(10)->create();
        InvoiceItem::factory(10)->create();
        Storage::factory(5)->create();
    }
}
