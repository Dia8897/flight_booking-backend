<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Flight;

class FlightController extends Controller
{
    public function index()
    {
        return Flight::all();
    }

    public function show(Flight $flight)
    {
        $flight->load('passengers');
        return $flight;
    }
}
