<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Services\MidtransService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Throwable;

class CheckoutController extends Controller
{
    public function create()
    {
        $cart = Cart::where('user_id', auth()->id())->with('items.product')->first();

        if (! $cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('success', 'Keranjang masih kosong, silakan tambahkan produk terlebih dahulu.');
        }

        return view('checkout.create', compact('cart'));
    }

    public function store(CheckoutRequest $request, MidtransService $midtrans)
    {
        if (! $midtrans->isConfigured()) {
            return back()->withErrors(['payment' => 'Konfigurasi pembayaran belum lengkap. Silakan hubungi administrator.']);
        }

        try {
            [$order, $token] = DB::transaction(function () use ($request, $midtrans) {
                $cart = Cart::where('user_id', auth()->id())->with('items.product')->lockForUpdate()->first();
                abort_if(! $cart || $cart->items->isEmpty(), 422, 'Keranjang kosong.');

                $subtotal = 0;
                foreach ($cart->items as $item) {
                    abort_if($item->quantity > $item->product->stock, 422, "Stok {$item->product->name} tidak mencukupi.");
                    $subtotal += $item->price * $item->quantity;
                }

                $order = Order::create([
                    'user_id' => auth()->id(),
                    'order_number' => 'LAP-'.strtoupper(Str::random(10)),
                    'subtotal' => $subtotal,
                    'shipping_cost' => 0,
                    'total_amount' => $subtotal,
                    'payment_method' => 'midtrans',
                    'payment_status' => 'pending',
                    'order_status' => 'pending',
                    'recipient_name' => $request->recipient_name,
                    'phone' => $request->phone,
                    'shipping_address' => $request->shipping_address,
                    'city' => $request->city,
                    'province' => $request->province,
                    'postal_code' => $request->postal_code,
                ]);

                foreach ($cart->items as $item) {
                    $order->items()->create([
                        'product_id' => $item->product_id,
                        'product_name' => $item->product->name,
                        'sku' => $item->product->sku,
                        'quantity' => $item->quantity,
                        'price' => $item->price,
                        'subtotal' => $item->price * $item->quantity,
                    ]);
                    $item->product->decrement('stock', $item->quantity);
                }

                $token = $midtrans->createSnapToken([
                    'transaction_details' => [
                        'order_id' => $order->order_number,
                        'gross_amount' => (int) $order->total_amount,
                    ],
                    'customer_details' => [
                        'first_name' => $order->recipient_name,
                        'phone' => $order->phone,
                    ],
                    'item_details' => $order->items->map(fn ($i) => [
                        'id' => (string) $i->product_id,
                        'price' => (int) $i->price,
                        'quantity' => $i->quantity,
                        'name' => $i->product_name,
                    ])->all(),
                ]);

                $order->update(['payment_token' => $token]);

                $cart->items()->delete();

                return [$order->load('items'), $token];
            });
        } catch (Throwable $e) {
            if ($e instanceof HttpExceptionInterface) {
                throw $e;
            }

            Log::warning('Midtrans snap token gagal dibuat: '.$e->getMessage(), ['user' => auth()->id()]);
            report($e);

            return back()->withErrors(['payment' => 'Terjadi kesalahan saat memproses pembayaran. Silakan coba lagi.']);
        }

        return redirect()->route('orders.show', $order)->with('snap_token', $token);
    }
}
