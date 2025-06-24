<?php
namespace App\Http\Controllers;

use App\Models\OrderLine;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderLineController extends Controller
{
    public function index()
    {
        $orderLines = OrderLine::with(['order', 'product'])->latest()->get();
        return view('order_lines.index', compact('orderLines'));
    }

    public function create()
    {
        $orders = Order::all();
        $products = Product::all();
        return view('order_lines.create', compact('orders', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        OrderLine::create($request->all());
        return redirect()->route('order_lines.index')->with('success', 'Order line added.');
    }

    public function edit(OrderLine $orderLine)
    {
        $orders = Order::all();
        $products = Product::all();
        return view('order_lines.edit', compact('orderLine', 'orders', 'products'));
    }

    public function update(Request $request, OrderLine $orderLine)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $orderLine->update($request->all());
        return redirect()->route('order_lines.index')->with('success', 'Order line updated.');
    }

    public function destroy(OrderLine $orderLine)
    {
        $orderLine->delete();
        return redirect()->route('order_lines.index')->with('success', 'Order line deleted.');
    }
}
