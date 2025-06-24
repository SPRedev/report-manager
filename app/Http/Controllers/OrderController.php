<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with(['client', 'commercial'])->latest()->get();
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $clients = Client::all();
        // $commercials = User::all(); 
        $commercials = User::whereIn('role', ['commercial', 'admin'])->get();
        return view('orders.create', compact('clients', 'commercials'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'commercial_id' => 'nullable|exists:users,id',
            'order_date' => 'required|date',
            'status' => 'required|in:in_preparation,ready,delivered',
        ]);

        Order::create($request->all());

        return redirect()->route('orders.index')->with('success', 'Order created.');
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
         $order = Order::findOrFail($id);
        $clients = Client::all();
        $commercials = User::all();
        return view('orders.edit', compact('order', 'clients', 'commercials'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $order = Order::findOrFail($id);

        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'commercial_id' => 'nullable|exists:users,id',
            'order_date' => 'required|date',
            'status' => 'required|in:in_preparation,ready,delivered',
        ]);

        $order->update($request->all());

        return redirect()->route('orders.index')->with('success', 'Order updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         Order::findOrFail($id)->delete();
        return redirect()->route('orders.index')->with('success', 'Order deleted.');
    }
}
