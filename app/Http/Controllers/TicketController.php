<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    //
    public function index()
    {
        $billing = Billing::where('user_id', Auth::user()->id)->where('status_id', 4)->latest()->get();
        return view('ticket.index', compact('billing'));
    }
    public function detail($uuid)
    {
        dd($uuid);
    }
    public function print($uuid)
    {
        $billing = Billing::where('uuid', $uuid)->first();

        return view('ticket.print', compact('billing'));
    }
}
