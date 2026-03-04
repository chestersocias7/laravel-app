<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function index()
    {
        $requests = \App\Models\Request::with(['employee', 'equipment'])->get();
        return view('requests.index', compact('requests'));
    }

    public function create()
    {
        $employees = \App\Models\Employee::all();
        $equipment = \App\Models\Equipment::where('status', 'active')->get();
        return view('requests.create', compact('employees', 'equipment'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'equipment_id' => 'required|exists:equipment,id',
            'reason' => 'nullable|string',
        ]);
        \App\Models\Request::create($validated);
        // Optionally log activity here
        return redirect()->route('requests.index')->with('success', 'Request submitted successfully.');
    }

    public function approve($id)
    {
        $req = \App\Models\Request::findOrFail($id);
        $req->status = 'approved';
        $req->save();
        // Optionally log activity here
        return redirect()->route('requests.index')->with('success', 'Request approved.');
    }

    public function reject($id)
    {
        $req = \App\Models\Request::findOrFail($id);
        $req->status = 'rejected';
        $req->save();
        // Optionally log activity here
        return redirect()->route('requests.index')->with('success', 'Request rejected.');
    }
}
