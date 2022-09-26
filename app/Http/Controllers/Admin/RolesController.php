<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function index()
    {
        $roles = Role::with(['permissions'])->get();

        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required:unique:roles',
            'permissions' => 'required'
        ]);
        $role = new Role();
        $role->name = $request->get('name');
        $role->syncPermissions($request->permissions);
        $role->save();
        return redirect()->route('admin.role.all')->with('success', "Role $role->name added successfully");
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('permissions', 'role'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required',
            'permissions' => 'required'
        ]);

        $role->name = $request->get('name');
        $role->syncPermissions($request->get('permissions'));

        $role->save();

        return redirect()->route('admin.role.all')->with('success', "Role $role->name removed successfully");
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('admin.role.all')->with('success', "Role $role->name removed successfully");
    }
}
