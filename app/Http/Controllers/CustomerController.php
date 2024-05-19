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

    public function update(): \Illuminate\Http\JsonResponse
    {
        try {
            request()->validate([
                "password" => "required|min:8",
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "error" => $e->getMessage()
            ])->setStatusCode(400);
        }

        try {
            $customer = Customer::find((int)request()->customerId);
        } catch (\Exception $e) {
            $customer = null;
        }

        if (empty($customer)) {
            return response()->json([
                "error" => "customer not found"
            ])->setStatusCode(404);
        }

        $customer->password = Hash::make(request()->password);
        try {
            $customer->save();
        } catch (\Exception $e) {
            return response()->json([
                "error" => $e->getMessage(),
            ])->setStatusCode(500);
        }

        return response()->json([
            "message" => "customer was updated successfully"
        ]);
    }

    public function delete(): \Illuminate\Http\JsonResponse
    {
        $customer = Customer::find((int)request()->customerId);
        if (empty($customer)) {
            return response()->json([
                "error" => "customer not found"
            ])->setStatusCode(404);
        }

        try {
            $customer->delete();
        } catch (\Exception $e) {
            return response()->json([
                "error" => $e->getMessage()
            ])->setStatusCode(500);
        }

        return response()->json([
            "message" => "customer was successfully deleted"
        ]);
    }
}
