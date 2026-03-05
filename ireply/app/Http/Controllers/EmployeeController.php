<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = \App\Models\Employee::all();
        return view('employee.index', compact('employees'));
    }

    public function create()
    {
        return view('employee.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'position' => 'nullable|string|max:255',
        ]);
        $emp = \App\Models\Employee::create($validated);
        \App\Models\ActivityLog::create([
            'employee_id' => $emp->id,
            'action' => 'added_employee',
            'details' => 'New employee added: ' . $emp->name,
        ]);
        return redirect()->route('employees.index')->with('success', 'Employee added successfully.');
    }

    public function edit($id)
    {
        $employee = \App\Models\Employee::findOrFail($id);
        return view('employee.edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $employee = \App\Models\Employee::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'position' => 'nullable|string|max:255',
        ]);
        $employee->update($validated);
        \App\Models\ActivityLog::create([
            'employee_id' => $employee->id,
            'action' => 'updated_employee',
            'details' => 'Employee details updated: ' . $employee->name,
        ]);
        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy($id)
    {
        $employee = \App\Models\Employee::findOrFail($id);
        $employee->delete();
        \App\Models\ActivityLog::create([
            'employee_id' => null, // System or Admin action
            'action' => 'deleted_employee',
            'details' => 'Deleted employee ID: ' . $id,
        ]);
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }

    public function showRequests()
    {
        $requests = \App\Models\Request::with(['employee', 'equipment'])->latest()->get();
        return view('employee.requests', compact('requests'));
    }

    public function showApproved()
    {
        $requests = \App\Models\Request::with(['employee', 'equipment'])
            ->where('status', 'approved')
            ->latest()
            ->get();
        return view('employee.approved', compact('requests'));
    }

    public function showActivityLogs()
    {
        $logs = \App\Models\ActivityLog::with('employee')->latest()->get();
        return view('employee.activity_logs', compact('logs'));
    }
}

