<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    /**
     * Verify the user's email address.
     *
     * @param string $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify($token)
    {
        $user = User::where('confirmation_token', $token)->first();

        if (!$user) {
            return redirect('/')->with('error', 'Invalid confirmation token.');
        }

        $user->is_confirmed = true;
        $user->confirmation_token = null;
        $user->save();

        return redirect('/')->with('status', 'Email confirmed successfully!');
    }
}
