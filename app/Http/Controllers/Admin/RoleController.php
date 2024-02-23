<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.roles.index', ['roles' => Role::get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.roles.create', ['permissions' => Permission::get()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        Role::create(['name' => $request->name]);

        return redirect()->back()->with('success', 'Role created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // deprecated
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.pages.roles.edit', ['role' => Role::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, string $id)
    {
        Role::findOrFail($id)->update(['name' => $request->name]);

        return redirect()->back()->with('success', 'Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Role::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Role deleted successfully');
    }

    public function givePermission(string $roleId)
    {
        return view('admin.pages.roles.give-permission', [
            'role' => Role::find($roleId),
            'permissions' => Permission::get()
        ]);
    }

    public function storePermission(Request $request, string $roleId)
    {
        $role = Role::find($roleId);
        $role->syncPermissions($request->permissions);

        return redirect()->back()->with('sucess', 'Permissions assigned successfully');
    }
}
