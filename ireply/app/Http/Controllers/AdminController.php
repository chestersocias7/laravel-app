<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Super admin dashboard or user role management
        return view('admin.index');
    }

    public function manageRoles()
    {
        // User role management logic
        return view('admin.roles');
    }
}
