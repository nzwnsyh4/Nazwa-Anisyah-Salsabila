<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction; // Assuming you have a Transaction model
use Illuminate\Http\Request;


class TransactionController extends Controller
{
    public function index()
{
    $transactions = Transaction::with('order')->orderBy('created_at', 'desc')->get();

    return view('transactions.index', compact('transactions'));
}
}
