<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('/home'); // Redirect to the intended page after successful login
        } else {
            return $this->sendFailedLoginResponse($request);
        }
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        $error = Lang::get('auth.failed');

        if ($request->expectsJson()) {
            return response()->json(['message' => $error], 422);
        }

        return redirect()->back()
            ->withInput($request->only('username', 'remember'))
            ->withErrors(['username' => $error]);
    }
}
