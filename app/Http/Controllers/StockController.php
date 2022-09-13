<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockRequest;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->json([
            'status' => true,
            'message'=> 'All Stocks',
            'Stock Info' => Stock::with('Products_Stock')->get(),
        ],200);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StockRequest $request)
    {
        //
        $StockStore = Stock::create($request->all());
        return response()->json([
            'status' => true,
            'message'=> 'Stock Successfully registered',
            'Stock Info' => $StockStore,
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ShowSingleStock($id)
    {
        //
        $SingleStockInfo = Stock::find($id)->Products_Stock;
        return response()->json([
            'status' => true,
            'message' => 'Single Stock Info',
            'Stock Info'=> $SingleStockInfo
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //
        $updateStock = Stock::find($id)->update($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Stock Successfully Updated',
            'Stock Info'=> $updateStock,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        //
        $deleteStock = Stock::find($stock->id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'The Stock is successfully deleted',
            'Stock Info' => $deleteStock
        ],200);
    }
}
