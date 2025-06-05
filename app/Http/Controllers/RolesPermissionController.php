<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;

class RolesPermissionController extends Controller
{
    public function __construct(){
        $this->middleware('permission:roles-permission index')->only('index');
        $this->middleware('permission:roles-permission create')->only(['create','store']);
        $this->middleware('permission:roles-permission update')->only(['edit','update']);
        $this->middleware('permission:roles-permission destroy')->only('destroy');
    }
    
    public function index(){
        $roles = Role::all();
        return view('roles-permission.index', compact('roles'));
    }

     public function create(){
        $permissions = Permission::all()->groupBy('group_name');
        return view('roles-permission.create',compact('permissions'));
    }

    public function store(Request $request){
        try {
            $request->validate([
                'role' => ['required', 'max:50', 'unique:permissions,name']
            ]);
    
            $role = Role::create(['guard_name'=>'web','name'=>$request->role]);
    
            $role->syncPermissions($request->permissions);

            return redirect()->back()->with('success', 'Role has been created successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to create role' . $th->getMessage());
        }
        

    }

    public function edit(string $id) {         
        $role = Role::findOrFail($id);
        $permissions = Permission::all()->groupBy('group_name');
        $rolesPermissions = $role->permissions;
        $rolesPermissions = $rolesPermissions->pluck('name')->toArray();
        
        return view('roles-permission.edit',compact('role', 'permissions', 'rolesPermissions'));
    }

    public function update(Request $request, string $id) {
        try {
            $request->validate([
                'role' => ['required', 'max:50', 'unique:permissions,name']
            ]);

            $role = Role::findOrFail($id);
            $role->update(['guard_name'=>'web','name'=>$request->role]);

            $role->syncPermissions($request->permissions);

            return redirect()->back()->with('success', 'Role has been updated successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to update role' . $th->getMessage());
        }
    }

    public function destroy(string $id) {
        try{
            $role = Role::findOrFail($id);

            if($role->name ==='admin'){
                return response(['status'=>'error','message'=>__('Can\'t Delete the Admin')]);
            }
            $role->delete();

            return redirect()->back()->with('success', 'Role deleted successfully!');

        } catch(\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete role ' . $e->getMessage());
        }
        
        
    }
}
