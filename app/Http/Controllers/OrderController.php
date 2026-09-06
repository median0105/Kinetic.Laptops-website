<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Transaction;
use Throwable;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()->latest()->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        abort_unless($order->user_id === auth()->id(), 403);
        $order->load('items');

        return view('orders.show', compact('order'));
    }

    public function paymentSuccess(Order $order)
    {
        abort_unless($order->user_id === auth()->id(), 403);

        if ($order->payment_status === 'paid') {
            return response()->json(['success' => true, 'message' => 'Pembayaran sudah berhasil.']);
        }

        $verified = false;
        $response = null;
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = (bool) config('services.midtrans.is_production');

        try {
            $response = Transaction::status($order->order_number);
            $status = $response->transaction_status ?? null;
            $fraud = $response->fraud_status ?? null;
            $verified = $status === 'settlement' || ($status === 'capture' && $fraud === 'accept');
        } catch (Throwable $e) {
            Log::warning('Midtrans status gagal diverifikasi: '.$e->getMessage(), ['order' => $order->order_number]);
        }

        if (! $verified) {
            return response()->json(['success' => false, 'message' => 'Pembayaran belum terkonfirmasi.'], 422);
        }

        $order->update([
            'midtrans_transaction_id' => $response->transaction_id ?? $order->midtrans_transaction_id,
            'payment_status' => 'paid',
            'order_status' => 'shipped',
            'paid_at' => now(),
        ]);

        return response()->json(['success' => true, 'message' => 'Pembayaran berhasil! Status pesanan Anda sekarang: Dikirim.']);
    }
}
