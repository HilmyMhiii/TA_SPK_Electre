<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = \App\Models\User::all();
        return view('admin.setting-user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.setting-user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'role' => 'required',
        ]);

        $user = new \App\Models\User;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = Hash::make('password');
        $user->email_verified_at = now();
        $user->save();
        return redirect()->route('setting-users.index')->with('success', 'User berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = \App\Models\User::find($id);
        return view('admin.setting-user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = \App\Models\User::find($id);
        return view('admin.setting-user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            // 'password' => 'required',
            'role' => 'required',
        ]);

        $user = \App\Models\User::find($id);

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->role = $request->role;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return redirect()->route('setting-users.index')->with('success', 'User berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = \App\Models\User::find($id);
        $user->delete();
        return redirect()->route('setting-users.index')->with('success', 'User berhasil dihapus');
    }
}
