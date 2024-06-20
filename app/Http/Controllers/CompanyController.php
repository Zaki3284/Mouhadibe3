<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ComptableRegistered;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    /**
     * Show the form for creating a company.
     *
     * @return \Illuminate\View\View
     */
    public function showCompanyCreationForm()
    {
        return view('company.create');
    }

    /**
     * Register a comptable and create a company.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createCompany(Request $request)
    {
        // Validate the request data
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'company_name' => 'required|string|max:255',
            'company_address' => 'required|string|max:255',
        ]);

        // Create the comptable (User)
        $comptable = User::create([
            'fullname' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'comptable',
        ]);

        // Optionally send confirmation email
        Mail::to($comptable->email)->send(new ComptableRegistered($comptable));

        // Create the company
        $company = new Company();
        $company->company_name = $request->input('company_name');
        $company->company_address = $request->input('company_address');
        $company->admin_user_id = Auth::id(); // Assign the admin's ID as admin_user_id
        $company->comptable_user_id = $comptable->id; // Assign the newly created comptable's ID
        $company->save();

        /** @var User $user */
        $user = Auth::user();

        $user->update(['role' => 'admin']);

        // Log out the user
        Auth::logout();

        // Redirect or return a response as needed
        return redirect('/')->with('status', 'Company created successfully and you are now an admin.');
    }
}
