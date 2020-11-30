<?php

use App\Http\Controllers\DataSourceController;
use App\Http\Controllers\ShirtOrderController;
use App\Http\Controllers\TestResourceController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => 'json.response',
    'prefix' => 'test-resource'
], function () {
    Route::get('/', [TestResourceController::class, 'getById']);
    Route::post('/create', [TestResourceController::class, 'insert']);
    Route::put('/', [TestResourceController::class, 'updateById']);
    Route::delete('/', [TestResourceController::class, 'deleteById']);
    Route::post('/datasource', [ShirtOrderController::class, 'datasource']);
});

Route::group([
    'middleware' => 'json.response',
    'prefix' => 'data-source'
], function () {
    Route::get('/', [DataSourceController::class, 'all']);
    Route::post('/', [DataSourceController::class, 'create']);
    Route::get('/{tag}/{type}', [DataSourceController::class, 'get']);
    Route::delete('/{tag}/{type}', [DataSourceController::class, 'delete']);
});

Route::group([
    'middleware' => 'json.response',
    'prefix' => 'shirt-order'
], function () {
    Route::post('/receive', [ShirtOrderController::class, 'receive']);
    Route::post('/create', [ShirtOrderController::class, 'create']);
    Route::post('/update', [ShirtOrderController::class, 'update']);
    Route::post('/delete', [ShirtOrderController::class, 'delete']);
});
