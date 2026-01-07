<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdministratorController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = User::when($search, function ($query, $search) {
            return $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        })->paginate(10)->withQueryString();

        return view('admin.users', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        // To be implemented
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        // To be implemented
    }

    /**
     * Display the specified user.
     */
    public function show(User $user)
    {
        // To be implemented
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        // To be implemented
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        // To be implemented
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return redirect()->back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User berhasil dihapus.');
    }
}
