<?php

namespace App\Http\Controllers\ClientController;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $employees = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'admin');
        })
         ->when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        })
        ->paginate(3);

        return view('client.employees.index', compact('employees', 'search'));
    }

    public function show() {
        $user = auth()->user();

        return view('client.employees.profile', compact('user'));
    }

    public function updatePersonalDetail(Request $request) {
        $validated = $request->validate([
            'employment_type' => 'required|string',    
            'email' => 'required|email',
            'job_title' => 'required',
            'joined_date' => 'required',
        ]);
        $user = auth()->user();
        $user->update($validated);

        return  redirect()->back()->with('success', 'Personal details updated.');
    }
    public function updateAddressDetail(Request $request) {
        $validated = $request->validate([
            'province' => 'required|string',    
            'district' => 'required|string',
            'address' => 'required|string',
        ]);
        $user = auth()->user();
        $user->update($validated);

        return  redirect()->back()->with('success', 'Personal details updated.');
    }
    
}
