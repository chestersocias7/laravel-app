<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if (!$user->is_approved) {
                Auth::logout();
                return back()->with('error', 'Your account is pending admin approval.');
            }
            $request->session()->regenerate();
            return redirect()->intended('/')->with('success', 'Welcome back!');
        }

        return back()->with('error', 'The provided credentials do not match our records.');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:admin,employee',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'is_approved' => false, // New registrations are pending
        ]);

        \App\Models\ActivityLog::create([
            'employee_id' => null, // New users don't have an employee record yet
            'action' => 'user_registered',
            'details' => 'New user registered: ' . $user->name . ' (' . $user->role . '). Pending approval.',
        ]);

        return redirect()->route('login')->with('success', 'Registration submitted! Please wait for an admin to approve your account.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'Logged out successfully.');
    }
}
