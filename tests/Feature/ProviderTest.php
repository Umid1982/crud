<?php

namespace Tests\Feature;

use App\Models\Provider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Psy\Util\Str;
use Tests\TestCase;

class ProviderTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_successful_index(): void
    {
        $this->get('/api/v1/provider')
            ->assertOk()
            ->assertJsonStructure([
                [
                    'name_uz',
                    'name_ru',
                    'name_en',
                    'phone',
                ]
            ]);
    }

    public function test_successful_show()
    {
        $provider = Provider::query()->inRandomOrder()->first();
        $this->get('/api/v1/provider/' . $provider->id)
        ->assertOk()
        ->assertJsonStructure([
            'name_uz',
            'name_ru',
            'name_en',
            'phone',
        ]);
    }
    public function test_fail_show_with_wrong_id(){
        $provider_id = 1000000;
        $this->get('/api/v1/provider/' . $provider_id, $this->headers())
            ->assertNotFound();
    }
    public function test_fail_show_with_string_id(){
        $provider_id = 'asdfg';
        $this->get('/api/v1/provider/' . $provider_id,$this->headers())
            ->assertNotFound();
    }
    public function test_successful_create(){
        $provider = Provider::factory()->raw();
        $response = $this->post('/api/v1/provider/', $provider)
            ->assertCreated()
            ->assertJsonStructure([
                'name_uz',
                'name_ru',
                'name_en',
                'phone',
            ]);
        $data = $response->json();
        $this->assertEquals($provider['name_uz'],$data['name_uz']);
        $this->assertEquals($provider['name_ru'],$data['name_ru']);
        $this->assertEquals($provider['name_en'],$data['name_en']);
        $this->assertEquals($provider['phone'],$data['phone']);
    }
    public function test_fail_create_wrong_data_keys(){
        $provider = Provider::factory()->raw();
        unset($provider['name_uz']);
        $this->post('/api/v1/provider', $provider, $this->headers())
        ->assertStatus(422)
        ->assertJsonStructure([
            'message',
            'errors'=>['name_uz']
        ]);
    }
    public function test_fail_create_data_with_long_name(){
        $data = Provider::factory()->raw([
            'name_ru'=> \Illuminate\Support\Str::random(120)
        ]);
        $provider = Provider::query()->inRandomOrder()->first();
        $this->put('/api/v1/provider/' . $provider->id, $data, $this->headers())
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
        $provider = Provider::query()->inRandomOrder()->first();

        $this->delete('/api/v1/provider/' . $provider->id, [], $this->headers())
            ->assertOk()
            ->assertJsonStructure([
                'message'
            ]);

        $this->assertModelMissing($provider);
    }
}
