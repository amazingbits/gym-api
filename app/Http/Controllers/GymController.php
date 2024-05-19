<?php

namespace App\Http\Controllers;

use App\Models\Gym;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class GymController extends Controller
{
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            request()->validate([
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
                "error" => "latitude is invalid",
            ])->setStatusCode(400);
        }

        if (!validateLongitude($longitude)) {
            return response()->json([
                "error" => "longitude is invalid",
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

    public function update(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            request()->validate([
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
                "error" => "latitude is invalid",
            ])->setStatusCode(400);
        }

        if (!validateLongitude($longitude)) {
            return response()->json([
                "error" => "longitude is invalid",
            ])->setStatusCode(400);
        }

        $params = request()->only(["name", "city", "latitude", "longitude"]);

        try {
            $gym = Gym::find((int)request()->gymId);
            if (empty($gym)) {
                return response()->json([
                    "error" => "gym not found"
                ])->setStatusCode(404);
            }
            $gym->name = request()->name;
            $gym->city = request()->city;
            $gym->latitude = (float)request()->latitude;
            $gym->longitude = (float)request()->longitude;
            $gym->updated_at = Carbon::now();
            $gym->save();

        } catch (\Exception $e) {
            return response()->json([
                "error" => $e->getMessage(),
            ])->setStatusCode(500);
        }

        return response()->json([
            "message" => "gym was updated successfully"
        ]);
    }
}
