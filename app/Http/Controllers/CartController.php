<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display the cart contents.
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    /**
     * Add a product to the cart.
     */
    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        $quantity = $request->input('quantity', 1);

        // Check stock limit
        if ($product->stock < $quantity) {
            return redirect()->back()->with('error', "Maaf, stok hanya tersisa {$product->stock} item.");
        }

        // If product already in cart, increment quantity
        if (isset($cart[$id])) {
            $newQuantity = $cart[$id]['quantity'] + $quantity;
            if ($product->stock < $newQuantity) {
                return redirect()->back()->with('error', "Tidak bisa menambah item. Batas stok maksimal: {$product->stock}.");
            }
            $cart[$id]['quantity'] = $newQuantity;
        } else {
            // Add new product to cart
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => $quantity,
                "price" => $product->price,
                "image_url" => $product->image_url,
                "slug" => $product->slug,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', "{$product->name} berhasil ditambahkan ke keranjang!");
    }

    /**
     * Update quantity of a product in the cart.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);
        $quantity = $request->input('quantity', 1);

        if ($quantity <= 0) {
            unset($cart[$id]);
        } else {
            if ($product->stock < $quantity) {
                return redirect()->back()->with('error', "Stok tidak mencukupi. Maksimal stok: {$product->stock}.");
            }
            $cart[$id]['quantity'] = $quantity;
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Keranjang berhasil diperbarui!');
    }

    /**
     * Remove a product from the cart.
     */
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Item berhasil dihapus dari keranjang.');
    }
}
