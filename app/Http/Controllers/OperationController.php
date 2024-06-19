<?php

// app/Http/Controllers/OperationController.php
namespace App\Http\Controllers;

use App\Models\Operation;
use Illuminate\Http\Request;

class OperationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'account_id' => 'required',
            'date' => 'required',
            'description' => 'required',
            'debit' => 'numeric',
            'credit' => 'numeric',
        ]);

        Operation::create($request->all());
        return redirect()->route('accounts.index');
    }

    public function update(Request $request, Operation $operation)
    {
        $request->validate([
            'date' => 'required',
            'description' => 'required',
            'debit' => 'numeric',
            'credit' => 'numeric',
        ]);

        $operation->update($request->all());
        return redirect()->route('accounts.index');
    }

    public function destroy(Operation $operation)
    {
        $operation->delete();
        return redirect()->route('accounts.index');
    }

    public function edit(Operation $operation)
    {
        return view('operations.edit', compact('operation'));
    }
}
