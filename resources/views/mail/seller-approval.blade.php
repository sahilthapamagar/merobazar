<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MeroBazar - Seller Account Details</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        body {
            margin: 0;
            padding: 0;
            background-color: #f4f7fa;
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
            border: 1px solid #e5e7eb;
        }

        .header {
            background: linear-gradient(135deg, #10b981, #059669);
            padding: 36px 30px;
            text-align: center;
            color: #ffffff;
        }

        .header h1 {
            margin: 0;
            font-size: 26px;
            font-weight: 700;
            letter-spacing: -0.02em;
        }

        .header p {
            margin: 8px 0 0 0;
            font-size: 15px;
            color: #ecfdf5;
        }

        .content {
            padding: 40px 32px;
        }

        .welcome-title {
            font-size: 20px;
            font-weight: 700;
            color: #111827;
            margin: 0 0 8px 0;
            text-align: center;
        }

        .welcome-text {
            color: #6b7280;
            font-size: 14px;
            line-height: 1.6;
            text-align: center;
            margin-bottom: 28px;
        }

        .credentials-box {
            background-color: #f8fafc;
            border: 2px solid #10b981;
            border-radius: 12px;
            padding: 24px;
            margin: 20px 0 28px 0;
        }

        .credentials-box h3 {
            margin: 0 0 16px 0;
            color: #065f46;
            font-size: 16px;
            font-weight: 700;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .credential-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            margin-bottom: 12px;
            padding: 12px 16px;
        }

        .credential-row:last-child {
            margin-bottom: 0;
        }

        .cred-label {
            font-size: 13px;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            min-width: 140px;
        }

        .cred-value {
            font-family: 'Courier New', Courier, monospace;
            font-size: 14px;
            font-weight: 600;
            color: #0f172a;
            word-break: break-all;
            text-align: right;
        }

        .cred-value.highlight {
            color: #059669;
            font-weight: 700;
        }

        .cred-value.khalti {
            color: #6366f1;
            font-weight: 700;
        }

        .cta-btn {
            display: block;
            width: fit-content;
            margin: 24px auto;
            background: linear-gradient(135deg, #10b981, #059669);
            color: #ffffff !important;
            padding: 14px 32px;
            text-align: center;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 15px;
            box-shadow: 0 4px 14px rgba(16, 185, 129, 0.35);
        }

        .note-card {
            background: #f0fdf4;
            border-left: 4px solid #10b981;
            padding: 14px 18px;
            border-radius: 6px;
            margin: 24px 0;
            font-size: 13px;
            color: #166534;
            line-height: 1.5;
        }

        .footer {
            background-color: #f8fafc;
            border-top: 1px solid #e2e8f0;
            padding: 24px;
            text-align: center;
            font-size: 13px;
            color: #94a3b8;
        }

        .footer p {
            margin: 4px 0;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <h1>MeroBazar Seller Portal</h1>
            <p>Your Account Details & Access Credentials</p>
        </div>

        <div class="content">
            <h2 class="welcome-title">Hello {{ $seller->name }},</h2>
            <p class="welcome-text">
                Your seller account for <strong>{{ $seller->shop_name ?? 'your store' }}</strong> has been configured by the admin. Below are your login credentials and Khalti payment gateway key.
            </p>

            <!-- Credentials Box -->
            <div class="credentials-box">
                <h3>Account & Credentials Details</h3>

                <div class="credential-row">
                    <span class="cred-label">Shop Name</span>
                    <span class="cred-value">{{ $seller->shop_name ?? $seller->name }}</span>
                </div>

                <div class="credential-row">
                    <span class="cred-label">Login Username / Email</span>
                    <span class="cred-value highlight">{{ $seller->email }}</span>
                </div>

                <div class="credential-row">
                    <span class="cred-label">Account Password</span>
                    <span class="cred-value highlight">{{ $password }}</span>
                </div>

                <div class="credential-row">
                    <span class="cred-label">Khalti Secret Key</span>
                    <span class="cred-value khalti">{{ $khaltiKey ?: ($seller->khalti_secrect_key ?: 'Not Set') }}</span>
                </div>

                @if($seller->expired_date)
                <div class="credential-row">
                    <span class="cred-label">Valid Until</span>
                    <span class="cred-value">{{ $seller->expired_date }}</span>
                </div>
                @endif
            </div>

            <!-- Login CTA Button -->
            <a href="{{ url('/seller/login') }}" class="cta-btn" target="_blank">
                Login to Seller Dashboard &rarr;
            </a>

            <div class="note-card">
                <strong>🔒 Security & Payment Notice:</strong>
                <ul style="margin: 6px 0 0 0; padding-left: 18px;">
                    <li>Keep your login credentials and Khalti Secret Key confidential.</li>
                    <li>You can change your password anytime directly in your seller profile.</li>
                    <li>Your Khalti Secret Key is used to receive customer payments on MeroBazar.</li>
                </ul>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>MeroBazar</strong> • Pokhara, Nepal</p>
            <p>If you have any questions, please contact admin support.</p>
        </div>
    </div>
</body>

</html>
