<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private function cart(): Cart
    {
        return Cart::firstOrCreate(['user_id' => auth()->id()]);
    }

    public function index()
    {
        $cart = $this->cart()->load('items.product');

        return view('cart.index', compact('cart'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1'],
            'action' => ['nullable', 'in:cart,buy_now'],
        ]);
        $product = Product::findOrFail($data['product_id']);
        abort_if($product->stock <= 0, 422, 'Stok habis.');
        abort_if($data['quantity'] > $product->stock, 422, 'Stok tidak mencukupi.');

        if (($data['action'] ?? 'cart') === 'buy_now') {
            $cart = $this->cart();
            $cart->items()->delete();
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => $data['quantity'],
                'price' => $product->price,
            ]);

            return redirect()->route('checkout.create');
        }

        $item = $this->cart()->items()->firstOrNew(['product_id' => $product->id]);
        $item->quantity = min($product->stock, ($item->quantity ?? 0) + $data['quantity']);
        $item->price = $product->price;
        $item->save();

        return back()->with('success', 'Produk ditambahkan ke keranjang.');
    }

    public function update(Request $request, CartItem $cartItem)
    {
        abort_unless($cartItem->cart->user_id === auth()->id(), 403);
        $data = $request->validate(['quantity' => ['required', 'integer', 'min:1']]);
        abort_if($data['quantity'] > $cartItem->product->stock, 422, 'Stok tidak mencukupi.');
        $cartItem->update($data);

        return back();
    }

    public function destroy(CartItem $cartItem)
    {
        abort_unless($cartItem->cart->user_id === auth()->id(), 403);
        $cartItem->delete();

        return back();
    }
}
