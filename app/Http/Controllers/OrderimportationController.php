<?php

namespace App\Http\Controllers;

use App\Models\Orderimportation;
use App\Models\Fourniseur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrderimportationController extends Controller
{
public function index()
{
    $orderimportations = Orderimportation::with('fourniseur')->latest()->get();
    $fourniseurs = Fourniseur::all(); // ✅ Add this

    return view('orderimportations.index', compact('orderimportations', 'fourniseurs'));
}

    public function create()
    {
        $fourniseurs = Fourniseur::all();
        return view('orderimportations.create', compact('fourniseurs'));
    }

public function store(Request $request)
{
    $validated = $request->validate([
        'id_ord' => 'required|string',
        'id_fourniseur' => 'required|exists:fourniseurs,id',
        'date_offre' => 'nullable|date',
        'offre' => 'nullable|file',
        'date_contre_offre' => 'nullable|date',
        'contre_offre' => 'nullable|file',
        'date_confirmation' => 'nullable|date',
        'confirmation' => 'nullable|file',
        'status' => 'nullable|string',
    ]);

    // Upload files
    foreach (['offre', 'contre_offre', 'confirmation'] as $field) {
        if ($request->hasFile($field)) {
            $validated[$field] = $request->file($field)->store('orders', 'public');
        }
    }

    Orderimportation::create($validated);

    return redirect()->route('orderimportations.index')->with('success', 'Order created successfully.');
}

public function update(Request $request, $id)
{
    $order = Orderimportation::findOrFail($id);

    $validated = $request->validate([
        'id_ord' => 'required|string',
        'id_fourniseur' => 'required|exists:fourniseurs,id',
        'date_offre' => 'nullable|date',
        'offre' => 'nullable|file',
        'date_contre_offre' => 'nullable|date',
        'contre_offre' => 'nullable|file',
        'date_confirmation' => 'nullable|date',
        'confirmation' => 'nullable|file',
        'status' => 'nullable|string',
    ]);

    // Handle new file uploads and delete old ones if needed
    foreach (['offre', 'contre_offre', 'confirmation'] as $field) {
        if ($request->hasFile($field)) {
            // Delete old file if exists
            if ($order->$field) {
                Storage::disk('public')->delete($order->$field);
            }
            $validated[$field] = $request->file($field)->store('orders', 'public');
        }
    }

    $order->update($validated);

    return redirect()->route('orderimportations.index')->with('success', 'Order updated successfully.');
}


    public function edit($id)
    {
        $orderimportation = Orderimportation::findOrFail($id);
        $fourniseurs = Fourniseur::all();
        return view('orderimportations.edit', compact('orderimportation', 'fourniseurs'));
    }

  

    public function destroy($id)
    {
        $order = Orderimportation::findOrFail($id);
        $order->delete();
        return redirect()->route('orderimportations.index')->with('warning', 'Order deleted.');
    }
}