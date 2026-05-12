<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SpatieController extends Controller
{
    //function to retrieve all permissions
    public function viewpermissions()
    {
        $permissions = Permission::all();
        return view('admin.authorization.viewpermissions', compact('permissions'));
    }


    //function to retrieve all roles
    public function viewroles()
    {
        $roles = Role::all();
        return view('admin.authorization.viewroles', compact('roles'));
    }
    //function to create new permission
    public function storepermission(Request $request)
    {
        $permission = $request->validate([
            'name' => 'required|unique:permissions,name',
        ]);
        try {
            Permission::create($permission);
            return redirect()->route('admin.viewpermissions')->with('success', 'Permission created successfully.');
        } catch (\Exception $err) {
            return back()->with('error', 'We could not create the permission, please try again.')->withInput();
        }
    }
    //function to show create role form
    public function createrole()
    {
        $permissions = Permission::all();
        return view('admin.authorization.createrole', compact('permissions'));
    }
    //function to create new role
    public function storerole(Request $request)
    {
       
        $validated = $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'required|array',

        ]);

        try
        {
            $role = Role::create(['name' => $validated['name']]);
            $role->syncPermissions($validated['permissions']);
            return redirect()->route('admin.viewroles')->with('success', 'Role created successfully.');
        } catch (\Exception $err)
        {
            return back()->with('error', 'We could not create the role, please try again.')->withInput();
        }
    }
    public function viewrole($id)
    {   
        $role = Role::findOrFail($id);
        $permissions = $role->getPermissionNames();
        return view('admin.authorization.viewrole', compact('role', 'permissions'));
    }
    public function editrole($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('id')->toArray();
        return view('admin.authorization.editrole', compact('role', 'permissions', 'rolePermissions'));
    }
    public function updaterole(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|unique:roles,name,' . $id,
            'permissions' => 'required|array',
        ],[
            'name.required' => 'The role name is required.',
            'name.unique' => 'The role name must be unique.',
            'permissions.required' => 'Please select at least one permission.',
            'permissions.array' => 'Invalid permissions format.',
        ]);

        try{
            $role->update(['name' => $validated['name']]);
            $role->syncPermissions($validated['permissions']);
            return redirect()->route('admin.viewroles')->with('success', 'Role updated successfully.');
        } catch (\Exception $err)
        {
            return back()->with('error', 'We could not update the role, please try again.')->withInput();
        }

    }
    public function destroyrole($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->route('admin.viewroles')->with('success', 'Role deleted successfully.');
    }

}
