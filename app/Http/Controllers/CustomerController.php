<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function all(): \Illuminate\Http\JsonResponse
    {
        try {
            $customers = Customer::all();
        } catch (\Exception $e) {
            $customers = [];
        }
        return response()->json($customers);
    }

    public function store(): \Illuminate\Http\JsonResponse
    {
        try {
            request()->validate([
                "email" => "required|email",
                "password" => "required|min:8"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "error" => $e->getMessage()
            ])->setStatusCode(400);
        }

        if (!empty(Customer::where("email", request()->email)->first())) {
            return response()->json([
                "error" => "this email is already in use"
            ])->setStatusCode(400);
        }

        $customer = [
            "email" => request()->email,
            "password" => Hash::make(request()->password),
        ];

        try {
            Customer::create($customer);
        } catch (\Exception $e) {
            return response()->json([
                "error" => $e->getMessage()
            ])->setStatusCode(500);
        }

        return response()->json([
            "message" => "customer was created successfully"
        ]);
    }
}
