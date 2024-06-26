<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ComptableRegistered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ComptableRegistered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Log;

class CompanyController extends Controller
{
    public function createCompany(Request $request)
    {
        // Validate the request data
        $request->validate([
            'fullname' => 'required|string|max:255|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'company_name' => 'required|string|max:255',
            'company_address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20|unique:users,phone_number',
        ]);

        // Generate a confirmation token
        $confirmationToken = Str::random(60);

        // Create the comptable (User)
        $comptable = User::create([
            'username' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'comptable', // Ensure the role is set to 'comptable'
            'phone_number' => $request->phone_number,
            'confirmation_token' => $confirmationToken,
        ]);

        // Log role after creation
        Log::info('Comptable role after creation: ' . $comptable->role);

        // Generate a confirmation URL
        $confirmationUrl = route('confirmation.route', ['token' => $confirmationToken]);

        // Send confirmation email
        Mail::to($comptable->email)->send(new ComptableRegistered($request->fullname, $confirmationUrl, $request->company_name));

        // Create the company
        $company = new Company();
        $company->company_name = $request->input('company_name');
        $company->company_address = $request->input('company_address');
        $company->admin_user_id = Auth::id();
        $company->comptable_user_id = $comptable->id;
        $company->save();

        /** @var User $user */
        $user = Auth::user();

        // Update the user's role to admin
        $user->role = 'admin';
        $user->save();

        // Log role after update
        Log::info('Admin role after update: ' . $user->role);

        // Log out the user
        Auth::logout();

        // Flush the session data
        $request->session()->flush();

        // Redirect or return a response as needed
        return redirect('/')->with('status', 'Company created successfully and you are now an admin.');
    }
}
