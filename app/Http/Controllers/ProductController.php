<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $products = Product::all();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'reference' => 'required|unique:products',
            'designation' => 'required',
            'marque' => 'required',
            'prix_vente' => 'required|numeric',
        ]);

        Product::create($request->all());
        return redirect()->route('products.index')->with('success', 'Product added.');
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
    $product = Product::findOrFail($id);
    return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $product = Product::findOrFail($id); // ✅ Move this line first!

    $request->validate([
        'reference' => 'required|unique:products,reference,' . $product->id,
        'designation' => 'required',
        'marque' => 'required',
        'prix_vente' => 'required|numeric',
    ]);

    $product->update($request->all());

    return redirect()->route('products.index')->with('success', 'Product updated.');
}


    /**
     * Remove the specified resource from storage.
     */
  public function destroy(string $id)
{
    $product = Product::findOrFail($id);
    $product->delete();

    return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
}

}
