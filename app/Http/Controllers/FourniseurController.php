<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fourniseur;
class FourniseurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fourniseurs = Fourniseur::all();
        return view('fourniseurs.index', compact('fourniseurs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('fourniseurs.create');
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fourniseur_name' => 'required',
        ]);
          Fourniseur::create($request->all());
        return redirect()->route('fourniseurs.index')->with('success', 'fourniseur added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
public function search(Request $request)
{
    try {
        $query = $request->get('q');

        $fourniseurs = Fourniseur::where('fourniseur_name', 'like', "%$query%")
            ->orWhere('phone', 'like', "%$query%")
            ->orWhere('email', 'like', "%$query%")
            ->orWhere('region', 'like', "%$query%")
            ->get();

        return response()->json($fourniseurs);
    } catch (\Exception $e) {
        \Log::error('Search failed: ' . $e->getMessage());
        return response()->json(['error' => 'Search failed'], 500);
    }
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    $fourniseur = Fourniseur::findOrFail($id);
    return view('fourniseurs.edit', compact('fourniseur'));
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, string $id)
{
    $request->validate([
        'fourniseur_name' => 'required',
    ]);

    $fourniseur = Fourniseur::findOrFail($id); // ✅ load fourniseur from database
    $fourniseur->update($request->all());

    return redirect()->route('fourniseurs.index')->with('success', 'fourniseur updated.');
}


    /**
     * Remove the specified resource from storage.
     */
public function destroy(string $id)
{
    $product = Fourniseur::findOrFail($id);
    $product->delete();

    return redirect()->route('fourniseurs.index')->with('success', 'fourniseur deleted successfully.');
}

}