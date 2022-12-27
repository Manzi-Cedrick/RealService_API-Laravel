<?php

use App\Http\Controllers\Auth;
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
//protected Routes
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register',[Auth::class,'Register'])->middleware('guest');
Route::post('/login',[Auth::class,'Login'])->middleware('guest');
Route::post('/logout',[Auth::class,'Logout'])->middleware('auth:sanctum');
Route::post('/forgotpassword',[Auth::class,'ForgotPassword']);

//Protected Client Routes
Route::group(['middleware'=>'auth:sanctum'],function (){
    Route::get('/clients',[ClientControl::class,'index']);
    Route::post('/createClient',[ClientControl::class,'store']);
    Route::put('/updateClient/{client}',[ClientControl::class,'update']);
    Route::delete('/deleteClient/{client}',[ClientControl::class,'destroy']);
    Route::get('/singleClientInfo/{client}',[ClientControl::class,'ShowSingleClient']);
    Route::get('/allsales',[ClientControl::class,'AllSales']);
    Route::get('/clientsearch',[ClientControl::class,'SearchList']);
});

//Protected Product routes
Route::group(['middleware' => 'auth:sanctum'],function (){
    Route::get('/products',[ProductController::class,'index']);
    Route::post('/create/product',[ProductController::class,'store']);
    Route::put('/update/product/{product}',[ProductController::class,'update']);
    Route::delete('/delete/product/{product}',[ProductController::class,'destroy']);
    Route::get('/product/{product}',[ProductController::class,'ShowSingleProductClients']);
    Route::get('/search/product',[ProductController::class,'SearchList']);
});

//Protected Stock routes

Route::group(['middleware' => 'auth:sanctum'],function (){
    Route::get('/stocks',[StockController::class,'index']);
    Route::post('/createstock',[StockController::class,'store']);
    Route::put('/updatestock/{stock}',[StockController::class,'update']);
    Route::delete('/deletestock/{stock}',[StockController::class,'destroy']);
    Route::get('/singleStockList/{stock}',[StockController::class,'ShowSingleStock']);
    Route::get('/stocksearch',[StockController::class,'SearchList']);
});