<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use App\Http\Requests\Department\StoreRequest;
use App\Http\Requests\Department\UpdateRequest;
use App\Models\Department;
use Illuminate\Http\JsonResponse;


class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $data = Department::all();
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
        $data = Department::query()->create($request->validated());
        return response()->json($data,201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $data = Department::query()->findOrFail($id);

        return response()->json($data);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Department $department
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Department $department): JsonResponse
    {
        $department->update($request->validated());
        return response()->json($department);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Department $department
     * @return JsonResponse
     */
    public function delete(Department $department): JsonResponse
    {
        $department->prodocts()->delete();
        $department->delete();
        return response()->json([
            'message' => 'Успешно удалено!'
        ]);
    }
}
