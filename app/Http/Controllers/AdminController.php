<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display admin dashboard overview metrics.
     */
    public function index()
    {
        $totalRevenue = Order::where('status', '!=', 'cancelled')->sum('total_amount');
        $ordersCount = Order::count();
        $customersCount = User::where('role', 'customer')->count();
        $lowStockProducts = Product::where('stock', '<=', 5)->get();
        $recentOrders = Order::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalRevenue',
            'ordersCount',
            'customersCount',
            'lowStockProducts',
            'recentOrders'
        ));
    }

    /**
     * Display a list of all orders for management.
     */
    public function orders(Request $request)
    {
        $query = Order::with('user')->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->paginate(15)->withQueryString();
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Update the status of an order.
     */
    public function updateOrderStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:pending,processing,shipped,completed,cancelled',
        ]);

        $order = Order::findOrFail($id);
        $oldStatus = $order->status;
        $order->status = $request->status;
        $order->save();

        // If transitioning to cancelled, restore stock
        if ($request->status === 'cancelled' && $oldStatus !== 'cancelled') {
            foreach ($order->items as $item) {
                $item->product->increment('stock', $item->quantity);
            }
        }

        return redirect()->back()->with('success', "Status pesanan {$order->order_number} berhasil diubah menjadi: {$request->status}");
    }
}
