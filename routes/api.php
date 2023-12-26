<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(["prefix" => "v1"], function () {
    Route::get("/", function (Request $request) {
        return response()->ok(["message" => "Welcome to the API"]);
    });

    Route::group(["prefix" => "auth"], function () {
        Route::post("register", [AuthController::class, "register"]);
        Route::post("login",  [AuthController::class, "login"]);

        Route::group(["middleware" => "auth:sanctum"], function () {
            Route::get("logout", "App\Http\Controllers\AuthController@logout");
        });
    });
});
