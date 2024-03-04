<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TaskController;
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




Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get("tasks", [TaskController::class, "index"]);
    Route::get("tasks", [TaskController::class, "index"]);
    Route::get("tasks/{id}", [TaskController::class, "getTaskById"]);
    Route::get("tasks/show/{user_id}", [TaskController::class, "show"]);
    
    Route::post("tasks", [TaskController::class, "store"]);
    Route::put("tasks/{id}", [TaskController::class, "update"]);
    Route::put("tasks/update-status/{id}/{status}", [TaskController::class, "updateStatus"]);
    Route::delete("tasks/{id}", [TaskController::class, "deleteTask"]);
    Route::post("logout", [AuthController::class, "logout"]);
});

Route::post("register", [AuthController::class, "register"]);

Route::post("login", [AuthController::class, "login"]);
