<?php

namespace App\Http\Controllers;

use App\Http\Requests\Measurement\StoreRequest;
use App\Http\Requests\Measurement\UpdateRequest;
use App\Models\Measurement;
use Illuminate\Http\JsonResponse;

class MeasurementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $data = Measurement::all();
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $data = Measurement::query()->create($request->validated());
        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $data = Measurement::query()->findOrFail($id);

        return response()->json($data);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Measurement $measurement
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Measurement $measurement): JsonResponse
    {
        $measurement->update($request->validated());

        return response()->json($measurement);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Measurement $measurement
     * @return JsonResponse
     */
    public function delete(Measurement $measurement): JsonResponse
    {
        $measurement->delete();

        return response()->json([
            'message' => 'Удалено'
        ]);
    }
}
