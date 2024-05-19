<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

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
}
