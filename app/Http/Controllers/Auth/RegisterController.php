<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\RegistrationMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'confirmation_token' => Str::random(60),
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        // Send confirmation email
        $details = [
            'username' => $user->username,
            'confirmation_url' => route('confirmation', ['token' => $user->confirmation_token]),
        ];

        Mail::to($user->email)->send(new RegistrationMail($details));

        return redirect()->back()->with('message', 'Confirmation email sent. Please check your inbox.');
    }

    public function confirmEmail($token)
    {
        try {
            $user = User::where('confirmation_token', $token)->firstOrFail();

            // Mark the user as confirmed and clear the confirmation token
            $user->update([
                'is_confirmed' => true,
                'confirmation_token' => null,
            ]);

            return redirect()->route('login')->with('message', 'Email confirmed. You can now log in.');
        } catch (\Throwable $e) {
            // Log or handle the error appropriately
            return redirect()->route('login')->with('error', 'Email confirmation failed. Please try again.');
        }
    }
}
