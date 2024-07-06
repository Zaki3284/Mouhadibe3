<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Mail\RegistrationMail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

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
            'email' => ['sometimes', 'nullable', 'string', 'email', 'max:255', 'unique:users'],
            'phone_number' => [
                'sometimes',

                'string',
                'max:20',
                'unique:users',
                'regex:/^\+222[234]\d{7}$/',
            ],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'password' => Hash::make($data['password']),
            'confirmation_token' => Str::random(60),
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        Log::info('Confirmation URL: ' . route('confirmation', ['token' => $user->confirmation_token]));

        // Send confirmation email or SMS based on availability of email or phone number
        if (!empty($user->email)) {
            $details = [
                'username' => $user->username,
                'confirmation_url' => route('confirmation', ['token' => $user->confirmation_token]),
            ];
            Mail::to($user->email)->send(new RegistrationMail($details));
        } elseif (!empty($user->phone_number)) {
            // Logic to send SMS if required
            // Example: SMS::sendConfirmation($user->phone_number, $user->confirmation_token);
        }

        return redirect()->back()->with('message', 'Confirmation email/SMS sent. Please check your inbox or SMS.');
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
