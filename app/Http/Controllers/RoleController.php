<?php

namespace App\Http\Controllers;

use App\Models\UserRoles;

class RoleController extends Controller
{
    public function index()
    {

        $role = UserRoles::all();

        return inertia('Role/Index', [
            'role' => $role,
        ]);
    }

    public function create()
    {
        return inertia('Role/Create');
    }

    public function store() {}

    public function edit() {}

    public function update() {}

    public function destroy() {}
}
