<?php

namespace App\Http\Controllers\Storage;

use App\Http\Controllers\Controller;
use App\Models\Storage;
use Illuminate\Http\Request;

class StorageController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        $data = Storage::all();
        return response()->json($data);
    }
}
