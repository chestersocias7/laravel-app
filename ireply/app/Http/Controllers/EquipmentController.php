<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EquipmentController extends Controller
{
        public function archived()
        {
            $equipment = \App\Models\Equipment::where('status', 'archived')->get();
            return view('equipment.archived', compact('equipment'));
        }
    public function index()
    {
        $equipment = \App\Models\Equipment::where('status', '!=', 'archived')->get();
        return view('equipment.index', compact('equipment'));
    }

    public function create()
    {
        return view('equipment.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        \App\Models\Equipment::create($validated);
        return redirect()->route('equipment.index')->with('success', 'Equipment added successfully.');
    }

    public function edit($id)
    {
        $equipment = \App\Models\Equipment::findOrFail($id);
        return view('equipment.edit', compact('equipment'));
    }

    public function update(Request $request, $id)
    {
        $equipment = \App\Models\Equipment::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $equipment->update($validated);
        return redirect()->route('equipment.index')->with('success', 'Equipment updated successfully.');
    }

    public function archive($id)
    {
        $equipment = \App\Models\Equipment::findOrFail($id);
        $equipment->status = 'archived';
        $equipment->save();
        return redirect()->route('equipment.index')->with('success', 'Equipment archived successfully.');
    }

    public function destroy($id)
    {
        $equipment = \App\Models\Equipment::findOrFail($id);
        $equipment->delete();
        return redirect()->route('equipment.index')->with('success', 'Equipment deleted successfully.');
    }
}

