<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class FlightController extends Controller
{
    public function index(Request $request)
    {
        $flights = QueryBuilder::for(Flight::class)
            ->allowedFilters([
                AllowedFilter::exact('number'),
                AllowedFilter::partial('arrival_city'),
            ])
            ->allowedSorts(['id', 'number', 'arrival_city'])
            ->paginate($request->get('per_page', 10))
            ->appends($request->query());

        return response([
            'success' => true,
            'data' => $flights
        ], 200);
    }

    public function show(Flight $flight)
    {
        $flight->load('passengers');

        return response([
            'success' => true,
            'data' => $flight
        ], 200);
    }

    public function passengers(Flight $flight, Request $request)
    {
        $users = $flight->passengers()->paginate($request->get('per_page', 10));

        return response([
            'success' => true,
            'data' => $users
        ], 200);
    }
}
