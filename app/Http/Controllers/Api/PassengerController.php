<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Passenger;
use Illuminate\Http\Request;

class PassengerController extends Controller
{
    public function index()
    {
        return Passenger::all();
    }

    public function softDelete(Passenger $passenger)
    {
        $passenger->delete();
        return response()->json(['message' => 'Passenger soft deleted']);
    }
}
