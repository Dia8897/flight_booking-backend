<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Passenger;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Cache;


class PassengerController extends Controller
{
    public function index(Request $request)
    {
        $passengers = Cache::remember('passengers.all', 60, function () use ($request) {
            return QueryBuilder::for(Passenger::class)
                ->allowedFilters([
                    AllowedFilter::partial('first_name'),
                    AllowedFilter::partial('last_name'),
                    AllowedFilter::exact('email'),
                    AllowedFilter::exact('flight_id'),
                ])
                ->allowedSorts(['id', 'first_name', 'last_name', 'email'])
                ->paginate($request->get('per_page', 10))
                ->appends($request->query());
        });

        return response([
            'success' => true,
            'data' => $passengers
        ]);
    }




    public function store(Request $request)
    {


        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'email'      => ['required', 'email', 'unique:passengers,email'],
            'password'   => ['required', 'string'],
        ]);

        $validated['password'] = bcrypt($validated['password']);

        $passenger = Passenger::create($validated);
        Cache::forget('passengers.all');

        return response()->json([
            'success' => true,
            'message' => 'Passenger created successfully',
            'data'    => $passenger
        ], 201);
    }

    public function update(Request $request, Passenger $passenger)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'email'      => ['required', 'email', Rule::unique('passengers')->ignore($passenger->id)],
            'password'   => ['nullable', 'string'],
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        }



        $passenger->update($validated);
        Cache::forget('passengers.all');

        return response()->json([
            'success' => true,
            'message' => 'Passenger updated successfully',
            'data'    => $passenger
        ], 200);
    }

    // public function softDelete(Passenger $passenger)
    // {
    //     $passenger->delete();

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Passenger soft deleted',
    //         'data'    => $passenger
    //     ], 200);
    // }

    public function destroy(Passenger $passenger)
    {
        $passenger->delete();
        Cache::forget('passengers.all');

        return response()->json([
            'success' => true,
            'message' => 'Passenger deleted successfully',
            'data'    => $passenger
        ], 200);
    }
}
