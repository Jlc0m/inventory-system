<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use \Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Permission $permission)
    {
        $permissions = $permission->orderBy('name')->paginate(20);

        return view('/admin/staff/permission/permissions-index-panel-admin', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/admin/staff/permission/permissions-create-panel-admin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|min:2|max:50'
        ]);

        $permission->create($request->all());

        return redirect()->back()->with('status', 'Permission added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        $permission = $permission->findOrFail($permission->id);

        return view('/admin/staff/permission/permissions-edit-panel-admin', compact('permission'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|min:3|max:50',
        ]);

        $permission = $permission->findOrFail($permission->id);

        $permission->update($request->all());

        return redirect()->back()->with('status', 'Permission updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $permission->findOrFail($permission->id)->delete();

        return redirect()->back()->with('status', 'Successful delete permission!');
    }
}
