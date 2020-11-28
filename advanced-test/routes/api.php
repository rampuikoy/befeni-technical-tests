<?php

use App\Http\Controllers\ShirtOrderController;
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
    'prefix' => 'shirt-order'
], function () {
    Route::get('/{id}', [ShirtOrderController::class, 'getById']);
    Route::post('/create', [ShirtOrderController::class, 'insert']);
    Route::put('/{id}', [ShirtOrderController::class, 'updateById']);
    Route::delete('/{id}', [ShirtOrderController::class, 'deleteById']);
});
