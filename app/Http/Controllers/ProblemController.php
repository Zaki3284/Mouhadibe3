<?php

namespace App\Http\Controllers;

use App\Models\Problem;
use Illuminate\Http\Request;

class ProblemController extends Controller
{
    /**
     * Display a listing of the problems.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $problems = Problem::all();
        return view('problems.index', compact('problems'));
    }

    /**
     * Store a newly created problem in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'priority' => 'required',
        ]);

        Problem::create($request->all());

        return redirect()->back()->with('success', 'Problème signalé avec succès');
    }
}
