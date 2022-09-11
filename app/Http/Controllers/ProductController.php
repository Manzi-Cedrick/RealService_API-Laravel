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
    public function update(ProductRequest $request,Product $product){
        $product->update($request->all());
        return response()->json([
            'status' => true,
            'message'=> 'All Products',
            'Products Updated' => $product,
        ],200);
    }
    public function destroy(Product $product){
        $product->delete();
        return response()->json([
            'status' => true,
            'message' => 'Product successfully Deleted',
            'Product Deleted' => $product,
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
