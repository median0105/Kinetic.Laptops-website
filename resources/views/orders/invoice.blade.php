<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Invoice {{ $order->order_number }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: sans-serif; font-size: 12px; color: #333; padding: 30px; }
        .header { display: flex; justify-content: space-between; align-items: flex-start; border-bottom: 3px solid #4f46e5; padding-bottom: 15px; margin-bottom: 20px; }
        .logo { font-size: 22px; font-weight: 800; color: #4f46e5; }
        .title { font-size: 18px; font-weight: 700; margin-bottom: 4px; }
        .subtitle { font-size: 11px; color: #888; }
        .info-grid { display: flex; justify-content: space-between; margin-bottom: 20px; }
        .info-box { width: 48%; }
        .info-box h4 { font-size: 11px; color: #888; text-transform: uppercase; margin-bottom: 5px; }
        .info-box p { font-size: 12px; line-height: 1.6; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th { background: #f1f5f9; text-align: left; padding: 8px 10px; font-size: 11px; text-transform: uppercase; color: #64748b; border-bottom: 2px solid #e2e8f0; }
        td { padding: 8px 10px; border-bottom: 1px solid #f1f5f9; font-size: 12px; }
        .total-row td { font-weight: 700; border-top: 2px solid #e2e8f0; font-size: 14px; }
        .footer { text-align: center; font-size: 10px; color: #aaa; margin-top: 30px; border-top: 1px solid #eee; padding-top: 10px; }
        .badge { display: inline-block; padding: 2px 8px; border-radius: 4px; font-size: 10px; font-weight: 600; }
        .badge-paid { background: #d1fae5; color: #065f46; }
        .badge-pending { background: #fef3c7; color: #92400e; }
    </style>
</head>
<body>
    <div class="header">
        <div>
            <div class="logo">KINETIC</div>
            <div class="subtitle">Laptop Store</div>
        </div>
        <div style="text-align: right;">
            <div class="title">INVOICE</div>
            <div class="subtitle">{{ $order->order_number }}</div>
            <div class="subtitle">{{ $order->created_at->format('d M Y') }}</div>
        </div>
    </div>

    <div class="info-grid">
        <div class="info-box">
            <h4>Dari</h4>
            <p>
                <strong>LaptopStore</strong><br>
                Jl. Teknologi No. 123<br>
                Jakarta Selatan, 12345<br>
                info@laptopstore.com
            </p>
        </div>
        <div class="info-box">
            <h4>Kepada</h4>
            <p>
                <strong>{{ $order->recipient_name }}</strong><br>
                {{ $order->shipping_address }}<br>
                {{ $order->city }}, {{ $order->province }} {{ $order->postal_code }}<br>
                Telp: {{ $order->phone }}
            </p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Produk</th>
                <th>SKU</th>
                <th style="text-align:center">Qty</th>
                <th style="text-align:right">Harga</th>
                <th style="text-align:right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->product_name }}</td>
                    <td>{{ $item->sku }}</td>
                    <td style="text-align:center">{{ $item->quantity }}</td>
                    <td style="text-align:right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td style="text-align:right">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="5" style="text-align:right">Subtotal</td>
                <td style="text-align:right">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="5" style="text-align:right">Ongkir</td>
                <td style="text-align:right">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</td>
            </tr>
            <tr class="total-row">
                <td colspan="5" style="text-align:right">TOTAL</td>
                <td style="text-align:right; color: #4f46e5;">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div style="margin-bottom: 20px;">
        <strong>Status Pembayaran:</strong>
        @if($order->payment_status === 'paid')
            <span class="badge badge-paid">LUNAS</span>
        @else
            <span class="badge badge-pending">BELUM BAYAR</span>
        @endif
    </div>

    <div class="footer">
        Invoice ini secara otomatis dihasilkan oleh sistem. Untuk pertanyaan, hubungi info@laptopstore.com
    </div>
</body>
</html>
