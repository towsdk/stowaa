<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    public function indexRole(){
        $roles = Role::with('permissions')->whereNotIn('name', ['super-admin'])->orderBy('id', 'desc')->get();
        return view('role.index', compact('roles'));
    }
    //
    public function createRole(){
        $permissions = Permission::orderBy('id', 'desc')->get();
        return view('role.create', compact('permissions'));
    }

    public function permissionStore(Request $request){
        $request->validate([
            'name'=> 'required',
        ]);

        Permission::create([
            'name' => $request->name,
        ]);
        return back()->with('success', "permission created successfully");
    }

    public function roleStore(Request $request){
        $request->validate([
            'name'=> 'required',
            'permission'=> 'required',
        ]);

        $roleId =Role::create([
            'name' => $request->name,
        ]);

        $roleId->givePermissionTo($request->permission);
        return back()->with('success', "permission created successfully");
    }

    public function editRole($id){
        $role = Role::with('permissions')->findOrFail($id);
        $permissions= Permission::orderBy('id', 'desc')->get();
        return view('role.edit', compact('permissions', 'role'));
    }
    public function roleUpdate(Request $request,$id){
        $role= Role::findOrFail($id);
        $request->validate([
            'name'=> 'required',
            'permission'=> 'required',
        ]);

        $role->update([
            'name' => $request->name,
        ]);

        $role->syncPermissions($request->permission);
        return back()->with('success', "permission created successfully");
 
    }

    public function roldeDelete(Role $role){
            $role->delete();
            return back()->with('success', 'role deleted');
    }
}
