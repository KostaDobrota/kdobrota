<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Recent orders for the table
        $recentOrders = Order::with(['user', 'items.product'])
            ->latest()
            ->take(5)
            ->get();

        // Category distribution data
        $categoryData = Category::withCount('products')
            ->get()
            ->map(function ($category) {
                return [$category->name, $category->products_count];
            })
            ->toArray();

        // Add a default category if none exist
        if (empty($categoryData)) {
            $categoryData = [['Нема категорија', 0]];
        }

        // Orders status distribution data
        $orderStatusData = [];
        $hasOrders = Order::count() > 0;
        
        if ($hasOrders) {
            $orderStatusData = [
                ['На чекању', Order::where('status', 'pending')->count()],
                ['У обради', Order::where('status', 'processing')->count()],
                ['Завршено', Order::where('status', 'completed')->count()],
                ['Отказано', Order::where('status', 'cancelled')->count()]
            ];
        } else {
            $orderStatusData = [['Нема наруџбина', 1]]; // Default data for empty state
        }

        return view('admin.dashboard', compact(
            'recentOrders',
            'categoryData',
            'orderStatusData',
            'hasOrders'
        ));
    }
} 