<?php

namespace Tests\Feature;

use App\Models\Department;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DepartmentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_successful_index()
    {
        $this->get('/api/v1/department')->assertOk()
            ->assertJsonStructure([
                [
                    'id',
                    'name_uz',
                    'printer',
                    'filial_id',
                    'name_ru',
                    'name_en',
                ]
            ]);
    }

    public function test_successful_show()
    {
        $department = Department::query()->inRandomOrder()->first();

        $this->get('/api/v1/department/' . $department->id)
            ->assertOk()
            ->assertJsonStructure([
                'id',
                'name_uz',
                'printer',
                'filial_id',
                'name_ru',
                'name_en'
            ]);
    }

    public function test_fail_show_with_wrong_id()
    {
        $department_id = 1000000;
        $a = $this->get('/api/v1/department/' . $department_id, $this->headers());
        $a->assertNotFound();
    }
    public function test_fail_show_with_string_id(){
        $department_id = "asdfg";
        $this->get('/api/v1/department/' . $department_id)
        ->assertNotFound();
    }
    public function test_successful_create(){
        $department = Department::factory()->raw();
        $response = $this->post('/api/v1/department', $department)
            ->assertCreated()->assertJsonStructure([
                'id',
                'name_uz',
                'printer',
                'filial_id',
                'name_ru',
                'name_en',
            ]);
        $data = $response->json();
        $this->assertEquals($department['name_uz'], $data['name_uz']);
        $this->assertEquals($department['printer'], $data['printer']);
        $this->assertEquals($department['name_ru'], $data['name_ru']);
        $this->assertEquals($department['name_en'], $data['name_en']);

    }
    public function test_fail_create_wrong_data_keys()
    {
        $department = Department::factory()->raw();
        unset($department['name_uz']);

        $this->post('/api/v1/department', $department, $this->headers())
            ->assertStatus(422)
            ->assertJsonStructure([
                'message',
                'errors' => [
                    'name_uz'
                ]
            ]);
    }
    public function test_fail_create_data_with_long_name(){
        $department = Department::factory()->raw();

    }
}
