<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;

class UserRoleController extends Controller
{
    public function __construct(){
        $this->middleware('permission:user-role index')->only('index');
        $this->middleware('permission:user-role create')->only(['create', 'store']);
        $this->middleware('permission:user-role update')->only(['edit', 'update']);
        $this->middleware('permission:user-role delete')->only('delete');
    }
    
    public function index() {
        $users = User::with(['roles', 'permissions'])->get();
        $roles = Role::all();
        $permissions = Permission::all();
                 
        return view('users.index', compact('users', 'roles', 'permissions'));
    }

    public function create(){
        $users = User::with(['roles', 'permissions'])->get();
        $roles = Role::all();
        
        return view('users.create', compact('users', 'roles'));
    }

    public function store(Request $request){
        $validation = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:65|unique:users,email,' . $request->user()->id,
            //'password' => ['required', 'confirmed', Password::defaults()],
            'password' => ['required', 'confirmed', 'string', Password::min(6)->mixedCase()->numbers()->symbols()],
        ]);

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            if ($request->role) {
                $user->assignRole($request->role);
            }

            //send mail to the user

           // Mail::to($request->email)->send(new RoleUserCreateMail($request->mail,$request->password));
            
           return redirect()->back()->with('success', 'User created successfully!');
        } catch(\Exception $e){
            return redirect()->back()->with('error', 'Failed to create user: ' . $e->getMessage());
        } 
    }
    
    public function edit(string $id) {

        $user = User::with(['roles', 'permissions'])->find($id);
        $roles = Role::all();

        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, string $id){
        try {        
            if($request->has('password') && !empty($request->password)){
                $request->validate([
                    'password' => ['confirmed', 'string', Password::min(6)->mixedCase()->numbers()->symbols()],
                ]);
            }

            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;

            if($request->has('password') && !empty($request->password)){
                $user->password = Hash::make($request->password);
            }

            $user->save();

            $user->syncRoles($request->role);

            return redirect()->back()->with('success', 'User updated successfully!');
        } catch(\Exception $e){
            return redirect()->back()->with('error', 'Failed to update user: ' . $e->getMessage());
        } 

    }


    public function delete(string $id) {
        try{
            $user = User::with(['roles', 'permissions'])->findOrFail($id);
            $user->delete();

            return redirect()->back()->with('success', 'User deleted successfully!');

        } catch(\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete user ' . $e->getMessage());
        }
    }
         
}
