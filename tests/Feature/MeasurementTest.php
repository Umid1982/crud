<?php

namespace Tests\Feature;

use App\Models\Measurement;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class MeasurementTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_successful_index()
    {
        $this->get('/api/v1/measurement')
            ->assertOk()
            ->assertJsonStructure([
                [
                    'id',
                    'name_uz',
                    'name_ru',
                    'name_en',
                    'created_at',
                    'updated_at'
                ]
            ]);
    }

    public function test_successful_show()
    {
        $measurement = Measurement::query()->inRandomOrder()->first();
        $this->get('/api/v1/measurement/' . $measurement->id)
            ->assertOk()
            ->assertJsonStructure([
                'id',
                'name_uz',
                'name_ru',
                'name_en',
                'created_at',
                'updated_at'
            ]);
    }

    public function test_fail_show_with_wrong_id()
    {
        $measurement_id = 100000000;

        $this->get('/api/v1/measurement/' . $measurement_id)
            ->assertNotFound();
    }

    public function test_fail_show_with_string_id()
    {
        $measurement_id = "asdsada";

        $this->get('/api/v1/measurement/' . $measurement_id)
            ->assertNotFound();
    }

    public function test_successful_create()
    {
        $measurement = Measurement::factory()->raw();

        $response = $this->post('/api/v1/measurement', $measurement)
            ->assertCreated()
            ->assertJsonStructure([
                'id',
                'name_uz',
                'name_ru',
                'name_en',
                'created_at',
                'updated_at'
            ]);

        $data = $response->json();

        $this->assertEquals($measurement['name_uz'], $data['name_uz']);
        $this->assertEquals($measurement['name_ru'], $data['name_ru']);
        $this->assertEquals($measurement['name_en'], $data['name_en']);
    }

    public function test_fail_create_wrong_data_keys()
    {
        $measurement = Measurement::factory()->raw();
        unset($measurement['name_uz']);

        $this->post('/api/v1/measurement', $measurement, $this->headers())
            ->assertStatus(422)
            ->assertJsonStructure([
                'message',
                'errors' => [
                    'name_uz'
                ]
            ]);
    }

    public function test_fail_create_data_with_long_name()
    {
        $measurement = Measurement::factory()->raw([
            'name_uz' => Str::random(400)
        ]);

        $this->post('/api/v1/measurement', $measurement, $this->headers())
            ->assertStatus(422)
            ->assertJsonStructure([
                'message',
                'errors' => [
                    'name_uz'
                ]
            ]);
    }

    public function test_successful_update()
    {
        $data = Measurement::factory()->raw();

        $measurement = Measurement::query()->inRandomOrder()->first();

        $response = $this->put('/api/v1/measurement/' . $measurement->id, $data, $this->headers())
            ->assertOk()
            ->assertJsonStructure([
                'id',
                'name_uz',
                'name_ru',
                'name_en',
                'created_at',
                'updated_at'
            ]);

        $response_data = $response->json();

        $this->assertEquals($response_data['id'], $measurement->id);
        $this->assertEquals($response_data['name_uz'], $data['name_uz']);
        $this->assertEquals($response_data['name_ru'], $data['name_ru']);
        $this->assertEquals($response_data['name_en'], $data['name_en']);
    }

    public function test_fail_update_data_with_wrong_measurement_id()
    {
        $data = Measurement::factory()->raw();
        $measurement_id = 100000;

        $this->put('/api/v1/measurement/' . $measurement_id, $data, $this->headers())
            ->assertNotFound();
    }

    public function test_fail_update_data_with_wrong_keys()
    {
        $data = Measurement::factory()->raw();
        unset($data['name_ru']);
        $measurement = Measurement::query()->inRandomOrder()->first();

        $this->put('/api/v1/measurement/' . $measurement->id, $data, $this->headers())
            ->assertStatus(422)
            ->assertJsonStructure([
                'message',
                'errors' => [
                    'name_ru'
                ]
            ]);
    }

    public function test_fail_update_data_with_long_name()
    {
        $data = Measurement::factory()->raw([
            'name_ru' => Str::random(120)
        ]);

        $measurement = Measurement::query()->inRandomOrder()->first();

        $this->put('/api/v1/measurement/' . $measurement->id, $data, $this->headers())
            ->assertStatus(422)
            ->assertJsonStructure([
                'message',
                'errors' => [
                    'name_ru'
                ]
            ]);
    }

    public function test_successful_delete()
    {
        $measurement = Measurement::query()->inRandomOrder()->first();

        $this->delete('/api/v1/measurement/' . $measurement->id, [], $this->headers())
            ->assertOk()
            ->assertJsonStructure([
                'message'
            ]);

        $this->assertModelMissing($measurement);
    }
}
