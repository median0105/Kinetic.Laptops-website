<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function download(Order $order)
    {
        abort_unless($order->user_id === auth()->id(), 403);

        $order->load('items');

        $pdf = Pdf::loadView('orders.invoice', compact('order'));

        return $pdf->download("invoice-{$order->order_number}.pdf");
    }
}
