<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Faker\Provider\ar_EG\Person;
use \Spatie\Permission\Models\Role;
use \Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Role $role, Permission $permission)
    {
        $roles = $role->orderBy('created_at', 'DESC')->get();
        $permissions = $permission->orderBy('name')->get();

        return view('/admin/staff/role/roles-index-panel-admin', compact(['roles', 'permissions']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Permission $permission)
    {
        $permissions = $permission->orderBy('name')->get();

        return view('/admin/staff/role/roles-create-panel-admin', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Role $role, Permission $permission)
    {
        $request->validate([
            'name' => 'required|min:3|max:30',
            'permission_ids.*' => 'required|integer|exists:permissions,id',
        ]);

        $newRole = $role->create([
            'name' => $request->name
        ]);
        
        $permissions = $permission->whereIn('id', $request->permission_ids)->get();
        $newRole->syncPermissions($permissions);

        return redirect()->back()->with('status', 'Role added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role, Permission $permission)
    {
        $role = $role->where('name', '!=', 'Super Admin')->findOrFail($role->id);

        $permissions = $permission->orderBy('name')->get();

        return view('/admin/staff/role/roles-edit-panel-admin', compact('permissions', 'role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role, Permission $permission)
    {
        
        $request->validate([
            'name' => 'required|min:3|max:30',
            'permissions' => 'required|exists:permissions,id|array',
        ]);

        $role = $role->where('name', '!=', 'Super Admin')->findOrFail($role->id);
        $role->update([
            'name' => $request->name
        ]);
        
        $permissions = $permission->whereIn('id', $request->permissions)->get();
        $role->syncPermissions($permissions);

        return redirect()->back()->with('status', 'Role updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->findOrFail($role->id)->delete();

        return redirect()->back()->with('status', 'Successful delete role!');
    }
}
