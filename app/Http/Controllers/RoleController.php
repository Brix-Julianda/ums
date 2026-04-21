<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {

        $role = Role::all();

        return inertia('Role/Index', [
            'role' => $role,
        ]);
    }

    public function create()
    {
        return inertia('Role/Create');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'role_name' => 'required|string',
        ]);

        Role::create([
            'role_name' => $validate['role_name'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Role created successfully',
            'redirect' => route('role.index'),
        ]);
    }

    public function edit() {}

    public function update() {}

    public function destroy() {}
}
