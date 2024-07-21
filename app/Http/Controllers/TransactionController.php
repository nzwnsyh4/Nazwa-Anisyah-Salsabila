<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction; // Assuming you have a Transaction model

class TransactionController extends Controller
{
    public function create()
    {
        return view('transactions.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'product' => 'required|string|max:255',
            'qty' => 'required|integer|min:1',
            'billing_type' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        // Create a new transaction
        $transaction = new Transaction();
        $transaction->name = $request->name;
        $transaction->email = $request->email;
        $transaction->product_id = $request->product; // Assuming product is a relationship with the Product model
        $transaction->qty = $request->qty;
        $transaction->billing_type_id = $request->billing_type; // Assuming billing_type is a relationship with the BillingType model
        $transaction->status_id = $request->status; // Assuming status is a relationship with the Status model
        $transaction->save();

        // Redirect back to the transactions list page with a success message
        return redirect()->route('admin.pesanan.index')->with('success', 'Transaction created successfully.');
    }
}
