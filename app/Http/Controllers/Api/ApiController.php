<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function customerStore(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:customers,email|max:255',
                'phone_number' => 'required|string|max:15|unique:customers,phone_number',
            ]);

            $customer = Customer::create($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Customer created successfully',
                'data' => $customer,
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while creating the customer.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function productStore(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'product_code' => 'required|string|max:255|unique:products,product_code',
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:1000',
                'price' => 'required|numeric|min:0',
            ]);

            $product = Product::create($validatedData);

            return response()->json([
                'success' => true,
                'data' => $product,
                'message' => 'Product created successfully!',
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while creating the product.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


}