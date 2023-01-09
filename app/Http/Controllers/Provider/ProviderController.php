<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Http\Requests\Provider\StoreRequest;
use App\Http\Requests\Provider\UpdateRequest;
use App\Models\Provider;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $data = Provider::all();
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
        $data = Provider::query()->create($request->validated());
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $data = Provider::query()->findOrFail($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Provider $provider
     * @return JsonResponse
     */
    public function update(UpdateRequest $request,Provider $provider): JsonResponse
    {
        $provider->update($request->validated());
        return response()->json($provider);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Provider $provider
     * @return JsonResponse
     */
    public function delete(Provider $provider): JsonResponse
    {
        $provider->delete();
        return response()->json([
            'message'=>'successfully deleted!'
        ]);
    }
}
