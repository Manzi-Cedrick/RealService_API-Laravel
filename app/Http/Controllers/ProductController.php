<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index(){
        return response()->json([
            'status' => true,
            'message'=> 'All Products',
            'Products' => Product::with('Client')->get(),
        ],200);
    }
    public function store(ProductRequest $request){
        $productAdd = Product::create($request->all());
        return response()->json([
            'status' => true,
            'message'=> 'All Products',
            'Products' => $productAdd,
        ],200);
    }
    public function update(Request $request,$id){
        $updateProduct = Product::find($id)->update($request->all());
        return response()->json([
            'status' => true,
            'message'=> 'All Products',
            'Products Updated' => $updateProduct,
        ],200);
    }
    public function destroy(Product $product){
        $DeletedProduct = $product->delete();
        return response()->json([
            'status' => true,
            'message' => 'Product successfully Deleted',
            'Product Deleted' => $DeletedProduct,
        ],200);
    }
    public function ShowSingleProductClients(Product $product){
        $finalClientList = Product::find($product->id)->Client;
        return response()->json([
            'status' => true,
            'message' => 'Product successfully Displayed',
            'Products" clients' => $finalClientList,
        ],200);
    }
}
