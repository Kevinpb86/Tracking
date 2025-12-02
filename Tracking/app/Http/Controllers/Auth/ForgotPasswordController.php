<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Mail\ResetPasswordMail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class ForgotPasswordController extends Controller
{
    /**
     * Show the forgot password form.
     */
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle a forgot password request.
     */
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
        ]);

        // Find user by email or username
        $user = User::where('email', $request->email)
                    ->orWhere('username', $request->email)
                    ->first();

        if (!$user) {
            return back()->withErrors(['email' => 'We could not find a user with that email or username.']);
        }

        // Generate reset token
        $token = Str::random(64);
        
        // Delete existing tokens for this user
        DB::table('password_reset_tokens')
            ->where('email', $user->email)
            ->delete();

        // Insert new token (store plain token for verification)
        DB::table('password_reset_tokens')->insert([
            'email' => $user->email,
            'token' => hash('sha256', $token),
            'created_at' => Carbon::now(),
        ]);

        // Send email with reset link
        try {
            Mail::to($user->email)->send(new ResetPasswordMail($user, $token));
            
            return back()->with('status', 'Password reset link has been sent to your email address. Please check your inbox.');
        } catch (\Exception $e) {
            // Log error if needed
            \Log::error('Failed to send reset password email: ' . $e->getMessage());
            
            return back()->withErrors(['email' => 'Failed to send email. Please try again later.']);
        }
    }
}

