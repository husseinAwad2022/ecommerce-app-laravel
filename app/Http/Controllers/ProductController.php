<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    function allproducts(){
        $products = Product::all();
        return response()->json($products);   
    }

    function findproduct($id){
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json($product);
    }

    function addproduct(Request $request){
        
        $product = Product::create([
            'Name'          => $request->input('Name'),
            'Description'   => $request->input('Description'),
            'StockQuantity' => $request->input('StockQuantity'),
            'Price'         => $request->input('Price'),
        ]);

        return response()->json([
            'message' => 'Product added successfully',
            'product' => $product]);
    }

    function deleteproduct($id){
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Product not found'
            ], 404);
        }

        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully'
        ]);
    }

    function updateproduct(Request $request, $id){
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Product not found'
            ], 404);
        }

        $product->update($request->only(['Name', 'Description', 'StockQuantity', 'Price']));

        return response()->json([
            'message' => 'Product updated successfully',
            'product' => $product
        ]);
    }

}
