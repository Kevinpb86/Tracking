<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ResetPasswordController extends Controller
{
    /**
     * Show the reset password form.
     */
    public function showResetForm(Request $request)
    {
        $token = $request->query('token');
        $email = $request->query('email');

        if (!$token || !$email) {
            return redirect()->route('password.forgot')
                ->withErrors(['email' => 'Invalid reset link.']);
        }

        // Verify token exists and is not expired
        $passwordReset = DB::table('password_reset_tokens')
            ->where('email', $email)
            ->first();

        if (!$passwordReset) {
            return redirect()->route('password.forgot')
                ->withErrors(['email' => 'Invalid or expired reset link.']);
        }

        // Check if token is expired (60 minutes)
        $createdAt = Carbon::parse($passwordReset->created_at);
        $expiresAt = $createdAt->copy()->addMinutes(60);
        if ($expiresAt->isPast()) {
            DB::table('password_reset_tokens')
                ->where('email', $email)
                ->delete();
            
            return redirect()->route('password.forgot')
                ->withErrors(['email' => 'Reset link has expired. Please request a new one.']);
        }

        return view('auth.reset-password', [
            'token' => $token,
            'email' => $email,
        ]);
    }

    /**
     * Handle a reset password request.
     */
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Find user
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'User not found.']);
        }

        // Verify token
        $passwordReset = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$passwordReset) {
            return back()->withErrors(['email' => 'Invalid or expired reset token.']);
        }

        // Check if token matches
        if (!hash_equals($passwordReset->token, hash('sha256', $request->token))) {
            return back()->withErrors(['email' => 'Invalid reset token.']);
        }

        // Check if token is expired (60 minutes)
        $createdAt = Carbon::parse($passwordReset->created_at);
        $expiresAt = $createdAt->copy()->addMinutes(60);
        if ($expiresAt->isPast()) {
            DB::table('password_reset_tokens')
                ->where('email', $request->email)
                ->delete();
            
            return back()->withErrors(['email' => 'Reset token has expired. Please request a new one.']);
        }

        // Update password
        $user->password = Hash::make($request->password);
        $user->save();

        // Delete used token
        DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->delete();

        return redirect()->route('login')
            ->with('status', 'Password has been reset successfully. Please login with your new password.');
    }
}

