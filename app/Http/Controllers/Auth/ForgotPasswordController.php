<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Mail\ResetPasswordEmail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }

        $token = Password::createToken($user);
        $resetUrl = url("/password/reset/{$token}?email=" . urlencode($user->email));

        try {
            Mail::to($user->email)->send(new ResetPasswordEmail($resetUrl));
            Log::info('Password reset email sent to ' . $user->email);
        } catch (\Exception $e) {
            Log::error('Failed to send password reset email: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to send email.');
        }

        return redirect()->back()->with('status', 'Password reset link sent!');
    }
}
