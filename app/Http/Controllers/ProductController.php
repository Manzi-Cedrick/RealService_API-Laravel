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
            'Products' => Product::all(),
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
            'Products' => $product,
        ],200);
    }
    public function destroy(Product $product){
        $product->delete();
        return response()->json([
            'status' => true,
            'message' => 'Product successfully Deleted',
            'Client' => $product,
        ],200);
    }
    public function ShowSingleProduct(Product $product){
        $singleProduct = Product::find($product);
        return response()->json([
            'status' => true,
            'message' => 'Product successfully Displayed',
            'Client' => $singleProduct,
        ],200);
    } 
}
