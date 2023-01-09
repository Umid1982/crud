<?php

use App\Http\Controllers\Api\FilialController;
use App\Http\Controllers\MeasurementController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::prefix('v1')->name('api.')->group(function () {
//
//    Route::prefix('filial')->name('filial.')->group(function () {
//        Route::get('', [FilialController::class, 'index'])->name('index');
//        Route::get('show/{id}', [FilialController::class, 'edit'])->name('show');
//        Route::post('', [FilialController::class, 'store'])->name('store');
//        Route::put('{filial}', [FilialController::class, 'update'])->name('update');
//        Route::delete('{filial}', [FilialController::class, 'delete'])->name('delete');
//    });

//    Route::group([
//        'prefix' => 'department',
//        'as' => 'department.',
//        'middleware' => 'auth'
//    ], function () {
//        Route::get('', [FilialController::class, 'index'])->name('index');
//        Route::get('create', [FilialController::class, 'create'])->name('create');
//        Route::get('edit/{id}', [FilialController::class, 'edit'])->name('edit');
//        Route::get('show/{id}', [FilialController::class, 'edit'])->name('show');
//        Route::post('', [FilialController::class, 'edit'])->name('store');
//    });
//});


Route::prefix('v1')->group(function () {
    Route::prefix('measurement')->group(function () {
        Route::get('', [MeasurementController::class, 'index']);
        Route::get('{measurement}', [MeasurementController::class, 'show']);
        Route::post('', [MeasurementController::class, 'store']);
        Route::put('{measurement}', [MeasurementController::class, 'update']);
        Route::delete('{measurement}', [MeasurementController::class, 'delete']);
    });
    Route::prefix('filial')->group(function () {
        Route::get('', [\App\Http\Controllers\FilialController::class,'index']);
        Route::get('{filial}', [\App\Http\Controllers\FilialController::class, 'show']);
        Route::post('', [\App\Http\Controllers\FilialController::class, 'store']);
        Route::put('{filial}', [\App\Http\Controllers\FilialController::class, 'update']);
        Route::delete('{filial}', [\App\Http\Controllers\FilialController::class, 'delete']);
    });
    Route::prefix('department')->group(function (){

        Route::get('', [\App\Http\Controllers\Department\DepartmentController::class, 'index']);
        Route::get('{department}', [\App\Http\Controllers\Department\DepartmentController::class, 'show']);
        Route::post('', [\App\Http\Controllers\Department\DepartmentController::class, 'store']);
        Route::put('{department}', [\App\Http\Controllers\Department\DepartmentController::class, 'update']);
        Route::delete('{department}', [\App\Http\Controllers\Department\DepartmentController::class, 'delete']);
    });
});
