<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body { font-family: DejaVu Sans, Arial, sans-serif; color: #222; }
        .header { display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:24px }
        .brand { color:#e11d48; font-weight:700; font-size:18px }
        .meta { text-align:right; font-size:12px; color:#555 }
        table { width:100%; border-collapse:collapse; margin-top:12px }
        th, td { border:1px solid #e6e6e6; padding:10px; font-size:13px }
        th { background:#fafafa; text-align:left }
        .text-right { text-align:right }
        .totals { margin-top:18px; width:300px; float:right }
        .totals table { border:0 }
        .note { margin-top:40px; color:#666; font-size:12px }
    </style>
</head>
<body>
    <div class="header">
        <div>
            <div class="brand">McOrder</div>
            <div style="font-size:12px;color:#666">Nota Pembayaran</div>
            <div style="margin-top:10px;font-size:13px">Vendor<br><strong>{{ $order->vendor_name }}</strong></div>
        </div>
        <div class="meta">
            <div>No: <strong>{{ $order->order_number }}</strong></div>
            <div>{{ $order->created_at ? $order->created_at->format('d/m/Y, H.i.s') : '' }}</div>
            <div style="margin-top:18px">Pembeli<br>-</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Produk</th>
                <th class="text-right">Harga Satuan</th>
                <th class="text-right">Qty</th>
                <th class="text-right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $order->product_name }}</td>
                <td class="text-right">Rp {{ number_format(optional($order)->total_price ? floor($order->total_price / max(1, $order->quantity)) : 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ $order->quantity }}</td>
                <td class="text-right">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="totals">
        <table>
            <tr>
                <td style="border:0;text-align:right">Subtotal</td>
                <td style="border:0;text-align:right">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td style="border:0;text-align:right">Ongkir</td>
                <td style="border:0;text-align:right">Rp 0</td>
            </tr>
            <tr>
                <td style="border:0;text-align:right;font-weight:700">Total</td>
                <td style="border:0;text-align:right;font-weight:700">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
            </tr>
        </table>
    </div>

    <div style="clear:both"></div>

    <div class="note">
        <div>Catatan:</div>
        <div>-</div>
    </div>
</body>
</html>
