<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all();
        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_name' => 'required',
        ]);
          Client::create($request->all());
        return redirect()->route('clients.index')->with('success', 'Client added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    $client = Client::findOrFail($id);
    return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, string $id)
{
    $request->validate([
        'client_name' => 'required',
    ]);

    $client = Client::findOrFail($id); // ✅ load client from database
    $client->update($request->all());

    return redirect()->route('clients.index')->with('success', 'Client updated.');
}


    /**
     * Remove the specified resource from storage.
     */
public function destroy(string $id)
{
    $product = Client::findOrFail($id);
    $product->delete();

    return redirect()->route('clients.index')->with('success', 'Client deleted successfully.');
}

}
