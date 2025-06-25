<?php

namespace App\Http\Controllers;
use App\Models\Importation;
use App\Models\Predom;
use Illuminate\Http\Request;

class PredomController extends Controller
{
    /**
     * Display a listing of the importations.
     */
    public function index()
    {
        $predoms = Predom::all();
        return view('predoms.index', compact('predoms'));
    }

    /**
     * Show the form for creating a new resource.
     */

public function create(Request $request)
{
    $importations = Importation::all(); // <--- this is needed in the view
    $importation_id = $request->query('importation_id');

    return view('predoms.create', compact('importations', 'importation_id'));
}



    /**
     * Store a newly created importation.
     */
    public function store(Request $request)
    {

     $validated = $request->validate([
    'importation_id' => 'required|exists:importations,id',
    'predom_id' => 'required|string',
    'date_predom' => 'nullable|date',
    'status' => 'nullable|string',
]);

Predom::create($validated);

return redirect()->route('predoms.index')->with('success', 'Predom created successfully.');
    }

    /**
     * Display the specified importation.
     */
    public function show($id)
    {
        $predom = Predom::findOrFail($id);
        return response()->json($importation);
    }

    public function edit(Predom $predom)
{
    return view('predoms.edit', compact('predom'));
}

public function update(Request $request, Predom $predom)
{
    $validated = $request->validate([
        'importation_id' => 'required|exists:importations,id',
        'predom_id' => 'required|string',
        'date_predom' => 'nullable|date',
        'status' => 'nullable|string',
    ]);

    $predom->update($validated);

    return redirect()->route('predoms.index')->with('success', 'Predom updated successfully.');
}


    /**
     * Remove the specified importation.
     */
    public function destroy($id)
    {
        $predom = Predom::findOrFail($id);
        $predom->delete();
        return redirect()->route('predoms.index')->with('warning', 'predom deleted.');
    }
}