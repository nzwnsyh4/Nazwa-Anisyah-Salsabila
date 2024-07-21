<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


     public function index()
    {
        //
        $user = User::get();
        return view('admin.user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::get();
        return view('admin.user.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //public function store(Request $request)
    //{
        //
    //}

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
        $user = User::findOrFail($id);
        $role = Role::get();
        return view('admin.user.edit', compact('user', 'role'));
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
        $user = User::findOrFail($id);
        $user->assignRole((int)$request->role_id);
        $user->update($request->except('role_id'));
        $user->save();
        return redirect()->route('admin.user.edit', $user->id)->with('success', 'Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        return view('auth.register');
    }
     public function store(Request $request)
     {
         //
         $request->validate([
             'name' => 'required',
             'email' => 'required',
             'password' => 'required',

         ]);
         $user = new User();
         $user->name = $request->name;
         $user->email = $request->email;
         $user->password = Hash::make($request->password);


        $user->save();
        return redirect()->route('admin.user.index')->with('success', 'user has been created');
        }
    public function destroy($id)
    {
        $user = User::where('id', $id)->first();
        if (!$user) {
            return response()->json(['message' => 'User has no found', 'status' => 404], 404);
        }
        $user->delete();
        return response()->json(['message' => 'User has been deleted', 'status' => 200], 200);
    }

}
