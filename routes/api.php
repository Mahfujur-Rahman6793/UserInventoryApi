<?php

use App\Http\Controllers\InventoryApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('user/{id}/product-stats',[InventoryApiController::class,'index'])->name('user.product.stats');
Route::post('product-add/user/{id}',[InventoryApiController::class,'productAdd'])->name('product.add');
