<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Ваша корпа је празна.');
        }

        return view('checkout', [
            'cart' => $cart,
            'subtotal' => $this->calculateSubtotal($cart),
            'shipping' => $this->calculateShipping($cart),
        ]);
    }

    public function placeOrder(Request $request)
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Ваша корпа је празна.');
        }

        $request->validate([
            'shipping_address' => 'required|string|max:255',
            'shipping_city' => 'required|string|max:255',
            'shipping_zip' => 'required|string|max:20',
            'shipping_phone' => 'required|string|max:20',
            'notes' => 'nullable|string|max:1000',
        ]);

        try {
            DB::beginTransaction();

            $subtotal = $this->calculateSubtotal($cart);
            $shipping = $this->calculateShipping($cart);
            $total = $subtotal + $shipping;

            $order = Order::create([
                'user_id' => auth()->id(),
                'subtotal' => $subtotal,
                'shipping' => $shipping,
                'total' => $total,
                'status' => 'pending',
                'shipping_address' => $request->shipping_address,
                'shipping_city' => $request->shipping_city,
                'shipping_zip' => $request->shipping_zip,
                'shipping_phone' => $request->shipping_phone,
                'notes' => $request->notes,
            ]);

            foreach ($cart as $id => $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'product_name' => $item['name'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'subtotal' => $item['price'] * $item['quantity'],
                ]);
            }

            // Clear the cart after successful order
            session()->forget('cart');

            DB::commit();

            return redirect()->route('orders.show', $order)->with('success', 'Наруџбина је успешно креирана!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Дошло је до грешке приликом креирања наруџбине. Молимо покушајте поново.');
        }
    }

    private function calculateSubtotal($cart)
    {
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        return $subtotal;
    }

    private function calculateShipping($cart)
    {
        return !empty($cart) ? 500 : 0; // 500 RSD fixed shipping
    }
} 