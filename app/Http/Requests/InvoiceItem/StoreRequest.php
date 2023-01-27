<?php

namespace App\Http\Requests\InvoiceItem;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'invoice_id' => 'required|integer|exists:invoices,id',
            'invoice_items' => 'required|array',
            'invoice_items.*.product_id' => 'required|integer|exists:products,id',
            'invoice_items.*.price' => 'required|numeric',
            'invoice_items.*.amount' => 'required|numeric',
        ];
    }
}
