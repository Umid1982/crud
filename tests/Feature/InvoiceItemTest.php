<?php

namespace Tests\Feature;

use App\Models\InvoiceItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InvoiceItemTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_successful_index(): void
    {
        $this->get('/api/v1/invoice-items')
            ->assertOk()
            ->assertJsonStructure([
                [
                    'invoice_id',
                    'product_id',
                    'price',
                    'amount',
                ]
            ]);
    }

    public function test_successful_create()
    {
        $invoiceItem = InvoiceItem::factory()->raw();
        $invoice_id = $invoiceItem['invoice_id'];
        unset($invoiceItem['invoice_id']);

        $payload = [
            'invoice_id' => $invoice_id,
            'invoice_items' => [$invoiceItem]
        ];

        $response = $this->post('/api/v1/invoice-items', $payload, $this->headers())
        ->assertCreated()
        ->assertJsonStructure([
            [
                'id',
                'invoice_id',
                'product_id',
                'price',
                'amount',
            ]
        ]);
        $data = $response->json();

        $this->assertEquals($invoice_id,$data[0]['invoice_id']);
        $this->assertEquals($invoiceItem['product_id'],$data[0]['product_id']);
        $this->assertEquals($invoiceItem['price'],$data[0]['price']);
        $this->assertEquals($invoiceItem['amount'],$data[0]['amount']);
    }
    public function test_fail_create_wrong_data_keys(){
        $invoiceItem = InvoiceItem::factory()->raw();
        unset($invoiceItem['invoice_id']);
        $this->post('/api/v1/invoice-items',$invoiceItem,$this->headers())
        ->assertStatus(422)
        ->assertJsonStructure([
            'message',
            'errors'=>[
                'invoice_id'
            ]
        ]);
    }
}
