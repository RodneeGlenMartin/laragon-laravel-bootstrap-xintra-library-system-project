<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->get();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|string|max:50|unique:users',
            'lastname' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'course' => 'required|string|max:100',
            'year_level' => 'required|integer|min:1|max:5',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'student_id' => $request->student_id,
            'lastname' => $request->lastname,
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'email' => $request->email,
            'course' => $request->course,
            'year_level' => $request->year_level,
            'password' => Hash::make($request->password),
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'student_id' => 'required|string|max:50|unique:users,student_id,' . $user->id,
            'lastname' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'course' => 'required|string|max:100',
            'year_level' => 'required|integer|min:1|max:5',
        ]);

        $user->update([
            'student_id' => $request->student_id,
            'lastname' => $request->lastname,
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'email' => $request->email,
            'course' => $request->course,
            'year_level' => $request->year_level,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Update user password.
     */
    public function updatePassword(Request $request, User $user)
    {
        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'Password updated successfully.');
    }

    /**
     * Toggle user status.
     */
    public function toggleStatus(User $user)
    {
        // Prevent toggling own status
        if ($user->id === auth()->id()) {
            return redirect()->route('users.index')->with('error', 'You cannot change your own status.');
        }

        $user->update([
            'is_active' => !$user->is_active,
        ]);

        $status = $user->is_active ? 'activated' : 'deactivated';
        return redirect()->route('users.index')->with('success', "User {$status} successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Prevent self-deletion
        if ($user->id === auth()->id()) {
            return redirect()->route('users.index')->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
