<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class ProductController extends Controller
{
    //
    
    /**
     * @OA\Get(
     *     path="/api/products",
     *     tags={"Product"},
     *     summary="Get All products",
     *     description="Get All products. Make sure you have a valid token",
     *     operationId="index",
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
    public function index(){
        return response()->json([
            'status' => true,
            'message'=> 'All Products',
            'Products' => Product::with('Client')->get(),
        ],200);
    }
        /**
     * @OA\POST(
     *     path="/api/create/product",
     *     tags={"Product"},
     *     summary="Create product",
     *     description="Get All products. Make sure you have a valid token",
     *     operationId="store",
     *     security={{"bearer_token":{}}},
     *  @OA\RequestBody(
     *      required=true,
     *      description="Enter valid credentials. Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number and one special character.",
     *      @OA\JsonContent(
     *          required={"ProductName","ProductPrice","StockID","ProductQRCode","Quantity","Description"},
     *          @OA\Property(property="ProductName", type="string", format="name", example="Tomato"),
     *          @OA\Property(property="ProductPrice", type="number", format="number", example="129.02"),
     *          @OA\Property(property="StockID", type="number", format="number", example="1"),
     *          @OA\Property(property="ProductQRCode", type="string", format="string", example="MR23QR"),
     *          @OA\Property(property="Quantity", type="string", format="string", example="23"),
     *          @OA\Property(property="Description", type="string", format="string", example="Dolores quas eum ea laudantium. Necessitatibus aut blanditiis cumque sit sed odio in fuga. Iste aut hic asperiores."),
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
    public function store(ProductRequest $request){
        $productAdd = Product::create($request->all());
        return response()->json([
            'status' => true,
            'message'=> 'All Products',
            'Products' => $productAdd,
        ],200);
    }
            /**
     * @OA\PUT(
     *     path="/api/update/product/{product}",
     *     tags={"Product"},
     *     summary="Update product",
     *     security={{"bearer_token":{}}},
     *     description="Get All products. Make sure you have a valid token",
     *     operationId="update",
     *  @OA\Parameter(
     *         name="product",
     *         description="Select the product to update",
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
     *          required={"ProductName","ProductPrice","StockID","ProductQRCode","Quantity","Description"},
     *          @OA\Property(property="ProductName", type="string", format="name", example="Tomato"),
     *          @OA\Property(property="ProductPrice", type="number", format="number", example="129.02"),
     *          @OA\Property(property="StockID", type="number", format="number", example="1"),
     *          @OA\Property(property="ProductQRCode", type="string", format="string", example="MR23QR"),
     *          @OA\Property(property="Quantity", type="string", format="string", example="23"),
     *          @OA\Property(property="Description", type="string", format="string", example="Dolores quas eum ea laudantium. Necessitatibus aut blanditiis cumque sit sed odio in fuga. Iste aut hic asperiores."),
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
    public function update(Request $request,$id){
        $updateProduct = Product::find($id)->update($request->all());
        return response()->json([
            'status' => true,
            'message'=> 'All Products',
            'Products Updated' => $updateProduct,
        ],200);
    }
                  /**
     * @OA\DELETE(
     *     path="/api/delete/product/{product}",
     *     tags={"Product"},
     *     summary="Detete the product",
     *     security={{"bearer_token":{}}},
     *     description="Delete the product. Make sure you have a valid token",
     *     operationId="destroy",
     *  @OA\Parameter(
     *         name="product",
     *         description="Select the product to delete",
     *          in="path",
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
    public function destroy(Product $product){
        $DeletedProduct = $product->delete();
        return response()->json([
            'status' => true,
            'message' => 'Product successfully Deleted',
            'Product Deleted' => $DeletedProduct,
        ],200);
    }
                /**
     * @OA\GET(
     *     path="/api/product/{product}",
     *     security={{"bearer_token":{}}},
     *     tags={"Product"},
     *     summary="Show details of a product",
     *     description="View the product. Make sure you have a valid token",
     *     operationId="ShowSingleProductClients",
     *  @OA\Parameter(
     *         name="product",
     *         description="Select the product to view",
     *          in="path",
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
    public function ShowSingleProductClients(Product $product){
        $finalClientList = Product::find($product->id)->Client->toArray();
        return response()->json([
            'status' => true,
            'message' => 'Product successfully Displayed',
            'Clients' => $finalClientList,
        ],200);
    }
                    /**
     * @OA\GET(
     *     path="/api/search/product",
     *     security={{"bearer_token":{}}},
     *     tags={"Product"},
     *     summary="Show details of a product",
     *     description="View the product. Make sure you have a valid token",
     *     operationId="SearchList",
     *  @OA\Parameter(
     *         name="search",
     *         description="Select the product to view",
     *          in="query",
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
    public function SearchList(Request $request){
        $product_query= Product::with(['Client']);
        if($request->keyword){
            $product_query->where('ProductName','LIKE','%'.$request->keyword.'%');
        }
        if($request->search){
            $product_query->whereHas('Client',function ($query) use ($request){
                $query->where('FirstName',$request->search);
            });
        }
        $searchList = $product_query->get();
        return response()->json([
            'status' => true,
            'message' => 'Searched Product',
            'SearchInfo' => $searchList
        ],200);
    }
}
