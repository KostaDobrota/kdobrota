<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Get total products count
        $totalProducts = Product::count();

        // Get featured products count
        $featuredProducts = Product::where('is_featured', true)->count();

        // Get low stock products (less than or equal to 5 items)
        $lowStockProducts = Product::where('stock', '<=', 5)->count();

        // Get total categories
        $totalCategories = Category::count();

        // Get recent products (last 5)
        $recentProducts = Product::with('category')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('editor.dashboard', compact(
            'totalProducts',
            'featuredProducts',
            'lowStockProducts',
            'totalCategories',
            'recentProducts'
        ));
    }
} 