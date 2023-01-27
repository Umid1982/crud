<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use App\Http\Requests\Invoice\StoreRequest;
use App\Http\Requests\Invoice\AcceptRequest;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        $data = Invoice::all();
        return response()->json($data);
    }

    public function show(int $id): \Illuminate\Http\JsonResponse
    {
        $data = Invoice::query()->findOrFail($id);
        return response()->json($data);
    }

    public function store(StoreRequest $request): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validated();

        $data = Invoice::query()->create($validated);

        $data->invoiceItems()->createMany($validated['invoice_items']);

        return response()->json($data);
    }

    public function accept(AcceptRequest $request): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validated();

        $data = Invoice::query()->findOrFail($validated['invoice_id']);

        if ($data->accept == false || $data->accept == true) {
            $data->update([
                'accept' => $validated['accept']
            ]);
        }
        return response()->json($data);
    }
}
