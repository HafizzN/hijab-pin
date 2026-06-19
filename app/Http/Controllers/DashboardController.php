<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class DashboardController extends Controller
{
    /**
     * Handle the user dashboard view.
     */
    public function index()
    {
        $user = auth()->user();

        // Redirect admins to the admin dashboard
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        // Get customer statistics
        $ordersQuery = $user->orders();
        
        $totalOrders = (clone $ordersQuery)->count();
        $activeOrders = (clone $ordersQuery)->whereIn('status', ['pending', 'processing', 'shipped'])->count();
        $totalSpent = (clone $ordersQuery)->where('status', '!=', 'cancelled')->sum('total_amount');
        $recentOrders = (clone $ordersQuery)->latest()->take(5)->get();
        $featuredProducts = \App\Models\Product::with('category')->where('is_featured', true)->take(3)->get();

        return view('dashboard', compact(
            'user',
            'totalOrders',
            'activeOrders',
            'totalSpent',
            'recentOrders',
            'featuredProducts'
        ));
    }
}
