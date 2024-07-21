<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\BillingDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $billings = Billing::where('user_id', Auth::user()->id)->whereIn('status_id', [0, 1, 2, 3])->get();
        return view('pesanan.index', compact('billings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $billing = Billing::where('uuid', $id)->first();
        if (!$billing) {
            return redirect()->back()->with('failed', 'BIlling not found');
        }
        return view('pesanan.edit', compact('billing'));
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
        $billing = Billing::where('uuid', $id)->first();
        if (!$billing) {
            return redirect()->back()->with('failed', 'BIlling not found');
        }

        foreach ($request->data as $key => $val) {
            $detail = BillingDetail::where('uuid', $key)->first();
            if (!$detail) {
                return redirect()->back()->with('failed', 'BIlling not found');
            }
            $detail->name = $val['name'];
            $detail->email = $val['email'];
            $detail->save();
        }

        return redirect()->route('pesanan.index')->with('success', 'Successfully Edit');
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
        $billing = Billing::where('uuid', $id)->first();
        if (!$billing) {
            return response()->json(['status' => 404, 'message' => 'BIlling not found']);
        }

        $billing->delete();
        return response()->json(['status' => 200, 'message' => 'successfully']);
    }
}
