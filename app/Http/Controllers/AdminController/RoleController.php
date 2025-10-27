<?php

namespace App\Http\Controllers\AdminController;

use App\Actions\Permission\GetPermission;
use App\Actions\Role\CreateRole;
use App\Actions\Role\GetRole;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;

class RoleController extends Controller
{
    public function index(GetRole $getRole, GetPermission $getPermission)
    {
        $roles = $getRole->execute()->with('permissions')->get();
        $allPermissions = $getPermission->execute()->get();

        return view('admin/roles.index', compact('roles', 'allPermissions'));
    }

    public function store(StoreRoleRequest $request, CreateRole $createRole)
    {
        $createRole->execute($request->validated());

        return redirect()->route('roles.index')->with('success', 'Role created successfully!');
    }

    function assignPermission(Request $request, $roleId)
    {
        $request->validate([
            'permission' => 'required|exists:permissions,name',
        ]);

        $role = Role::findById($roleId);
        if ($role->hasPermissionTo($request->permission)) {
            return back()->with('success', 'Role already has this permission.');
        }

        $role->givePermissionTo($request->permission);

        return back()->with('success', 'Permission assigned successfully.');
    }
}
