<?php

namespace App\Http\Controllers;

use App\Http\Requests\Filial\StoreRequest;
use App\Http\Requests\Filial\UpdateRequest;
use App\Models\Filial;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class FilialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $data = Filial::all();
        return response()->json($data);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = Filial::query()->create($request->validated());
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $data = Filial::query()->findOrFail($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Filial $filial
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRequest $request,Filial $filial): \Illuminate\Http\JsonResponse
    {
        $filial->update($request->validated());
        return response()->json($filial);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Filial $filial
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Filial $filial): \Illuminate\Http\JsonResponse
    {
        $filial->delete();
        return \response()->json(['
        Объект удален!
        ']);
    }
}
