<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //
    public function index()
    {
        return view('profile.index');
    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|numeric',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->phone = $request->phone;
        if ($request->password != null) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return redirect()->back()->with('success', 'Profile has been updated successfully');
    }
}
