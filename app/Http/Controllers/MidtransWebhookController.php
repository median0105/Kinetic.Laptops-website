<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Midtrans\Config;
use Midtrans\Notification;

class MidtransWebhookController extends Controller
{
    public function handle(Request $request)
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$clientKey = config('services.midtrans.client_key');
        Config::$isProduction = (bool) config('services.midtrans.is_production');

        if (! config('services.midtrans.server_key')) {
            return response()->json(['error' => 'Midtrans belum dikonfigurasi.'], 422);
        }

        $notification = new Notification;
        $order = Order::where('order_number', $notification->order_id)->firstOrFail();
        DB::transaction(function () use ($order, $notification) {
            $status = $notification->transaction_status;
            $paid = $status === 'settlement' || ($status === 'capture' && $notification->fraud_status === 'accept');
            $order->update(['midtrans_transaction_id' => $notification->transaction_id] + ($paid ? ['payment_status' => 'paid', 'order_status' => 'shipped', 'paid_at' => now()] : match ($status) {
                'expire' => ['payment_status' => 'expired', 'order_status' => 'cancelled', 'expired_at' => now()],
                'cancel', 'deny', 'failure' => ['payment_status' => 'failed', 'order_status' => 'cancelled'],
                default => ['payment_status' => 'pending'],
            }));
        });

        return response()->json(['received' => true]);
    }
}
