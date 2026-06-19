<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    /**
     * Display checkout form.
     */
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja Anda masih kosong.');
        }

        return view('checkout.index', compact('cart'));
    }

    /**
     * Store a new order in the database.
     */
    public function store(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('shop.index')->with('error', 'Keranjang belanja Anda kosong.');
        }

        $request->validate([
            'recipient_name' => 'required|string|max:255',
            'recipient_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string',
            'payment_method' => 'required|string|in:COD,Bank Transfer',
            'notes' => 'nullable|string',
        ]);

        // Wrap order creation in a transaction
        try {
            DB::beginTransaction();

            $totalAmount = 0;
            foreach ($cart as $id => $details) {
                $totalAmount += $details['price'] * $details['quantity'];
            }

            // Generate unique order number
            $orderNumber = 'HP-' . date('Ymd') . '-' . strtoupper(Str::random(6));

            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => $orderNumber,
                'total_amount' => $totalAmount,
                'status' => 'pending',
                'shipping_address' => $request->shipping_address,
                'recipient_name' => $request->recipient_name,
                'recipient_phone' => $request->recipient_phone,
                'payment_method' => $request->payment_method,
                'notes' => $request->notes,
            ]);

            foreach ($cart as $id => $details) {
                $product = Product::findOrFail($id);

                // Re-verify stock
                if ($product->stock < $details['quantity']) {
                    throw new \Exception("Stok tidak mencukupi untuk produk: {$product->name}");
                }

                // Subtract stock
                $product->decrement('stock', $details['quantity']);

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $details['quantity'],
                    'price' => $details['price'],
                ]);
            }

            DB::commit();

            // Clear session cart
            session()->forget('cart');

            return redirect()->route('orders.show', $order->id)->with('success', 'Pesanan Anda berhasil dibuat! Terima kasih telah berbelanja di Hijab Pin House.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat memproses pesanan Anda: ' . $e->getMessage());
        }
    }
}
