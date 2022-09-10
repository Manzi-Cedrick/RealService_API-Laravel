<?php

use App\Http\Controllers\ClientControl;
use App\Http\Controllers\ProductController;
use App\Models\Client;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/clientAll',[ClientControl::class,'index']);
Route::post('/createClient',[ClientControl::class,'store']);
Route::put('/updateClient/{client}',[ClientControl::class,'update']);
Route::delete('/deleteClient/{client}',[ClientControl::class,'destroy']);
Route::get('/singleClientInfo/{client}',[ClientControl::class,'ShowSingleClient']);

//Product routes

Route::get('/productsAll',[ProductController::class,'index']);
Route::post('/createproduct',[ProductController::class,'store']);
Route::put('/updateproduct/{product}',[ProductController::class,'update']);
Route::delete('/deleteproduct/{product}',[ProductController::class,'destroy']);
Route::get('/singleProduct/{product}',[ProductController::class,'ShowSingleProduct']);