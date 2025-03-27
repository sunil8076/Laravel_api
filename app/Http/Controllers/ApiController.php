<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;




class ApiController extends Controller
{
    public function insert(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'product_code' => 'required',
            'product_price' => 'required|numeric',
            'product_image' => 'required|image',
            'product_description' => 'required',
            'product_category' => 'required',
            'product_brand' => 'required',
            'product_quantity' => 'required|integer',
        ]);

        $imageName = null;
        if ($request->hasFile('product_image')) {
            $imageName = time() . '.' . $request->product_image->extension();
            $request->product_image->move(public_path('product_image'), $imageName);
        }

        $product = new Product();
        $product->product_name = $request->product_name;
        $product->product_code = $request->product_code;
        $product->product_price = $request->product_price;
        $product->product_image = $imageName; // Fixed incorrect variable reference
        $product->product_description = $request->product_description;
        $product->product_category = $request->product_category;
        $product->product_brand = $request->product_brand;
        $product->product_quantity = $request->product_quantity;
        $product->save();

        return response()->json(['message' => 'Product inserted successfully'], 201);
    }

    public function fetch()
    {
        $products = Product::all();
        return response()->json(['products' => $products], 200);
    }

    public function fetchById($id)
    {
        $product = Product::find($id);
        if ($product) {
            return response()->json($product, 200);
        } else {
            return response()->json(['message' => 'Product not found'], 404);
        }
    }

    public function delete($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            return response()->json(['message' => 'Product deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Product not found'], 404);
        }
    }
}