<?php

use Illuminate\Http\Request;
use App\Http\Controllers\SellerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/sellers', [SellerController::class, 'sellers_list']);
Route::get('/sellers_by_id/{sellerId}', [SellerController::class, 'sellers_by_id']);
Route::post('/save_sellers', [SellerController::class, 'insertSeller']);