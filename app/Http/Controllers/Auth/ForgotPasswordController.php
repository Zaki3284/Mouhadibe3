<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Mail\ResetPasswordEmail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }
    public function sendResetLinkEmail(Request $request)
    {
        // Find the user by email
        $user = User::where('email', $request->email)->first();

        // If user not found, redirect back with error message
        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }

        // Generate a password reset token
        $token = Password::createToken($user);

        // Generate the password reset URL with the token and user's email
        $resetUrl = url("/password/reset/{$token}?email=" . urlencode($user->email));

        // Send the password reset email
        Mail::to($user->email)->send(new ResetPasswordEmail($resetUrl));

        // Redirect back with success message
        return redirect()->back()->with('status', 'Password reset link sent!');
    }
}
