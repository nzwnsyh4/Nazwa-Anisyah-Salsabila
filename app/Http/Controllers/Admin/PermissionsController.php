<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    //
    public function index()
    {
        $permissions = Permission::get();
        return view('admin.permissions.index', compact('permissions'));
    }
    public function create()
    {

        return view('admin.permissions.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'guard_name' => 'required',
            'title' => 'required',
            'parent' => 'required',
        ]);
        try {
            DB::beginTransaction();
            $permissions = new Permission();
            $permissions->name = $request->name;
            $permissions->guard_name = $request->guard_name;
            $permissions->title = $request->title;
            $permissions->parent = $request->parent;
            $permissions->save();
            DB::commit();
            return redirect()->route('admin.permissions.index')->with('success', 'successfully');
        } catch (QueryException $e) {
            DB::rollBack();
            dd($e);
        }
    }
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);

        return view('admin.permissions.edit', compact('permission'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'guard_name' => 'required',
            'title' => 'required',
            'parent' => 'required',

        ]);

        try {
            DB::beginTransaction();
            $permission = Permission::findOrFail($id);
            $permission->name = $request->name;
            $permission->guard_name = $request->guard_name;
            $permission->title = $request->title;
            $permission->parent = $request->parent;
            $permission->save();
            DB::commit();
            return redirect()->route('admin.permissions.index')->with('success', 'Permission has been Updated');
        } catch (QueryException $e) {
            DB::rollBack();
            dd($e);
        }
    }
}
