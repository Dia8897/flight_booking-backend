<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function index(Request $request)
    {
        $query = Flight::query();

        if ($request->has('number')) {
            $query->where('number', $request->number);
        }
        if ($request->has('arrival_city')) {
            $query->where('arrival_city', 'like', '%' . $request->arrival_city . '%');
        }

        $sortBy = $request->get('sort_by', 'id');
        $order = $request->get('order', 'asc');
        $query->orderBy($sortBy, $order);

        $perPage = $request->get('per_page', 10);
        $flights = $query->paginate($perPage);

        return response()->json(['success' => true, 'data' => $flights], 200);
    }

    public function show(Flight $flight)
    {
        $flight->load('passengers');
        return response()->json(['success' => true, 'data' => $flight], 200);
    }

    public function passengers(Flight $flight, Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $users = $flight->passengers()->paginate($perPage);

        return response()->json(['success' => true, 'data' => $users], 200);
    }
}
