<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function list() {
        $product = Product::where('active', 1)->get();
        return response()->json($product);
    }

    public function detail($id) {
        $product = Product::find($id);
        return response()->json($product);
    }

    public function create(Request $request) {
        $input = $request->only('name', 'description', 'price');
        
        try
        {
            $product = new Product();

            $product->name          = $input['name'];
            $product->description   = $input['description'];
            $product->price         = $input['price'];


            if ( $product->save() ) {
                $code = 201;
                $output = [
                    'product' => $product,
                    'code' => $code,
                    'message' => 'Bill created successfully.'
                ];
            } else {
                $code = 500;
                $output = [
                    'code' => $code,
                    'message' => 'An error ocurred while creating bill.'
                ];
            }

        } catch (Exception $e) {
            $code = 500;
            $output = [
                'code' => $code,
                'message' => 'An error ocurred while creating bill.'
            ];
        }

        return response()->json($output, $code);

    }

    public function update(Request $request, $id) {
        $input = $request->only('name', 'description', 'price');
        
        try
        {
            $product = Product::find($id);
        
            $product->name          = $input['name'];
            $product->description   = $input['description'];
            $product->price         = $input['price'];


            if ( $product->save() ) {
                $code = 200;
                $output = [
                    'product' => $product,
                    'code' => $code,
                    'message' => 'Bill updated successfully.'
                ];
            } else {
                $code = 500;
                $output = [
                    'code' => $code,
                    'message' => 'An error ocurred updating bill.'
                ];
            }

        } catch (Exception $e) {
            $code = 500;
            $output = [
                'code' => $code,
                'message' => 'An error ocurred updating bill.'
            ];
        }
        return response()->json($output, $code);
    }

    public function delete($id) {
        try
        {
            $product = Product::findOrFail($id);
            
            $product->active = 0;
            
            if ( $product->save() ) {
                $code = 200;
                $output = [
                    'code' => $code,
                    'message' => 'Bill deleted.'
                ];
            } else {
                $code = 500;
                $output = [
                    'code' => $code,
                    'message' => 'An error ocurred deleting bill.'
                ];
            }

        } catch (Exception $e) {
            $code = 500;
            $output = [
                'code' => $code,
                'message' => 'An error ocurred deleting bill.'
            ];
        }
        return response()->json($output, $code);
    }


    //
}
