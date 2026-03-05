<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        // User Table

        $users = User::query();

        return inertia('Auth/Index', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        // User Register

        return inertia('Auth/Register');
    }

    public function store()
    {
        // User Creation
    }

    public function show()
    {
        // User View
    }

    public function edit()
    {
        // User Edit
    }
}
