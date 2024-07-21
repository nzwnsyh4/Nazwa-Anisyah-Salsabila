<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    //
    public function index()
    {
        $role = Role::get();
        return view('admin.roles.index', compact('role'));
    }
    public function create()
    {
        $permissions = Permission::orderBy('parent')->get();
        $groupPermission = [];
        foreach ($permissions as $p) {
            if (in_array($p->parent, $groupPermission)) {
                continue;
            }
            $groupPermission[] = $p->parent;
        }

        return view('admin.roles.create', compact('permissions', 'groupPermission'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'guard_name' => 'required',
            'permissions' => 'required',
        ]);
        try {
            DB::beginTransaction();
            $role = new Role();
            $role->name = $request->name;
            $role->guard_name = $request->guard_name;
            $role->syncPermissions(array_map('intval', $request->permissions));
            $role->save();
            DB::commit();
            return redirect()->route('admin.roles.index')->with('success', 'successfully');
        } catch (QueryException $e) {
            DB::rollBack();
            dd($e);
        }
    }
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::orderBy('parent')->get();
        $groupPermission = [];
        foreach ($permissions as $p) {
            if (in_array($p->parent, $groupPermission)) {
                continue;
            }
            $groupPermission[] = $p->parent;
        }
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        return view('admin.roles.edit', compact('permissions', 'groupPermission', 'role', 'rolePermissions'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'permissions' => 'required',
            'name' => 'required',
            'guard_name' => 'required',
        ]);

        try {
            DB::beginTransaction();
            $role = Role::findOrFail($id);
            $role->name = $request->name;
            $role->guard_name = $request->guard_name;
            $role->syncPermissions(array_map('intval', $request->permissions));
            $role->save();
            DB::commit();
            return redirect()->route('admin.roles.index')->with('success', 'Role has been Updated');
        } catch (QueryException $e) {
            DB::rollBack();
            dd($e);
        }
    }
}
