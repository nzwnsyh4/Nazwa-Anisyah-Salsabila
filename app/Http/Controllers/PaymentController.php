<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\Payment;
use App\Models\Ticket;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class PaymentController extends Controller
{
    //
    public function index(Request $request, $uuid)
    {
        $billing = Billing::where('uuid', $uuid)->first();
        if (!$billing) {
            return redirect('/')->with('failed', 'Payment Not Found');
        }

        if ($billing->status_id != 1) {

            return redirect()->route('check', $billing->Payment?->uuid);
        }

        return view('payment.index', compact('billing'));
    }
    public function store(Request $request, $uuid)
    {
        if ($request->ajax()) {
            $billing = Billing::where('uuid', $uuid)->first();
            if (!$billing) {
                return response()->json(['message' => 'Billing not found', 'status' => 404], 404);
            }
            $total_tiket = $billing->Product?->price * $billing->qty;
            $tax = ($total_tiket / 100) * 10;
            $payment = new Payment();
            $payment->billing_id = $billing->id;
            $payment->uuid = Uuid::fromDateTime(now());
            $payment->total = $total_tiket + $tax;
            $payment->status = 0;
            $payment->save();

            $billing->status_id = 2;
            $billing->save();
            return response()->json(['message' => 'Payment successful created', 'status' => 200, 'data' => $payment->uuid]);
        }
    }
    public function checkPayment(Request $request)
    {
        $payment = Payment::where('uuid', $request->uuid)->first();
        if (!$payment) {
            return response()->json(['message' => 'payment not found', 'status' => 404], 404);
        }
        if ($payment->status == 0) {
            return response()->json(['message' => 'Not Payed', 'status' => 204]);
        } else {
            return response()->json(['message' => 'Payed', 'status' => 200]);
        }
    }
    public function check(Request $request, $uuid)
    {
        $payment = Payment::where('uuid', $uuid)->first();
        if (!$payment) {
            return response()->json(['message' => 'payment not found', 'status' => 404], 404);
        }
        if ($payment->status != 0) {

            return redirect()->route('checkStore', $payment->uuid);
        }

        return view('payment.check', compact('payment'));
    }
    public function checkStore(Request $request, $uuid)
    {
        $payment = Payment::where('uuid', $uuid)->first();
        if (!$payment) {
            return response()->json(['message' => 'payment not found', 'status' => 404], 404);
        }
        try {
            DB::beginTransaction();
            $payment->status = 1;
            $payment->save();


            $billing = Billing::findOrFail($payment->billing_id);
            $billing->status_id = 3;
            $billing->save();
            DB::commit();
            return view('payment.checkSuccess');
        } catch (QueryException $e) {
            DB::rollBack();
            dd($e);
        }
    }
}
