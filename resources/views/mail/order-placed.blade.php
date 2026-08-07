<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation - MeroBazar</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        body {
            margin: 0;
            padding: 0;
            background-color: #f4f1ec;
            font-family: 'Inter', system-ui, sans-serif;
        }

        .email-container {
            max-width: 620px;
            margin: 30px auto;
            background-color: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(135deg, #493628, #8a6f57);
            padding: 40px 30px;
            text-align: center;
            color: #ffffff;
        }

        .header h1 {
            margin: 0;
            font-size: 26px;
            font-weight: 600;
        }

        .header p {
            margin: 6px 0 0;
            color: rgba(255, 255, 255, 0.85);
            font-size: 14px;
        }

        .content {
            padding: 40px;
        }

        h2 {
            color: #1f2937;
            margin: 0 0 8px;
            text-align: center;
        }

        .sub {
            color: #6b7280;
            text-align: center;
            margin: 0 0 28px;
            line-height: 1.6;
        }

        .order-box {
            background: #faf7f2;
            border: 1px solid #e8ddcf;
            border-radius: 12px;
            padding: 20px 24px;
            margin-bottom: 8px;
        }

        .order-row {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            padding: 8px 0;
            border-bottom: 1px dashed #e8ddcf;
            font-size: 14px;
            color: #374151;
        }

        .order-row:last-child {
            border-bottom: none;
        }

        .order-row .label {
            color: #8a6f57;
            font-weight: 600;
            white-space: nowrap;
        }

        .order-row .value {
            text-align: right;
            font-weight: 500;
        }

        table.items {
            width: 100%;
            border-collapse: collapse;
            margin: 24px 0;
        }

        table.items th {
            text-align: left;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: #8a6f57;
            padding: 8px 12px;
            border-bottom: 2px solid #e8ddcf;
        }

        table.items th.amount {
            text-align: right;
        }

        table.items td {
            padding: 10px 12px;
            border-bottom: 1px solid #f0e9de;
            font-size: 14px;
            color: #374151;
        }

        table.items td.qty {
            text-align: center;
            color: #6b7280;
        }

        table.items td.amount {
            text-align: right;
            font-weight: 600;
            color: #1f2937;
            white-space: nowrap;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #faf7f2;
            border-radius: 10px;
            padding: 14px 20px;
        }

        .total-row .label {
            font-weight: 600;
            color: #374151;
        }

        .total-row .amount {
            font-size: 22px;
            font-weight: 700;
            color: #493628;
        }

        .button {
            display: block;
            width: 100%;
            max-width: 280px;
            margin: 30px auto 0;
            background: #493628;
            color: #ffffff !important;
            padding: 15px;
            text-align: center;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 15px;
        }

        .footer {
            background-color: #f8f4ee;
            padding: 28px;
            text-align: center;
            font-size: 13px;
            color: #6b7280;
        }

        .footer p {
            margin: 4px 0;
        }
    </style>
</head>

<body>
    <div class="email-container">


        <div class="content">
            <h2>Thank you for your order!</h2>
            <p class="sub">Your order has been placed successfully. Here are the details:</p>

            <div class="order-box">
                <div class="order-row">
                    <span class="label">Order Number: </span>
                    <span class="value">#{{ $order->id }}</span>
                </div>
                <div class="order-row">
                    <span class="label">Placed On: </span>
                    <span class="value">{{ $order->created_at->format('M d, Y · h:i A') }}</span>
                </div>
                <div class="order-row">
                    <span class="label">Payment Method: </span>
                    <span class="value">{{ $paymentMethodLabel }}</span>
                </div>
                <div class="order-row">
                    <span class="label">Order Status: </span>
                    <span class="value">{{ \Illuminate\Support\Str::ucfirst($order->status ?? 'pending') }}</span>
                </div>
            </div>

            <table class="items">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th style="text-align:center;">Qty</th>
                        <th class="amount">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderItems as $item)
                        <tr>
                            <td>{{ $item->product?->name ?? 'Product' }}</td>
                            <td class="qty">{{ $item->quantity }}</td>
                            <td class="amount">Rs. {{ number_format((float) $item->amount, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="total-row">
                <span class="label">Total Amount: </span>
                <span class="amount">Rs. {{ number_format((float) $order->total_amount, 2) }}</span>
            </div>

        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>MeroBazar</strong> • Pokhara, Nepal</p>
            <p>If you have any questions, contact us at merobazar@gmail.com</p>
        </div>
    </div>
</body>

</html>
