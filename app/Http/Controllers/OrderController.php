<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the customer's orders.
     */
    public function index()
    {
        $orders = auth()->user()->orders()->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    /**
     * Display the specified order details.
     */
    public function show($id)
    {
        $order = Order::with(['items.product'])
            ->where('id', $id)
            ->where(function ($query) {
                // Regular customers can only view their own orders, admins can view any
                if (!auth()->user()->isAdmin()) {
                    $query->where('user_id', auth()->id());
                }
            })
            ->firstOrFail();

        return view('orders.show', compact('order'));
    }
}
