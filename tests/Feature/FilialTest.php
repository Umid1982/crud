<?php

namespace Tests\Feature;

use App\Models\Filial;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JetBrains\PhpStorm\NoReturn;
use Psy\Util\Str;
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
                    'id',
                    'name_uz',
                    'name_ru',
                    'name_en',
                ]
            ]);
    }

    public function test_successful_show()
    {
        $filial = Filial::query()->inRandomOrder()->first();
        $filialId = $this->get('api/v1/filial/' . $filial->id)
            ->assertOk()
            ->assertJsonStructure([
                'name_uz',
                'name_ru',
                'name_en'
            ]);
    }

    public function test_fail_show_with_wrong_id()
    {
        $filial_id = 1000000;
        $this->get('/api/v1/filial/' . $filial_id, $this->headers())
            ->assertNotFound();
    }

    public function test_fail_show_with_string_id()
    {
        $filial_id = 'asdf';
        $this->get('/api/v1/filial' . $filial_id, $this->headers())
            ->assertNotFound();
    }

    public function test_successful_create()
    {
        $filial = Filial::factory()->raw();
        $response = $this->post('/api/v1/filial', $filial)
            ->assertCreated()->assertJsonStructure([
                'name_uz',
                'name_ru',
                'name_en',
            ]);
        $data = $response->json();
        $this->assertEquals($filial['name_uz'],$data['name_uz']);
        $this->assertEquals($filial['name_ru'],$data['name_ru']);
        $this->assertEquals($filial['name_en'],$data['name_en']);
    }
    public function test_fail_create_wrong_data_keys(){
        $filial = Filial::factory()->raw();
        unset($filial['name_uz']);
        $this->post('/api/v1/filial/',$filial,$this->headers())
        ->assertStatus(422)
        ->assertJsonStructure([
            'message',
            'errors'=>[
                'name_uz'
            ]
        ]);
    }
    public function test_fail_create_data_with_long_name(){
        $data = Filial::factory()->raw([
            'name_ru'=> \Illuminate\Support\Str::random(120),
        ]);
        $filial = Filial::query()->inRandomOrder()->first();
        $this->put('/api/v1/department/' . $filial->id, $data, $this->headers())
            ->assertStatus(422)
            ->assertJsonStructure([
                'message',
                'errors'=>[
                    'name_ru'
                ]
            ]);
    }

    public function test_successful_delete(){
        $filial = Filial::query()->inRandomOrder()->first();
       $this->delete('/api/v1/filial/' . $filial->id,[],$this->headers())
        ->assertOk()
        ->assertJsonStructure([
            'message'
        ]);
        $this->assertModelMissing($filial);
    }

}
