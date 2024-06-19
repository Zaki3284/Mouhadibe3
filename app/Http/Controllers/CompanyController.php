<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    public function createBilan(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'company_address' => 'required|string|max:255',
            'company_registration' => 'required|string|max:255',
            'total_immobilisation' => 'required|numeric',
            'details_immobilisation' => 'nullable|string',
            'total_actif_a_court_terme' => 'required|numeric',
            'details_total_actif_a_court_terme' => 'nullable|string',
            'total_du_capital' => 'required|numeric',
            'details_du_capital' => 'nullable|string',
            'total_du_passif_court_terme' => 'required|numeric',
            'details_du_passif_court_terme' => 'nullable|string',
        ]);

        $company = new Company();
        $company->company_name = $request->input('company_name');
        $company->address = $request->input('company_address');
        $company->registration_number = $request->input('company_registration');
        $company->total_immobilisation = $request->input('total_immobilisation');
        $company->details_immobilisation = $request->input('details_immobilisation');
        $company->total_actif_a_court_terme = $request->input('total_actif_a_court_terme');
        $company->details_total_actif_a_court_terme = $request->input('details_total_actif_a_court_terme');
        $company->total_du_capital = $request->input('total_du_capital');
        $company->details_du_capital = $request->input('details_du_capital');
        $company->total_du_passif_court_terme = $request->input('total_du_passif_court_terme');
        $company->details_du_passif_court_terme = $request->input('details_du_passif_court_terme');
        $company->admin_user_id = auth()->user()->id; // Set the admin_user_id
        $company->save();

        return redirect()->back()->with('success', 'Company created successfully.');

        /** @var User $user */
        $user = Auth::user();
        // Update the user's role to "admin"
        $user->update(['role' => 'admin']);
    }
}
