<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Prikaz liste svih narudžbina
     */
    public function index()
    {
        $orders = Order::with('user')->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Prikaz forme za kreiranje nove narudžbine
     */
    public function create()
    {
        return view('admin.orders.create');
    }

    /**
     * Čuvanje nove narudžbine u bazi
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:pending,processing,completed,cancelled',
            'shipping_address' => 'required|string',
            'phone' => 'required|string',
            'notes' => 'nullable|string'
        ]);

        $order = Order::create($request->all());

        return redirect()->route('admin.orders.index')
            ->with('success', 'Narudžbina je uspešno kreirana.');
    }

    /**
     * Prikaz pojedinačne narudžbine
     */
    public function show(Order $order)
    {
        $order->load(['user', 'items.product']);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Prikaz forme za izmenu narudžbine
     */
    public function edit(Order $order)
    {
        $order->load(['user', 'items.product']);
        return view('admin.orders.edit', compact('order'));
    }

    /**
     * Ažuriranje narudžbine u bazi
     */
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        $order->update($validated);

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order status updated successfully.');
    }

    /**
     * Brisanje narudžbine iz baze
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index')
            ->with('success', 'Order deleted successfully.');
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        $order->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }
}
