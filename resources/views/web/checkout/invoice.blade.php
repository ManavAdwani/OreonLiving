<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tax Invoice #{{ $order->order_number }} | Oréon Living</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
            color: #1C1917;
            background: #FFFFFF;
            padding: 40px;
            font-size: 14px;
            line-height: 1.6;
            margin: 0;
        }
        .invoice-box {
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid #E5E7EB;
            padding: 40px;
            border-radius: 8px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 2px solid #1C1917;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .brand-title {
            font-size: 24px;
            font-weight: 700;
            letter-spacing: 0.05em;
        }
        .invoice-meta {
            text-align: right;
            font-size: 13px;
        }
        .addresses-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }
        .addr-block h4 {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #6B7280;
            margin: 0 0 8px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        th {
            background: #F9FAFB;
            text-align: left;
            padding: 10px 12px;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #4B5563;
            border-bottom: 1px solid #E5E7EB;
        }
        td {
            padding: 12px;
            border-bottom: 1px solid #E5E7EB;
        }
        .text-right { text-align: right; }
        .summary-table {
            width: 320px;
            margin-left: auto;
            margin-bottom: 30px;
        }
        .summary-table td {
            padding: 6px 12px;
            border: none;
        }
        .total-row td {
            font-size: 16px;
            font-weight: 700;
            border-top: 1px solid #1C1917;
            padding-top: 10px;
        }
        .footer-note {
            font-size: 12px;
            color: #6B7280;
            text-align: center;
            border-top: 1px solid #E5E7EB;
            padding-top: 20px;
        }
        .print-btn {
            display: block;
            margin: 0 auto 30px;
            background: #1C1917;
            color: #FFFFFF;
            padding: 10px 24px;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            font-weight: 600;
        }
        @media print {
            .print-btn { display: none; }
            .invoice-box { border: none; padding: 0; }
            body { padding: 0; }
        }
    </style>
</head>
<body>
    <button class="print-btn" onclick="window.print()">Print or Save as PDF</button>

    <div class="invoice-box">
        <div class="header">
            <div>
                <div class="brand-title">ORÉON LIVING</div>
                <div style="font-size: 12px; color: #B85D3B; font-weight: 600; letter-spacing: 0.15em;">AUTHENTIC EARTHEN GOODS</div>
                <p style="margin-top: 8px; color: #6B7280; font-size: 12px;">
                    Oréon Living Private Limited<br>
                    42 Pottery Lane, Heritage Crafts District<br>
                    Bengaluru, Karnataka 560001, India<br>
                    GSTIN: 29AABCO1234F1Z8
                </p>
            </div>
            <div class="invoice-meta">
                <h2 style="font-size: 20px; margin: 0 0 5px;">TAX INVOICE</h2>
                <p style="margin: 0; color: #4B5563;">
                    <strong>Invoice No:</strong> INV-{{ $order->order_number }}<br>
                    <strong>Order No:</strong> {{ $order->order_number }}<br>
                    <strong>Date:</strong> {{ $order->created_at->format('d M, Y') }}<br>
                    <strong>Payment:</strong> {{ strtoupper($order->payment_method) }} ({{ ucfirst($order->payment_status) }})
                </p>
            </div>
        </div>

        <div class="addresses-grid">
            <div class="addr-block">
                <h4>Billed / Shipped To:</h4>
                <p style="margin: 0; font-weight: 600;">{{ $order->customer_name }}</p>
                <p style="margin: 4px 0 0; color: #4B5563;">
                    {{ $order->shipping_address['address_line_1'] ?? '' }},<br>
                    {{ $order->shipping_address['address_line_2'] ?? '' }}<br>
                    {{ $order->shipping_address['city'] ?? '' }}, {{ $order->shipping_address['state'] ?? '' }} - {{ $order->shipping_address['postal_code'] ?? '' }}<br>
                    Phone: {{ $order->customer_phone }}<br>
                    Email: {{ $order->customer_email }}
                </p>
            </div>
            <div class="addr-block">
                <h4>Dispatch & Logistics:</h4>
                <p style="margin: 0; color: #4B5563;">
                    <strong>Carrier:</strong> {{ $order->carrier_name ?: 'Express Air Logistics' }}<br>
                    <strong>Tracking No:</strong> {{ $order->tracking_number ?: 'Pending assignment' }}<br>
                    <strong>Order Status:</strong> {{ ucfirst($order->order_status) }}<br>
                    <strong>Tax Category:</strong> Earthen Terracotta Handicrafts (HSN: 691200)
                </p>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Item Description</th>
                    <th>HSN / SKU</th>
                    <th class="text-right">Unit Price</th>
                    <th class="text-right">Qty</th>
                    <th class="text-right">Total (INR)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td>
                            <strong>{{ $item->product_name }}</strong>
                        </td>
                        <td>{{ $item->sku ?: '691200' }}</td>
                        <td class="text-right">₹{{ number_format($item->price, 2) }}</td>
                        <td class="text-right">{{ $item->quantity }}</td>
                        <td class="text-right">₹{{ number_format($item->total, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <table class="summary-table">
            <tr>
                <td>Subtotal:</td>
                <td class="text-right">₹{{ number_format($order->subtotal, 2) }}</td>
            </tr>
            @if($order->discount > 0)
                <tr style="color: #B85D3B;">
                    <td>Coupon Discount:</td>
                    <td class="text-right">&minus; ₹{{ number_format($order->discount, 2) }}</td>
                </tr>
            @endif
            <tr>
                <td>Shipping & Packaging:</td>
                <td class="text-right">{{ $order->shipping_fee == 0 ? 'FREE' : '₹' . number_format($order->shipping_fee, 2) }}</td>
            </tr>
            <tr>
                <td>GST (5% Inclusive):</td>
                <td class="text-right">₹{{ number_format($order->tax, 2) }}</td>
            </tr>
            <tr class="total-row">
                <td>Grand Total:</td>
                <td class="text-right">₹{{ number_format($order->total, 2) }}</td>
            </tr>
        </table>

        <div class="footer-note">
            <p style="margin-bottom: 4px;">Thank you for supporting traditional Indian pottery and sustainable craft.</p>
            <p>This is a computer-generated tax invoice and requires no physical signature.</p>
        </div>
    </div>
</body>
</html>
