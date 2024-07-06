<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{

    public  function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'product_name' => 'required|string|max:255',
            'product_type' => 'nullable|string|max:100',
        ]);

        // Create a new Product instance
        $product = new Product();
        $product->fournisseur_user_id = auth()->id(); // Assuming you want to store the authenticated user's ID
        $product->product_name = $request->product_name;
        $product->product_type = $request->product_type;
        $product->save();


        /** @var User $user */
        $user = Auth::user();
        // Update the user's role to admin
        $user->role = 'Fournisseur';
        $user->save();

        // Log role after update
        Log::info('Admin role after update: ' . $user->role);


        // Redirect back with success message
        return redirect()->back()->with('success', 'تمت إضافة المنتج بنجاح.');
    }
}
