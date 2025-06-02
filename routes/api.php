<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("/userRegister", [AuthController::class, "userRegister"]);
 Route::post("/userLogin", [AuthController::class, "userLogin"]);

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'auth'
], function () {
    Route::get("/userProfile", [AuthController::class, "userProfile"]);
    Route::get("/refreshToken", [AuthController::class, "refreshToken"]);
    Route::get("/userLogout", [AuthController::class, "userLogout"]);

    Route::post("/task", [TaskController::class, "store"]);
    Route::get("/task", [TaskController::class, "index"]);
    Route::get("/task/{id}", [TaskController::class, "show"]);
    Route::post("/task/{id}", [TaskController::class, "update"]);
    Route::delete("/task/{id}", [TaskController::class, "destroy"]);
});