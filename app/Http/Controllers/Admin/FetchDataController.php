<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Airport;
use Illuminate\Http\Request;

class FetchDataController extends Controller
{
    //
    public function fetchDataAirport(Request $request)
    {
        $search = strtolower($request->q);
        $airport = Airport::where(function ($q) use ($search) {
            $q->where('code', 'LIKE', '%' . $search . '%')
                ->orWhere('name', 'LIKE', '%' . $search . '%')
                ->orWhere('city', 'LIKE', '%' . $search . '%')
                ->orWhere('country', 'LIKE', '%' . $search . '%')
                ->orWhere('tz', 'LIKE', '%' . $search . '%');
        })->get();
        if (!$airport) {
            return response(['status' => 404, 'message' => 'Not Found!'], 404);
        }
        return response()->json(['status' => 200, 'data' => $airport]);
    }
}
