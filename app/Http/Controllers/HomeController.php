<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function index(Request $request)
    {
        $products = Product::where('is_active', 1);



        if ($request->has('from_airport') || $request->has('destination_airport') || $request->has('fly') || $request->has('arrival')) {
            $products->where(function ($query) use ($request) {
                if ($request->has('from_airport')) {
                    $from_airport = strtolower($request->from_airport);
                    $query->whereHas('Detail.FromAirport', function ($fromAirportQuery) use ($from_airport) {
                        $fromAirportQuery->where('name', 'LIKE', '%' . $from_airport . '%');
                    });
                }

                if ($request->has('destination_airport')) {
                    $destination_airport = strtolower($request->destination_airport);
                    $query->whereHas('Detail.DestinationAirport', function ($destinationAirportQuery) use ($destination_airport) {
                        $destinationAirportQuery->where('name', 'LIKE', '%' . $destination_airport . '%');
                    });
                }

                if ($request->fly !== null) {

                    if ($request->has('fly') && Carbon::createFromFormat('Y-m-d', $request->fly) !== false) {
                        $fly_date = Carbon::createFromFormat('Y-m-d', $request->fly)->toDateString();
                        // dd($fly_date);
                        $query->whereHas('Detail', function ($detailQuery) use ($fly_date) {
                            $detailQuery->whereDate('estimated_fly', $fly_date);
                        });
                    }
                }

                if ($request->arrival !== null) {
                    # code...
                    if ($request->has('arrival') && Carbon::createFromFormat('Y-m-d', $request->arrival) !== false) {
                        $arrival_date = Carbon::createFromFormat('Y-m-d', $request->arrival)->toDateString();
                        $query->whereHas('Detail', function ($detailQuery) use ($arrival_date) {
                            $detailQuery->whereDate('estimated_arrival', $arrival_date);
                        });
                    }
                }
            });
        }

        $products = $products->get();

        // dd($products);
        return view('home.index', compact('products'));
    }
}
