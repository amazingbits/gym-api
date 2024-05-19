<?php

namespace App\Http\Controllers;

use App\Models\CheckIn;
use App\Models\Customer;
use App\Models\Gym;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CheckInController extends Controller
{
    public function store()
    {
        try {
            request()->validate([
                "customer_id" => "required|integer|min:1",
                "gym_id" => "required|integer|min:1",
                "latitude" => "required|numeric|between:-90,90",
                "longitude" => "required|numeric|between:-180,180",
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "error" => $e->getMessage()
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

        $customerId = (int)request()->customer_id;
        $gymId = (int)request()->gym_id;

        if (empty(Customer::find($customerId))) {
            return response()->json([
                "error" => "customer not found"
            ])->setStatusCode(404);
        }

        if (empty($gym = Gym::find($gymId))) {
            return response()->json([
                "error" => "gym not found"
            ])->setStatusCode(404);
        }

        $customerCheckIns = CheckIn::where("customer_id", $customerId)->get();
        foreach ($customerCheckIns as $customerCheckIn) {
            $date = Carbon::parse($customerCheckIn->created_at)->format("Y-m-d");
            if ($date === date("Y-m-d")) {
                return response()->json([
                    "error" => "you can make just one check-in per day"
                ])->setStatusCode(400);
            }
        }

        if (calculateInMettersDistanceBetweenLatitudeAndLongitude(
                $latitude,
                $longitude,
                (float)$gym->latitude,
                (float)$gym->longitude,
            ) > getenv("MAX_DISTANCE_IN_METERS_GYM_LIST")) {
            return response()->json([
                "error" => "you must be at least at " . getenv("MAX_DISTANCE_IN_METERS_GYM_LIST") . " meters from gym"
            ])->setStatusCode(400);
        }

        $checkIn = [
            "customer_id" => $customerId,
            "gym_id" => $gymId,
        ];

        try {
            CheckIn::create($checkIn);
        } catch (\Exception $e) {
            return response()->json([
                "error" => $e->getMessage()
            ])->setStatusCode(500);
        }

        return response()->json([
            "message" => "check-in was successfully made"
        ]);
    }
}
