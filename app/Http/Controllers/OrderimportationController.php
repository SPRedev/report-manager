<?php

namespace App\Http\Controllers;

use App\Models\Orderimportation;
use App\Models\Fourniseur;
use Illuminate\Http\Request;

class OrderimportationController extends Controller
{
    public function index()
    {
        $orderimportations = Orderimportation::with('fourniseur')->latest()->get();
        $fourniseurs = Fourniseur::all(); // for dropdowns
        return view('orderimportations.index', compact('orderimportations', 'fourniseurs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_ord' => 'required',
            'id_fourniseur' => 'required|exists:fourniseurs,id',
            'date_offre' => 'nullable|date',
            
            'date_contre_offre' => 'nullable|date',
         
            'date_confirmation' => 'nullable|date',
    
            'status' => 'required|string',
            
        ]);

        Orderimportation::create($validated);
        return redirect()->back()->with('success', 'Order added successfully.');
    }
    public function edit(Orderimportation $orderimportation)
{
    $fourniseurs = Fourniseur::all();
    return view('orderimportations.edit', compact('orderimportation', 'fourniseurs'));
}

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id_ord' => 'required',
            'id_fourniseur' => 'required|exists:fourniseurs,id',
            'date_offre' => 'nullable|date',
            'offre' => 'nullable|string',
            'date_contre_offre' => 'nullable|date',
            'contre_offre' => 'nullable|string',
            'date_confirmation' => 'nullable|date',
            'confirmation' => 'nullable|string',
            'status' => 'required|string',
        ]);

        Orderimportation::findOrFail($id)->update($validated);
        return redirect()->back()->with('success', 'Order updated successfully.');
    }

    public function destroy($id)
    {
        Orderimportation::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Order deleted successfully.');
    }
}
