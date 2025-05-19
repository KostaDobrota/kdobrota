<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role', 'registered')->get();
        $products = Product::all();
        $statuses = ['pending', 'processing', 'completed', 'cancelled'];

        foreach ($users as $user) {
            // Create 3 orders for each regular user
            for ($i = 0; $i < 3; $i++) {
                $order = Order::create([
                    'user_id' => $user->id,
                    'status' => $statuses[array_rand($statuses)],
                    'shipping_address' => 'Ulica ' . rand(1, 100) . ', Grad',
                    'phone' => '06' . rand(10000000, 99999999),
                    'notes' => rand(0, 1) ? 'Posebna napomena za dostavu' : null,
                    'total_amount' => 0
                ]);

                // Add 1-5 random products to each order
                $orderTotal = 0;
                $numProducts = rand(1, 5);
                
                for ($j = 0; $j < $numProducts; $j++) {
                    $product = $products->random();
                    $quantity = rand(1, 3);
                    $price = $product->price;
                    $subtotal = $price * $quantity;
                    $orderTotal += $subtotal;

                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'quantity' => $quantity,
                        'price' => $price,
                        'subtotal' => $subtotal
                    ]);
                }

                // Update order total
                $order->update(['total_amount' => $orderTotal]);
            }
        }
    }
}
