<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Airport;
use App\Models\Product;
use App\Models\ProductDetail;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Ramsey\Uuid\Uuid;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['permission:product']);
        $this->middleware(['permission:product.create'])->only(['create', 'store']);
        $this->middleware(['permission:product.edit'])->only(['edit', 'update']);
        $this->middleware(['permission:product.delete'])->only(['delete']);
    }
    public function index()
{
    //
    $products = Product::get();
    return view('admin.product.index', compact('products'));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'description' => 'required',
        'price' => 'required',
        'is_active' => 'required',
        'from_airport' => 'required',
        'destination_airport' => 'required',
        'estimated_fly' => ['required', 'date', Rule::notIn(now()->format('Y-m-d'))],
        'estimated_fly_hour' => 'required',
        'estimated_arrival' => ['required', 'date', Rule::notIn(now()->format('Y-m-d'))],
        'estimated_arrival_hour' => 'required',
        'qty' => 'required',
    ]);

    try {
        DB::beginTransaction();
        $product = new Product();
        $product->name = $request->name;
        $product->uuid = Uuid::fromDateTime(now());
        $product->maskapai_id = Auth::user()->Maskapai?->id;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->is_active = $request->is_active;
        $product->save();

        $detail = new ProductDetail();
        $detail->product_id = $product->id;
        $detail->from_airport = $request->from_airport;
        $detail->qty = $request->qty;

        $detail->destination_airport = $request->destination_airport;
        $detail->estimated_fly = $request->estimated_fly . ' ' . $request->estimated_fly_hour . ':00';
        $detail->estimated_arrival = $request->estimated_arrival . ' ' . $request->estimated_arrival_hour . ':00';
        $detail->save();
        DB::commit();
        return redirect()->route('admin.products.index')->with('success', 'Product has been successfully created.');
    } catch (QueryException $e) {
        DB::rollBack();
        dd($e);
    }
}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $product = Product::where('uuid', $id)->first();
        if (!$product) {
            return redirect()->back()->with('failed', 'Product not found');
        }
        return view('admin.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        //
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'is_active' => 'required',
            'from_airport' => 'required',
            'destination_airport' => 'required',
            'estimated_fly' => 'required|date_format:Y-m-d H:i',
            'estimated_fly_hour' => 'required|date_format:H:i',
            'estimated_arrival' => 'required|date_format:Y-m-d H:i',
            'estimated_arrival_hour' => 'required|date_format:H:i',
            'qty' => 'required',
        ]);
        try {
            DB::beginTransaction();
            $product = Product::where('uuid', $id)->first();
            $product->name = $request->name;
            $product->uuid = Uuid::fromDateTime(now());
            $product->maskapai_id = Auth::user()->Maskapai?->id;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->is_active = $request->is_active;
            $product->save();

            $detail = ProductDetail::where('product_id', $product->id)->first();
            $detail->product_id = $product->id;
            if ($request->from_airport != null) {

                $detail->from_airport = $request->from_airport;
            }
            $detail->qty = $request->qty;
            if ($request->destination_airport != null) {

                $detail->destination_airport = $request->destination_airport;
            }

            $detail->estimated_fly = $request->estimated_fly . ' ' . $request->estimated_fly_hour . ':00';
            $detail->estimated_arrival = $request->estimated_arrival . ' ' . $request->estimated_arrival_hour . ':00';
            $detail->save();
            DB::commit();
            return redirect()->route('admin.products.index')->with('success', 'Product has been successfully created.');
        } catch (QueryException $e) {
            DB::rollBack();
            dd($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $product = Product::where('uuid', $id)->first();
        if (!$product) {
            return response()->json(['message' => 'product has no found', 'status' => 404], 404);
        }

        $product->delete();
        return response()->json(['message' => 'List Penerbangan has been deleted', 'status' => 200], 200);
    }
}
