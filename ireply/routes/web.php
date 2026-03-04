<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\EmployeeController;

// Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Request management
Route::prefix('requests')->group(function () {
	Route::get('/', [RequestController::class, 'index'])->name('requests.index');
	Route::get('/create', [RequestController::class, 'create'])->name('requests.create');
	Route::post('/create', [RequestController::class, 'store'])->name('requests.store');
	Route::post('/{id}/approve', [RequestController::class, 'approve'])->name('requests.approve');
	Route::post('/{id}/reject', [RequestController::class, 'reject'])->name('requests.reject');
});

// Activity logs
Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activity_logs.index');

// Admin (protected by role:admin)
Route::prefix('admin')->middleware('role:admin')->group(function () {
	Route::get('/', [AdminController::class, 'index'])->name('admin.index');
	Route::get('/roles', [AdminController::class, 'manageRoles'])->name('admin.roles');
	Route::patch('/roles/{id}', [AdminController::class, 'updateRole'])->name('admin.roles.update');
	Route::delete('/roles/{id}', [AdminController::class, 'deleteUser'])->name('admin.roles.delete');
});

// Equipment management (protected by role:admin)
Route::prefix('equipment')->middleware('role:admin')->group(function () {
	Route::get('/', [EquipmentController::class, 'index'])->name('equipment.index');
	Route::get('/archived', [EquipmentController::class, 'archived'])->name('equipment.archived');
	Route::get('/add', [EquipmentController::class, 'create'])->name('equipment.create');
	Route::post('/add', [EquipmentController::class, 'store'])->name('equipment.store');
	Route::get('/edit/{id}', [EquipmentController::class, 'edit'])->name('equipment.edit');
	Route::patch('/edit/{id}', [EquipmentController::class, 'update'])->name('equipment.update');
	Route::delete('/delete/{id}', [EquipmentController::class, 'destroy'])->name('equipment.destroy');
	Route::post('/archive/{id}', [EquipmentController::class, 'archive'])->name('equipment.archive');
});

// Employee management
Route::prefix('employees')->group(function () {
	Route::get('/', [EmployeeController::class, 'index'])->name('employees.index');
	Route::get('/create', [EmployeeController::class, 'create'])->name('employees.create');
	Route::post('/create', [EmployeeController::class, 'store'])->name('employees.store');
	Route::get('/edit/{id}', [EmployeeController::class, 'edit'])->name('employees.edit');
	Route::patch('/edit/{id}', [EmployeeController::class, 'update'])->name('employees.update');
	Route::delete('/delete/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
	Route::get('/requests', [EmployeeController::class, 'showRequests'])->name('employees.requests');
	Route::get('/approved', [EmployeeController::class, 'showApproved'])->name('employees.approved');
	Route::get('/activity-logs', [EmployeeController::class, 'showActivityLogs'])->name('employees.activity_logs');
});

