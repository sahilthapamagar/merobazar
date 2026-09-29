<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MeroBazar Order Status Update</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        body {
            margin: 0;
            padding: 0;
            background-color: #f4f1ec;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            color: #374151;
        }

        .email-container {
            max-width: 620px;
            margin: 30px auto;
            background-color: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border: 1px solid #e8ddcf;
        }

        .header {
            padding: 36px 30px;
            text-align: center;
            color: #ffffff;
        }

        .header.bg-processing {
            background: linear-gradient(135deg, #1e3a8a, #2563eb);
        }

        .header.bg-delivered {
            background: linear-gradient(135deg, #065f46, #059669);
        }

        .header.bg-cancelled {
            background: linear-gradient(135deg, #7f1d1d, #b91c1c);
        }

        .header.bg-pending {
            background: linear-gradient(135deg, #493628, #7a5c43);
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: -0.02em;
        }

        .header p {
            margin: 6px 0 0;
            font-size: 14px;
            opacity: 0.92;
        }

        .content {
            padding: 36px 32px;
        }

        .status-badge-container {
            text-align: center;
            margin-bottom: 24px;
        }

        .status-banner {
            display: inline-block;
            padding: 10px 22px;
            border-radius: 30px;
            font-size: 14px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        .status-processing {
            background: #eff6ff;
            color: #1d4ed8;
            border: 1px solid #bfdbfe;
        }

        .status-delivered {
            background: #ecfdf5;
            color: #047857;
            border: 1px solid #a7f3d0;
        }

        .status-cancelled {
            background: #fef2f2;
            color: #b91c1c;
            border: 1px solid #fecaca;
        }

        .status-pending {
            background: #fefce8;
            color: #a16207;
            border: 1px solid #fef08a;
        }

        .welcome-title {
            color: #1f2937;
            margin: 0 0 8px;
            text-align: center;
            font-size: 19px;
            font-weight: 700;
        }

        .welcome-text {
            color: #6b7280;
            text-align: center;
            margin: 0 0 24px;
            line-height: 1.6;
            font-size: 14px;
        }

        .seller-note {
            background: #faf5ff;
            border-left: 4px solid #9333ea;
            border-radius: 6px;
            padding: 14px 18px;
            margin: 20px 0;
            font-size: 13px;
            color: #581c87;
            line-height: 1.5;
        }

        .order-box {
            background: #faf7f2;
            border: 1px solid #e8ddcf;
            border-radius: 12px;
            padding: 18px 22px;
            margin-bottom: 20px;
        }

        .order-row {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            padding: 8px 0;
            border-bottom: 1px dashed #e8ddcf;
            font-size: 13px;
            color: #374151;
        }

        .order-row:last-child {
            border-bottom: none;
        }

        .order-row .label {
            color: #8a6f57;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            font-size: 12px;
        }

        .order-row .value {
            text-align: right;
            font-weight: 600;
            color: #1f2937;
        }

        table.items {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table.items th {
            text-align: left;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: #8a6f57;
            padding: 8px 10px;
            border-bottom: 2px solid #e8ddcf;
        }

        table.items th.amount {
            text-align: right;
        }

        table.items td {
            padding: 10px 10px;
            border-bottom: 1px solid #f0e9de;
            font-size: 13px;
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

        .total-box {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #faf7f2;
            border-radius: 10px;
            padding: 14px 20px;
            margin: 16px 0 24px;
            border: 1px solid #e8ddcf;
        }

        .total-box .label {
            font-weight: 600;
            color: #374151;
            font-size: 14px;
        }

        .total-box .amount {
            font-size: 20px;
            font-weight: 700;
            color: #493628;
        }

        .btn-track {
            display: block;
            width: fit-content;
            margin: 24px auto 0;
            background: #493628;
            color: #ffffff !important;
            padding: 14px 28px;
            text-align: center;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            box-shadow: 0 4px 12px rgba(73, 54, 40, 0.25);
        }

        .footer {
            background-color: #f8f4ee;
            border-top: 1px solid #e8ddcf;
            padding: 24px;
            text-align: center;
            font-size: 12px;
            color: #8a6f57;
        }

        .footer p {
            margin: 4px 0;
        }
    </style>
</head>

<body>
    @php
        $st = strtolower($status ?? 'pending');
        
        $headerTitle = match($st) {
            'cancelled' => 'Order Cancelled',
            'processing' => 'Order Processing & On The Way',
            'delivered' => 'Order Delivered Successfully',
            default => 'Order Status Update'
        };

        $headerSubtitle = match($st) {
            'cancelled' => "Your order #{$order->id} from {$seller->shop_name} has been cancelled",
            'processing' => "Your order #{$order->id} from {$seller->shop_name} is being processed & on the way",
            'delivered' => "Your order #{$order->id} from {$seller->shop_name} has arrived",
            default => "Your order #{$order->id} from {$seller->shop_name} is pending review"
        };

        $badgeClass = match($st) {
            'cancelled' => 'status-cancelled',
            'processing' => 'status-processing',
            'delivered' => 'status-delivered',
            default => 'status-pending'
        };

        $headerBgClass = match($st) {
            'cancelled' => 'bg-cancelled',
            'processing' => 'bg-processing',
            'delivered' => 'bg-delivered',
            default => 'bg-pending'
        };

        $statusIcon = match($st) {
            'cancelled' => '❌',
            'processing' => '📦',
            'delivered' => '✅',
            default => '⏳'
        };

        $statusLabel = match($st) {
            'cancelled' => 'Order Cancelled',
            'processing' => 'Processing & On The Way',
            'delivered' => 'Delivered',
            default => 'Pending (Order Placed)'
        };

        $messageText = match($st) {
            'cancelled' => "We are writing to notify you that your Order #{$order->id} from {$seller->shop_name} has been cancelled by the seller. If you have already made payment or have questions, please reach out directly to the seller or support.",
            'processing' => "Great news! Your Order #{$order->id} from {$seller->shop_name} is being processed and is currently on its way to your delivery address.",
            'delivered' => "Your Order #{$order->id} from {$seller->shop_name} has been marked as Delivered! Thank you for shopping with MeroBazar. We hope you enjoy your purchase.",
            default => "Your Order #{$order->id} from {$seller->shop_name} is currently pending confirmation from the seller."
        };
    @endphp

    <div class="email-container">
        <!-- Header -->
        <div class="header {{ $headerBgClass }}">
            <h1>{{ $headerTitle }}</h1>
            <p>{{ $headerSubtitle }}</p>
        </div>

        <div class="content">
            <!-- Status Badge -->
            <div class="status-badge-container">
                <span class="status-banner {{ $badgeClass }}">
                    {{ $statusIcon }} Status: {{ $statusLabel }}
                </span>
            </div>

            <h2 class="welcome-title">Hello {{ $user->name ?? 'Customer' }},</h2>
            <p class="welcome-text">
                {{ $messageText }}
            </p>

            @if(!empty($customNote))
                <div class="seller-note">
                    <strong>Message from {{ $seller->shop_name ?? 'Store' }}:</strong><br>
                    {{ $customNote }}
                </div>
            @endif

            <!-- Order Information -->
            <div class="order-box">
                <div class="order-row">
                    <span class="label">Order Number</span>
                    <span class="value">#{{ $order->id }}</span>
                </div>
                <div class="order-row">
                    <span class="label">Order Date</span>
                    <span class="value">{{ $order->created_at->format('M d, Y · h:i A') }}</span>
                </div>
                <div class="order-row">
                    <span class="label">Store / Seller</span>
                    <span class="value">{{ $seller->shop_name ?? $seller->name }}</span>
                </div>
                <div class="order-row">
                    <span class="label">Current Status</span>
                    <span class="value" style="color: {{ $st === 'cancelled' ? '#b91c1c' : ($st === 'delivered' ? '#047857' : ($st === 'processing' ? '#1d4ed8' : '#a16207')) }};">
                        {{ $statusLabel }}
                    </span>
                </div>
                <div class="order-row">
                    <span class="label">Payment Method</span>
                    <span class="value">{{ strtoupper($order->payment_method ?? 'COD') }}</span>
                </div>
                @if($order->user?->deliveryAddresses)
                <div class="order-row">
                    <span class="label">Delivery Address</span>
                    <span class="value">{{ $order->user->deliveryAddresses->address_detail }} ({{ $order->user->deliveryAddresses->contact }})</span>
                </div>
                @endif
            </div>

            <!-- Items Ordered -->
            <table class="items">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th style="text-align:center;">Qty</th>
                        <th class="amount">Price</th>
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

            <!-- Total -->
            <div class="total-box">
                <span class="label">Total Amount:</span>
                <span class="amount">Rs. {{ number_format((float) $order->total_amount, 2) }}</span>
            </div>

            <!-- Action Button -->
            <a href="{{ route('buying-history.show', $order->id) }}" class="btn-track" target="_blank">
                View Live Order Tracking &rarr;
            </a>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>MeroBazar</strong> • Curated Marketplace of Nepal</p>
            <p>If you have any questions or concerns, please contact {{ $seller->email ?? 'support' }}.</p>
        </div>
    </div>
</body>

</html>
