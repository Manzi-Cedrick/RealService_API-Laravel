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
        $finalClientList = Product::find($product->id)->Client->toArray();
        return response()->json([
            'status' => true,
            'message' => 'Product successfully Displayed',
            'Products" clients' => $finalClientList,
        ],200);
    }
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
