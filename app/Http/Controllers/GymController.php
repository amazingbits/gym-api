<?php

namespace App\Http\Controllers;

use App\Models\Gym;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class GymController extends Controller
{
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $this->validate($request, [
                "name" => "required|string|min:3",
                "city" => "required|string|min:3",
                "latitude" => "required|numeric|between:-90,90",
                "longitude" => "required|numeric|between:-180,180",
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                "error" => $e->getMessage(),
            ])->setStatusCode(400);
        }

        $latitude = (float)request()->latitude;
        $longitude = (float)request()->longitude;

        if (!validateLatitude($latitude)) {
            return response()->json([
                "error" => "latitude is invalid"
            ])->setStatusCode(400);
        }

        if (!validateLongitude($longitude)) {
            return response()->json([
                "error" => "longitude is invalid"
            ])->setStatusCode(400);
        }

        $params = request()->only(["name", "city", "latitude", "longitude"]);

        try {
            Gym::create($params);
        } catch (\Exception $e) {
            return response()->json([
                "error" => $e->getMessage(),
            ])->setStatusCode(500);
        }

        return response()->json([
            "message" => "gym was created successfully"
        ]);
    }
}
