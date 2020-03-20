<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Exception;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
        try {
            $products = Product::all();

            return response()->json([
                'status' => 'success',
                'response' => $products
            ]);
        } catch(Exception $ex) {
            return response()->json([
                'status' => 'error',
                'response' => $ex->getMessage()
            ]);
        }
    }

    public function create(Request $request)
    {
        try {
            $product = new Product;

            $product->name= $request->name;
            $product->price = $request->price;
            $product->description= $request->description;

            $product->save();

            return response()->json([
                'status' => 'success',
                'response' => $product
            ]);
        } catch(Exception $ex) {
            return response()->json([
                'status' => 'error',
                'response' => $ex->getMessage()
            ]);
        }
    }

    public function show($id)
    {
        try {
            $product = Product::findOrFail($id);

            return response()->json([
                'status' => 'success',
                'response' => $product
            ]);
        } catch(Exception $ex) {
            return response()->json([
                'status' => 'error',
                'response' => $ex->getMessage()
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $product= Product::findOrFail($id);

            $product->name = $request->input('name');
            $product->price = $request->input('price');
            $product->description = $request->input('description');
            $product->save();

            return response()->json([
                'status' => 'success',
                'response' => $product
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'status' => 'error',
                'response' => $ex->getMessage()
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id)->delete();

            return response()->json([
                'status' => 'success',
                'response' => $product
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'status' => 'error',
                'response' => $ex->getMessage()
            ]);
        }
    }
}
