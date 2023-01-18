<?php

use App\Http\Controllers\Department\DepartmentController;
use App\Http\Controllers\FilialController;
use App\Http\Controllers\MeasurementController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Provider\ProviderController;
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
        Route::get('{measurement}', [MeasurementController::class, 'show'])->whereNumber('measurement');
        Route::post('', [MeasurementController::class, 'store']);
        Route::put('{measurement}', [MeasurementController::class, 'update'])->whereNumber('measurement');
        Route::delete('{measurement}', [MeasurementController::class, 'delete'])->whereNumber('measurement');
    });
    Route::prefix('filial')->group(function () {
        Route::get('', [FilialController::class,'index']);
        Route::get('{filial}', [FilialController::class, 'show'])->whereNumber('filial');
        Route::post('', [FilialController::class, 'store']);
        Route::put('{filial}', [FilialController::class, 'update'])->whereNumber('filial');
        Route::delete('{filial}', [FilialController::class, 'delete'])->whereNumber('filial');
    });
    Route::prefix('department')->group(function (){

        Route::get('', [DepartmentController::class, 'index']);
        Route::get('{department}', [DepartmentController::class, 'show'])->whereNumber('department');
        Route::post('', [DepartmentController::class, 'store']);
        Route::put('{department}', [DepartmentController::class, 'update'])->whereNumber('department');
        Route::delete('{department}', [DepartmentController::class, 'delete'])->whereNumber('department');
    });
    Route::prefix('provider')->group(function (){
        Route::get('', [ProviderController::class, 'index']);
        Route::get('{provider}', [ProviderController::class, 'show'])->whereNumber('provider');
        Route::post('', [ProviderController::class, 'store']);
        Route::put('{provider}', [ProviderController::class, 'update'])->whereNumber('provider');
        Route::delete('{provider}', [ProviderController::class, 'delete'])->whereNumber('provider');
    });
    Route::prefix('product')->group(function (){
        Route::get('', [ProductController::class, 'index']);
        Route::get('{product}', [ProductController::class, 'show'])->whereNumber('product');
        Route::post('', [ProductController::class, 'store']);
        Route::put('{product}', [ProductController::class, 'update'])->whereNumber('product');
        Route::delete('{product}', [ProductController::class, 'delete'])->whereNumber('product');
    });
});
