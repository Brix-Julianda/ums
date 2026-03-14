<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->paginate(15);

        return inertia('Auth/Index', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        // User Register
        return inertia('Auth/Register');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        User::create([
            'name' => $validate['name'],
            'email' => $validate['email'],
            'password' => Hash::make($validate['password']),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'redirect' => route('user.index'),
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $credentials['email'])->first();
        if (! $user) {
            return response()->json([
                'errors' => ['email' => 'No account found with this email.'],
            ], 422);
        }

        if (! Hash::check($credentials['password'], $user->password)) {
            return response()->json([
                'errors' => ['password' => 'The password is incorrect.'],
            ], 422);
        }

        Auth::login($user);

        $request->session()->regenerate();

        return response()->json([
            'success' => true,
            'redirect' => route('user.index'),
        ]);
    }

    public function show($id)
    {

        $user = User::with('roles')->findOrFail($id);

        return inertia('User/Show', [
            'user' => $user,
        ]);
    }

    public function edit()
    {
        // User Edit
    }

    /**
     * Delete a user
     */
    public function destroy(User $user)
    {
        // Prevent deleting self
        if (Auth::id() === $user->id) {
            return redirect()->back()->with('error', 'You cannot delete your own account.');
        }
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User successfully deleted',
            'redirect' => route('user.index'),
        ]);
    }
}
