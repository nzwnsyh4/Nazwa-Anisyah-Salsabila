<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\BillingType;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class CartController extends Controller
{

    public function index($uuid)
    {
        // if (!Auth::check()) {
        //     return redirect()->route('auth.login');
        // }
        $product = Product::where('uuid', $uuid)->first();
        if (!$product) {
            return redirect()->back()->with('failed', 'Product not found');
        }
        $billingType = BillingType::where('is_active', 1)->get();
        return view('cart.index', compact('product', 'billingType'));
    }
    public function store(Request $request, $uuid)
    {
        $request->validate([
            'jumlah_tiket' => 'required',
            'payment' => 'required',
        ]);
        $product = Product::where('uuid', $uuid)->first();
        if (!$product) {
            return redirect()->back()->with('failed', 'Product not found');
        }
        $billing = new Billing();
        $billing->uuid = Uuid::fromDateTime(now());
        $billing->product_id = $product->id;
        $billing->user_id = Auth::user()->id;
        $billing->status_id = 0;
        $billing->qty = $request->jumlah_tiket;
        $billing->billing_type_id = $request->payment;
        $billing->save();
        return redirect()->route('billings.information', $billing->uuid)->with('success', 'Successfully');
    }
}
