<?php

namespace App\Http\Controllers;

use App\Models\Importation;
use Illuminate\Http\Request;
use App\Models\Fourniseur;
class ImportationController extends Controller
{
    /**
     * Display a listing of the importations.
     */
    public function index()
    {
        $importations = Importation::all();
        return view('importations.index', compact('importations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fourniseurs = Fourniseur::all();

        return view('importations.create', compact('fourniseurs'));
    }


    /**
     * Store a newly created importation.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'importation_id' => 'required|string',
            'fourniseur_name' => 'required|string',
            'importation_date' => 'nullable|string',
            'montant_algex' => 'nullable|string',
            'montant_definitive' => 'nullable|string',
            'status' => 'nullable|string',
        ]);

        $importation = Importation::create($validated);
        return redirect()->route('importations.index')->with('success', 'Importation created successfully.');
        // return response()->json($importation, 201);
    }

    /**
     * Display the specified importation.
     */
    public function show($id)
    {
        $importation = Importation::findOrFail($id);
        return response()->json($importation);
    }

    public function edit(string $id)
    {
    $importation = Importation::findOrFail($id);
    return view('importations.edit', compact('importation'));
    }
    /**
     * Update the specified importation.
     */
    public function update(Request $request, $id)
    {
        $importation = Importation::findOrFail($id);

        $validated = $request->validate([

            'importation_id' => 'sometimes|required|string',
            'fourniseur_name' => 'sometimes|required|string',
            'importation_date' => 'nullable|string',
            'montant_algex' => 'nullable|string',
            'montant_definitive' => 'nullable|string',
            'status' => 'nullable|string',
        ]);

        $importation->update($validated);
        return response()->json($importation);
    }

    /**
     * Remove the specified importation.
     */
    public function destroy($id)
    {
        $importation = Importation::findOrFail($id);
        $importation->delete();
        return redirect()->route('importations.index')->with('error', 'Failed to delete importation.');
    }
}
