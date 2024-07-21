<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Billing;
use App\Models\Ticket;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        return $this->middleware(['permission:confirmation']);
        return $this->middleware(['permission:confirmation.approve'])->only(['update']);
    }
    public function index()
    {
        //
        $billing = Billing::where('status_id', 3)->get();
        return view('admin.pesanan.index', compact('billing'));
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
            return response()->json(['message' => 'BIlling not found!', 'status' => 404], 404);
        }
        $billing->status_id = 4;
        $billing->save();
        $ticket = new Ticket();
        $ticket->user_id = $billing->user_id;
        $ticket->billing_id = $billing->id;
        $ticket->save();
        return response()->json(['message' => 'succesfully', 'status' => 200]);
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
    }
}
