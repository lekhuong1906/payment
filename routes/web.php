<?php

use App\Http\Controllers\OrderController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/orders', [OrderController::class, 'create']);
Route::get('/orders/{id}', [OrderController::class, 'show']);
Route::put('/orders/{id}', [OrderController::class, 'update']);
Route::patch('/orders/{id}/status', [OrderController::class, 'updateStatus']);

Route::get('mongodb', function () {
    $data = User::get();
    return response()->json(['data' => $data]);
});

Route::post('post', function (Request $request) {
    $data = $request->data;
    return response()->json(['data' => $data]);
});
