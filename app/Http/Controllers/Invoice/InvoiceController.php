<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use App\Http\Requests\Invoice\StoreRequest;
use App\Http\Requests\Invoice\AcceptRequest;
use App\Models\Invoice;
use App\Models\Storage;
use Illuminate\Http\JsonResponse;


class InvoiceController extends Controller
{
    public function index(): JsonResponse
    {
        $data = Invoice::all();
        return response()->json($data);
    }

    public function show(int $id): JsonResponse
    {
        $data = Invoice::query()->findOrFail($id);
        return response()->json($data);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $validated = $request->validated();
        /** @var Invoice $data */
        $data = Invoice::query()->create($validated);
        if (!empty($validated['invoice_items'])) {
            $data->invoiceItems()->createMany($validated['invoice_items']);
        }

        return response()->json($data->load('invoiceItems.product.measurement'), 201);
    }

    public function accept(AcceptRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $data = Invoice::query()->with('invoiceItems')->findOrFail($validated['invoice_id']);

        if ($validated['accept']) {
            foreach ($data->invoiceItems as $invoice_item) {
                $storage = Storage::query()->where('product_id', '=', $invoice_item->product_id)->first();
                if (!$storage) {
                    Storage::query()->create([
                        'product_id' => $invoice_item->product_id,
                        'amount' => $invoice_item->amount
                    ]);
                } else {
                    $storage->update([
                        'amount' => $storage->amount + $invoice_item->amount
                    ]);
                }
            }
        }

        $data->update(['accept' => $validated['accept']]);


        return response()->json($data);
    }
}
