<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function update(Request $request, string $id)
    {
        $rules = [
            'name' => 'required|min:3|max:100',
            'email' => 'required|email|unique:users,email,' . $id,
        ];
        $messages = [
            'name.required' => 'Nama harus diisi',
            'name.min' => 'Nama minimal 3 karakter',
            'name.max' => 'Nama maksimal 100 karakter',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
        ];

        $request->validate($rules, $messages);

        $message_result = "Password tidak diubah!";
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;

        if ($request->password) {
            $rules_password = [
                'password' => 'min:8|max:100',
            ];
            $messages_password = [
                'password.min' => 'Password minimal 8 karakter',
                'password.max' => 'Password maksimal 100 karakter',
            ];

            $request->validate($rules_password, $messages_password);

            if (!password_verify($request->password, $user->password)) {
                $user->password = Hash::make($request->password);
                $message_result = "Password berhasil diubah!";
            } else if (password_verify($request->password, $user->password)) {
                $message_result = "Password gagal diubah!";
            }
        }

        $user->save();
        return back()->with('success', 'Profil berhasil diubah, ' . $message_result);
    }
}
