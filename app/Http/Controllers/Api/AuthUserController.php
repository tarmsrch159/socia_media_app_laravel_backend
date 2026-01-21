<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class AuthUserController extends Controller
{
    //
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? response()->json(['message' => 'Reset link sent'])
            : response()->json(['message' => 'Email not found'], 400);
    }

    public function resetPassword(Request $request)
    {
        $user = $request->user();

        // 1️⃣ Validate input
        $request->validate([
            'oldPassword' => ['required'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        // 2️⃣ Check old password
        if (!Hash::check($request->oldPassword, $user->password)) {
            throw ValidationException::withMessages([
                'old_password' => ['Old password is incorrect.'],
            ]);
        }

        // 3️⃣ Update new password
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        // 4️⃣ (optional) logout all devices
        // $user->tokens()->delete();

        return response()->json([
            'message' => 'Password updated successfully',
        ]);
    }
}
