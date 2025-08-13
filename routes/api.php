<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PassengerController;
use App\Http\Controllers\Api\FlightController;


// Flights
Route::get('/flights', [FlightController::class, 'index']);              // (with filters/sort/pagination)
Route::get('/flights/{flight}', [FlightController::class, 'show']);      // show one flight
Route::get('/flights/{flight}/passengers', [FlightController::class, 'passengers']); // passengers of a flight

// Passengers CRUD (creates: index, store, show, update, destroy)
Route::apiResource('passengers', PassengerController::class);
// Route::post('/passengers', [PassengerController::class, 'store']);

// Extra passenger action (soft delete)
Route::post('/passengers/{passenger}/soft-delete', [PassengerController::class, 'softDelete']);

// Auth (leave as-is)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
