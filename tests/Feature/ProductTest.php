<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_successful_index()
    {
        $this->get('/api/v1/product')
            ->assertOk()
            ->assertJsonStructure([
                [
                    'id',
                    'name_uz',
                    'name_ru',
                    'name_en',
                    'image',
                    'measurement_id',
                    'price',
                    'department_id',
                    'barcode',
                ]
            ]);
    }

    public function test_successful_show()
    {
        $product = Product::query()->inRandomOrder()->first();
        $this->get('/api/v1/product/' . $product->id)
            ->assertOk()
            ->assertJsonStructure([
                'id',
                'name_uz',
                'name_ru',
                'name_en',
                'image',
                'measurement_id',
                'price',
                'department_id',
                'barcode'
            ]);
    }

    public function test_fail_show_with_wrong_id()
    {
        $product_id = 1000000;
        $this->get('/api/v1/product/' . $product_id, $this->headers())
            ->assertNotFound();
    }

    public function test_fail_show_with_string_id()
    {
        $product_id = 'asdfg';
        $this->get('/api/v1/product' . $product_id, $this->headers())
            ->assertNotFound();
    }

    public function test_successful_create()
    {
        $product = Product::factory()->raw();
        $response = $this->post('/api/v1/product', $product)
            ->assertCreated()
            ->assertJsonStructure([
                'id',
                'name_uz',
                'name_ru',
                'name_en',
                'image',
                'measurement_id',
                'price',
                'department_id',
                'barcode',
            ]);
        $data = $response->json();
        $this->assertEquals($product['name_uz'], $data['name_uz']);
        $this->assertEquals($product['name_ru'], $data['name_ru']);
        $this->assertEquals($product['name_en'], $data['name_en']);
        $this->assertEquals($product['image'], $data['image']);
        $this->assertEquals($product['measurement_id'], $data['measurement_id']);
        $this->assertEquals($product['price'], $data['price']);
        $this->assertEquals($product['department_id'], $data['department_id']);
        $this->assertEquals($product['barcode'], $data['barcode']);
    }
    public function test_fail_create_wrong_data_keys(){
        $product = Product::factory()->raw();
        unset($product['name_uz']);
        $this->post('/api/v1/product', $product, $this->headers())
        ->assertStatus(422)
        ->assertJsonStructure([
            'message',
            'errors'=>[
                'name_uz'
            ]
        ]);
    }
    public function test_fail_create_data_with_long_name(){
        $data = Product::factory()->raw([
            'name_ru'=>Str::random(120)
        ]);
        $product = Product::query()->inRandomOrder()->first();
        $this->put('/api/v1/product/' . $product->id,$data,$this->headers())
        ->assertStatus(422)
        ->assertJsonStructure([
            'message',
            'errors'=>[
                'name_ru'
            ]
        ]);
    }

    public function test_successful_delete()
    {
        $product = Product::query()->inRandomOrder()->first();
        $this->delete('/api/v1/product/' . $product->id, [], $this->headers())
        ->assertOk()
        ->assertJsonStructure([
            'message'
        ]);
        $this->assertModelMissing($product);
    }
}
