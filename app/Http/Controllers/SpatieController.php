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
       
        $role = $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'required|array',

        ]);

        try
        {
            $role = Role::create($role);
            $role->syncPermissions($role->permissions);
            return redirect()->route('admin.viewroles')->with('success', 'Role created successfully.');
        } catch (\Exception $err)
        {
            return back()->with('error', 'We could not create the role, please try again.')->withInput();
        }
    }
}
