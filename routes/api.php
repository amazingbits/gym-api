<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix("v1")->group(function () {
    Route::group([
        "middleware" => "api",
        "prefix" => "auth",
    ], function () {
        Route::post('login', '\\App\\Http\\Controllers\\AuthController@login');
        Route::post('logout', '\\App\\Http\\Controllers\\AuthController@logout');
        Route::post('refresh', '\\App\\Http\\Controllers\\AuthController@refresh');
        Route::post('me', '\\App\\Http\\Controllers\\AuthController@me');
    });

    Route::prefix("gym")->group(function () {
        Route::get("/all/{latitude}/{longitude}", "\\App\\Http\\Controllers\\GymController@all")->name("gym.all");
        Route::post("/store", "\\App\\Http\\Controllers\\GymController@store")->name("gym.store");
        Route::put("/update/{gymId}", "\\App\\Http\\Controllers\\GymController@update")->name("gym.update");
        Route::delete("/delete/{gymId}", "\\App\\Http\\Controllers\\GymController@delete")->name("gym.delete")->middleware("auth:api");
    });

    Route::prefix("customer")->group(function () {
        Route::get("/all", "\\App\\Http\\Controllers\\CustomerController@all")->name("customer.all");
        Route::post("/store", "\\App\\Http\\Controllers\\CustomerController@store")->name("customer.store");
    });
});

Route::match(["get", "put", "delete", "post"], "/unauthorized", function () {
    response()->json([
        "error" => "unauthorized",
    ])->setStatusCode(401)->send();
})->name("unauthorized");

Route::fallback(function () {
    return response()->json([
        "error" => "route not found"
    ])->setStatusCode(404);
});
