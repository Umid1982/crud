<?php

namespace Tests\Feature;

use App\Models\Invoice;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InvoiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_successful_index(): void
    {
        $this->get('/api/v1/invoice')
            ->assertOk()
            ->assertJsonStructure([
                [
                    'id',
                    'provider_id',
                    'total_sum',
                    'accept',
                    'is_paid',
                ]
            ]);
    }

    public function test_successful_show()
    {
        $invoice = Invoice::query()->inRandomOrder()->first();
        $this->get('/api/v1/invoice/' . $invoice->id)
            ->assertOk()
            ->assertJsonStructure([
                'id',
                'provider_id',
                'total_sum',
                'accept',
                'is_paid',
            ]);
    }

    public function test_fail_show_with_wrong_id()
    {
        $invoice_id = 1000000;
        $this->get('/api/v1/invoice/' . $invoice_id, $this->headers())
            ->assertNotFound();
    }

    public function test_fail_show_with_string_id()
    {
        $invoice_id = 'asdfg';
        $this->get('/api/v1/invoice/' . $invoice_id, $this->headers())
            ->assertNotFound();
    }

    public function test_successful_create()
    {
        $invoice = Invoice::factory()->raw();
        $response = $this->post('/api/v1/invoice', $invoice)
            ->assertCreated()
            ->assertJsonStructure(
                [
                    'id',
                    'provider_id',
                    'total_sum',
                    'created_at',
                    'updated_at',

                ]
            );
        $data = $response->json();
        $this->assertEquals($invoice['provider_id'], $data['provider_id']);
        $this->assertEquals($invoice['total_sum'], $data['total_sum']);

    }
    public function test_fail_create_wrong_data_keys(){
        $invoice = Invoice::factory()->raw();
        unset($invoice['total_sum']);
        $this->post('/api/v1/invoice' , $invoice,$this->headers())
        ->assertStatus(422)
        ->assertJsonStructure([
            'message',
            'errors'=>[
                'total_sum'
            ]
        ]);
    }
}
