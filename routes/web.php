<?php

use App\Http\Controllers\AdminController\EmployeeController as AdminControllerEmployeeController;
use App\Http\Controllers\AdminController\LeaveController as AdminControllerLeaveController;
use App\Http\Controllers\AdminController\PermissionController as AdminControllerPermissionController;
use App\Http\Controllers\AdminController\ProjectController as AdminControllerProjectController;
use App\Http\Controllers\AdminController\RoleController as AdminControllerRoleController;
use App\Http\Controllers\AdminController\WfhController as AdminControllerWfhController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController\LeaveController;
use App\Http\Controllers\ClientController\EmployeeController;
use App\Http\Controllers\ClientController\WfhController;
use App\Http\Controllers\NotificationController;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/test', function () {
    return User::all();
});

// Auth routes
Route::view('/login', 'auth.login')->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('user.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/admin', function () {
    return view('admin/dashboard');
})->middleware(['auth'])->name('admin.dashboard');

Route::middleware(['auth', 'role:admin'])->prefix('/admin')->group(function () {
    Route::get('/employees', [AdminControllerEmployeeController::class, 'index'])->name('admin.employees.index');
    Route::post('/users/{user}/assign-role', [AdminControllerEmployeeController::class, 'assignRole'])->name('admin.employees.assignRole');
    Route::get('/users/create', [AdminControllerEmployeeController::class, 'create'])->name('admin.employees.create');
    Route::post('/users', [AdminControllerEmployeeController::class, 'store'])->name('admin.employees.store');

    Route::get('/roles', [AdminControllerRoleController::class, 'index'])->name('roles.index');
    Route::post('/roles', [AdminControllerRoleController::class, 'store'])->name('roles.store');
    Route::post('/roles/{role}/assign-permission', [AdminControllerRoleController::class, 'assignPermission'])->name('roles.assignPermission');

    Route::get('/permissions', [AdminControllerPermissionController::class, 'index'])->name('permissions.index');
    Route::post('/permissions', [AdminControllerPermissionController::class, 'store'])->name('permissions.store');
    Route::put('/permissions/{permission}', [AdminControllerPermissionController::class, 'update'])->name('admin.permissions.update');
    Route::delete('/permissions/{permission}', [AdminControllerPermissionController::class, 'destroy'])->name('admin.permissions.destroy');

    Route::get('/leave-types', [AdminControllerLeaveController::class, 'index'])->name('admin.leave-types.index');
    Route::post('/leave-types', [AdminControllerLeaveController::class, 'store'])->name('admin.leave-types.store');
    Route::put('/leave-types/{leaveType}', [AdminControllerLeaveController::class, 'update'])->name('admin.leave-types.update');
    Route::delete('/leave-types/{leaveType}', [AdminControllerLeaveController::class, 'destroy'])->name('admin.leave-types.destroy');

    Route::get('/leaves/requested-leaves', [LeaveController::class, 'leaveRequest'])->name('admin.leaves.request');

    Route::get('/wfh', [AdminControllerWfhController::class, 'index'])->name('admin.wfh.index');
    Route::get('/wfh/create', [AdminControllerWfhController::class, 'create'])->name('admin.wfh.create');
    Route::post('/wfh', [AdminControllerWfhController::class, 'store'])->name('admin.wfh.store');

    Route::get('/announcement', [AnnouncementController::class, 'create'])->name('admin.announcement.create');
    Route::post('/announcement', [AnnouncementController::class, 'store'])->name('admin.announcement.store');

});

// Route for other users
Route::get('/', function () {
    $user = auth()->user();
    return view('client.dashboard', compact('user'));
})->middleware(['auth'])->name('user.dashboard');

// user & manager
Route::middleware(['auth', 'role:user|manager'])->group(function () {
    // leave
    Route::get('/leave-employees', [LeaveController::class, 'employeeOnLeave'])->name('user.leave-employees');
    Route::get('/leaves/create', [LeaveController::class, 'create'])->name('user.leaves.create');
    Route::post('/leaves/apply', [LeaveController::class, 'applyLeave'])->name('user.leaves.apply');
    Route::get('/employees', [EmployeeController::class, 'index'])->name('user.employees.index');
    Route::get('leaves/leave-report', [LeaveController::class, 'leaveReport'])->name('user.leaves.leave-report');
    Route::delete('leaves/{leaveRequest}', [LeaveController::class, 'destroy'])->name('user.leaves.destroy');

    // whf
    Route::get('/wfh', [WfhController::class, 'index'])->name('user.wfh.index');

    // profile
    Route::get('/profile', [EmployeeController::class, 'show'])->name('user.profile');
    Route::post('/profile/personal', [EmployeeController::class, 'updatePersonalDetail'])->name('user.profile.updatePersonal');
    Route::post('/profile/address', [EmployeeController::class, 'updateAddressDetail'])->name('user.profile.updateAddress');
});

// manager
Route::middleware(['auth', 'role:manager'])->group(function () {
    Route::get('/leaves/requested-leaves', [LeaveController::class, 'leaveRequest'])->name('user.leaves.request');
    Route::get('/wfh/create', [WfhController::class, 'create'])->name('user.wfh.create');
    Route::post('/wfh', [WfhController::class, 'create'])->name('user.wfh.store');
});

// manager & admin
Route::middleware(['auth', 'role:manager|admin'])->group(function () {
    Route::post('/leaves/approve/{leaveRequest}', [LeaveController::class, 'approveLeave'])->name('leaves.approve');
    Route::post('/leaves/reject/{leaveRequest}', [LeaveController::class, 'rejectLeave'])->name('leaves.reject');
    // TODO leave controller here is of client, since this approve reject and force cancel can be done by only adin role
    Route::post('/leaves/force-cancel/{leaveRequest}', [LeaveController::class, 'forceCancelLeave'])->name('leaves.force-cancel');

    /* project */
    Route::get('/projects', [AdminControllerProjectController::class, 'index'])->name('admin.projects.index');
    Route::post('/projects', [AdminControllerProjectController::class, 'store'])->name('admin.projects.store');
    Route::put('/projects/{project}', [AdminControllerProjectController::class, 'update'])->name('admin.projects.update');

});

Route::get('/chat', function () {
    return view('index');
});

// Announcement 
Route::post('/broadcast', [AnnouncementController::class, 'broadcast']);
Route::post('/receive', [AnnouncementController::class, 'receive']);

// Notification through private channel
Broadcast::routes(['middleware' => ['auth']]);
