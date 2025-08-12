<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Passenger;
use Illuminate\Http\Request;

class PassengerController extends Controller
{
    public function index(Request $request)
    {
        $query = Passenger::query();

        if ($request->has('first_name')) {
            $query->where('first_name', 'like', '%' . $request->first_name . '%');
        }
        if ($request->has('last_name')) {
            $query->where('last_name', 'like', '%' . $request->last_name . '%');
        }
        if ($request->has('email')) {
            $query->where('email', $request->email);
        }

        $sortBy = $request->get('sort_by', 'id');
        $order = $request->get('order', 'asc');
        $query->orderBy($sortBy, $order);

        $perPage = $request->get('per_page', 10);
        $passengers = $query->paginate($perPage);

        return response()->json(['success' => true, 'data' => $passengers], 200);
    }


    public function softDelete(Passenger $passenger)
    {
        $passenger->delete();
        return response()->json([
            'success' => true,
            'message' => 'Passenger soft deleted',
            'data' => $passenger
        ], 200);
    }
}
