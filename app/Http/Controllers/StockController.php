<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockRequest;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
        /**
     * @OA\Get(
     *     path="/api/stocks",
     *     tags={"Stock"},
     *     summary="Get all stocks",
     *     description="Get all stocks. Make sure you have a valid token",
     *     operationId="indexStock",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid status value"
     *     ),
     *     security={{"bearer_token":{}}}
     * )
     */
    public function indexStock()
    {
        //
        return response()->json([
            'status' => true,
            'message'=> 'All Stocks',
            'Stock Info' => Stock::with('Products_Stock')->get(),
        ],200);
    }
           /**
     * @OA\POST(
     *     path="/api/create/stock",
     *     tags={"Stock"},
     *     summary="Create stock",
     *     description="Create stock. Make sure you have a valid token",
     *     operationId="storeStock",
     *     security={{"bearer_token":{}}},
     *  @OA\RequestBody(
     *      required=true,
     *      description="Enter valid credentials. Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number and one special character.",
     *      @OA\JsonContent(
     *          required={"Stock_Name","Stock_Quantity","Registration_Date","Expiration_Date"},
     *          @OA\Property(property="Stock_Name", type="string", format="name", example="Manzi"),
     *          @OA\Property(property="Stock_Quantity", type="number", format="number", example=25),
     *          @OA\Property(property="Registration_Date", type="date", format="date", example="1974-04-16"),
     *          @OA\Property(property="Expiration_Date", type="date", format="date", example="1974-04-16"),
     *    ),
     * ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid status value"
     *     )
     * )
     */
    public function storeStock(StockRequest $request)
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
     * @OA\GET(
     *     path="/api/stock/{stock}",
     *     tags={"Stock"},
     *     summary="View stock",
     *     description="View stock Details. Make sure you have a valid token",
     *     operationId="ShowSingleStock",
     *     security={{"bearer_token":{}}},
     *   @OA\Parameter(
     *         name="client",
     *         description="Select the client to update",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ) 
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid status value"
     *     )
     * )
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
     * @OA\PUT(
     *     path="/api/update/stock/{stock}",
     *     tags={"Stock"},
     *     summary="Update stock",
     *     description="Update stock. Make sure you have a valid token",
     *     operationId="updateStock",
     *     security={{"bearer_token":{}}},
     *   @OA\Parameter(
     *         name="stock",
     *         description="Select the stock to update",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ) 
     *     ),
     *  @OA\RequestBody(
     *      required=true,
     *      description="Enter valid credentials. Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number and one special character.",
     *      @OA\JsonContent(
     *          required={"Stock_Name","Stock_Quantity","Registration_Date","Expiration_Date"},
     *          @OA\Property(property="Stock_Name", type="string", format="name", example="Manzi"),
     *          @OA\Property(property="Stock_Quantity", type="number", format="number", example=25),
     *          @OA\Property(property="Registration_Date", type="date", format="date", example="1974-04-16"),
     *          @OA\Property(property="Expiration_Date", type="date", format="date", example="1974-04-16"),
     *    ),
     * ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid status value"
     *     )
     * )
     */
    public function updateStock(Request $request,$id)
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
     * @OA\DELETE(
     *     path="/api/delete/stock/{stock}",
     *     tags={"Stock"},
     *     summary="Delete stock",
     *     description="Delete stock. Make sure you have a valid token",
     *     operationId="destroyStock",
     *     security={{"bearer_token":{}}},
     *   @OA\Parameter(
     *         name="stock",
     *         description="Select the stock to update",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ) 
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid status value"
     *     )
     * )
     */
    public function destroyStock(Stock $stock)
    {
        //
        $deleteStock = Stock::find($stock->id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'The Stock is successfully deleted',
            'Stock Info' => $deleteStock
        ],200);
    }
          /**
     * @OA\GET(
     *     path="/api/search/stock",
     *     tags={"Stock"},
     *     summary="Search stock",
     *     description="Search Stock names. Make sure you have a valid token",
     *     operationId="SearchListStock",
     *     security={{"bearer_token":{}}},
     *   @OA\Parameter(
     *         name="stock",
     *         description="Select the stock to search",
     *         in="query",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         ) 
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid status value"
     *     )
     * )
     */
    public function SearchListStock(Request $request){
        $stock_query= Stock::with(['Products_Stock']);
        if($request->keyword){
            $stock_query->where('Stock_Name','LIKE','%'.$request->keyword.'%');
        }
        $searchList = $stock_query->get();
        return response()->json([
            'status' => true,
            'message' => 'Searched Stocks',
            'SearchInfo' => $searchList
        ],200);
    }
}
