<?php

namespace App\Http\Controllers\AdminController;

use App\Actions\User\CreateUser;
use App\Actions\User\GetUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class EmployeeController extends Controller
{
    public function index(Request $request, GetUser $getUser): View
    {
        $search = $request->input('search');
        $params['keyword'] = $search;
        $employees = $getUser->execute($params)->paginate(5);
        $roles = Role::all();

        return view('admin.employees.index', compact('employees', 'roles', 'search'));
    }

    public function create(): View
    {
        return view('admin.employees.create');
    }

    public function store(StoreUserRequest $request, CreateUser $createUser)
    {
        try {
            $createUser->execute($request->validated());

            return redirect()->route('admin.employees.create')->with('success', 'User created successfully.');
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['user_error' => 'Failed to create user: ' . $e->getMessage()]);
        }
    }

    public function assignRole(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'role' => 'required|exists:roles,name'
        ]);

        // Remove old roles, assign new one
        $user->syncRoles([$request->role]);

        return redirect()->route('admin.employees.index')->with('success', 'Role assigned successfully.');
    }
}
