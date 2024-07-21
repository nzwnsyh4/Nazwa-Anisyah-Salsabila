<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\BillingDetail;
use App\Models\Product;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class BillingController extends Controller
{
    //
    public function index($uuid)
    {
        $product = Product::where('uuid', $uuid)->first();
        if (!$product) {
            return redirect('/')->with('failed', 'Something went wrong on chosen product');
        }
        $billing = new Billing();
        $billing->uuid = Uuid::fromDateTime(now());
        $billing->product_id = $product->id;
        $billing->user_id = Auth::user()->id;
        $billing->status_id = 0;
        $billing->save();
        return redirect()->route('billings.information', $billing->uuid);
    }
    public function information($uuid)
    {
        $billing = Billing::where('uuid', $uuid)->first();
        if (!$billing) {
            return redirect('/')->with('failed', 'Something went wrong');
        }
        return view('billings.index', compact('billing'));
    }
    public function storeInformation(Request $request, $uuid)
    {
        $billing = Billing::where('uuid', $uuid)->first();
        if (!$billing) {
            return redirect('/')->with('failed', 'Something went wrong');
        }
        $data = [];
        foreach ($request->details['nama_penumpang'] as $key => $value) {
            $data[$key]['nama'] = $value;
        }
        foreach ($request->details['email'] as $key => $value) {
            $data[$key]['email'] = $value;
        }
        try {
            DB::beginTransaction();
            foreach ($data as $key => $value) {
                $detail = new BillingDetail();
                $detail->billing_id = $billing->id;
                $detail->uuid = Uuid::fromDateTime(now());
                $detail->name = $value['nama'];
                $detail->email = $value['email'];
                $detail->save();
            }
            $billing->status_id = 1;
            $billing->save();
            DB::commit();
            return redirect()->route('payment.index', $billing->uuid)->with('success', 'Successfully');
        } catch (QueryException $e) {
            DB::rollBack();
            dd($e);
        }
    }
    public function paymentInformation(Request $request, $uuid)
    {
        $billing  = Billing::where('uuid', $uuid)->first();
        if (!$billing) {
            return redirect('/')->with('failed', 'Something went wrong');
        }

        return view('billings.paymentInformation', compact('billing'));
    }
}
