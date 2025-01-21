<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        return Order::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|numeric|min:0',
            'quantity' => 'required|numeric|min:0',
            'total_price' => 'required|numeric|min:0',
        ]);
        $order = Order::create($validated);
        return response()->json($order, 201);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'product_id' => 'required|numeric|min:0',
            'quantity' => 'required|numeric|min:0',
            'total_price' => 'required|numeric|min:0',
        ]);
        $order = Order::findOrFail($id);
        $order->update($validated);
        return response()->json($order);
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return response()->json(['message' => 'Product deleted
        successfully']);
    }
}
