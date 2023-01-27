<?php

namespace App\Http\Controllers\InvoiceItem;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvoiceItem\StoreRequest;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;

class InvoiceItemController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        $data = InvoiceItem::all();
        return response()->json($data);
    }

    public function store(StoreRequest $request)
    {
        $data = [];
        $validated = $request->validated();
        foreach ($validated['invoice_items'] as $invoice_item) {
            $invoice_item['invoice_id'] = $validated['invoice_id'];
            $data[] = InvoiceItem::query()->create($invoice_item);
        }
        return response()->json($data);

    }
}
