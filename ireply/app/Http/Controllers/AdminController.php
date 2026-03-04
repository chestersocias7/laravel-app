<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        // Super admin dashboard or user role management
        return view('admin.index');
    }

    public function manageRoles()
    {
        $users = User::all();
        return view('admin.roles', compact('users'));
    }

    public function updateRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->role = $request->input('role');
        $user->save();
        return redirect()->route('admin.roles')->with('success', 'User role updated successfully.');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        if (auth()->id() === $user->id) {
            return redirect()->route('admin.roles')->with('error', 'You cannot delete your own account.');
        }
        $user->delete();
        return redirect()->route('admin.roles')->with('success', 'User deleted successfully.');
    }
}
