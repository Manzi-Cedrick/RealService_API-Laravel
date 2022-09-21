<?php

use App\Http\Controllers\ClientControl;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
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
Route::get('/allsales',[ClientControl::class,'AllSales']);
Route::get('/clientsearch',[ClientControl::class,'SearchList']);

//Product routes

Route::get('/productsAll',[ProductController::class,'index']);
Route::post('/createproduct',[ProductController::class,'store']);
Route::put('/updateproduct/{product}',[ProductController::class,'update']);
Route::delete('/deleteproduct/{product}',[ProductController::class,'destroy']);
Route::get('/singleproductClients/{product}',[ProductController::class,'ShowSingleProductClients']);
Route::get('/productsearch',[ProductController::class,'SearchList']);

//Stock routes

Route::get('/stockAll',[StockController::class,'index']);
Route::post('/createstock',[StockController::class,'store']);
Route::put('/updatestock/{stock}',[StockController::class,'update']);
Route::delete('/deletestock/{stock}',[StockController::class,'destroy']);
Route::get('/singleStockList/{stock}',[StockController::class,'ShowSingleStock']);
Route::get('/stocksearch',[StockController::class,'SearchList']);