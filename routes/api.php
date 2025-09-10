<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PassengerController;
use App\Http\Controllers\Api\FlightController;
use App\Http\Controllers\AuthController;
use App\Models\User;


// Flights
Route::get('/flights', [FlightController::class, 'index']);              // (with filters/sort/pagination)
Route::get('/flights/{flight}', [FlightController::class, 'show']);      // show one flight
Route::get('/flights/{flight}/passengers', [FlightController::class, 'passengers']); // passengers of a flight

Route::middleware('auth:sanctum')->group(function () {
    // Passengers CRUD
    Route::apiResource('passengers', PassengerController::class);

    // Extra passenger action (soft delete)
    Route::post('/passengers/{passenger}/soft-delete', [PassengerController::class, 'softDelete']);
});

// Auth 
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::post('/flights', [FlightController::class, 'store']);
    Route::put('/flights/{flight}', [FlightController::class, 'update']);
    Route::delete('/flights/{flight}', [FlightController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->get('/users/{id}/roles', function ($id) {
    $user = User::findOrFail($id);
    return response()->json([
        'user' => $user->name,
        'roles' => $user->getRoleNames(), // comes from Spatie HasRoles
    ]);
});
