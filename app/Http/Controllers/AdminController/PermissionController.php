<?php

namespace App\Http\Controllers\AdminController;

use App\Actions\Permission\CreatePermission as PermissionCreatePermission;
use App\Actions\Permission\DeletePermission;
use App\Actions\Permission\UpdatePermission;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePermissionRequest;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('admin.permissions.index', compact('permissions'));
    }
    public function store(StorePermissionRequest $request, PermissionCreatePermission $createPermission)
    {
        $createPermission->execute($request->validated());

        return redirect()->route('permissions.index')->with('success', 'Permission created successfully!');
    }

    public function update(StorePermissionRequest $request, Permission $permission, UpdatePermission $updatePermission)
    {
        $updatePermission->execute($permission, $request->validated());

        return redirect()->route('permissions.index')->with('success', 'Permission updated.');
    }

    public function destroy(Permission $permission, DeletePermission $deletePermission)
    {
        $deletePermission->execute($permission);
        
        return redirect()->route('permissions.index')
            ->with('success', 'Permission deleted successfully.');
    }
}
