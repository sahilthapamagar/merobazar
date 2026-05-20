<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Account Approved - Login Credentials</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap');

        body {
            margin: 0;
            padding: 0;
            background-color: #f4f7fa;
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
            background: linear-gradient(135deg, #10b981, #059669);
            padding: 40px 30px;
            text-align: center;
            color: white;
        }

        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
        }

        .content {
            padding: 50px 40px;
        }

        .success-icon {
            width: 80px;
            height: 80px;
            background: #ecfdf5;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .success-icon svg {
            width: 45px;
            height: 45px;
            fill: #10b981;
        }

        h2 {
            text-align: center;
            color: #1f2937;
            margin: 0 0 8px 0;
        }

        p {
            color: #4b5563;
            line-height: 1.7;
            text-align: center;
        }

        .credentials-box {
            background-color: #f8fafc;
            border: 2px solid #10b981;
            border-radius: 12px;
            padding: 25px;
            margin: 35px 0;
        }

        .form-row {
            display: flex;
            align-items: center;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            margin-bottom: 15px;
            padding: 14px 18px;
        }

        .label {
            width: 140px;
            font-weight: 600;
            color: #374151;
        }

        .value {
            flex: 1;
            font-family: 'Courier New', monospace;
            font-size: 16px;
            color: #1f2937;
            word-break: break-all;
        }

        .copy-btn {
            background: #10b981;
            color: white;
            border: none;
            padding: 8px 14px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
        }

        .button {
            display: block;
            width: 100%;
            max-width: 280px;
            margin: 30px auto;
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 16px;
            text-align: center;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 17px;
        }

        .warning {
            background: #fef3c7;
            color: #92400e;
            padding: 15px;
            border-radius: 10px;
            font-size: 14px;
            text-align: center;
            margin: 25px 0;
        }

        .footer {
            background-color: #f8fafc;
            padding: 30px;
            text-align: center;
            font-size: 14px;
            color: #64748b;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <h1>✅ Seller Account Approved</h1>
        </div>

        <div class="content">
            <div class="success-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z" />
                </svg>
            </div>

            <h2>Congratulations, {{ $seller->name }}</h2>
            <p>Your seller account has been successfully approved.</p>

            <!-- Credentials Form-like Box -->
            <div class="credentials-box">
                <h3 style="margin-top:0; color:#10b981; text-align:center;">Your Login Credentials</h3>

                <div class="form-row">
                    <div class="label">Email Address</div>
                    <div class="value">{{ $seller->email }}</div>
                    {{-- <button class="copy-btn" onclick="copyToClipboard('{{ $seller->email }}')">Copy</button> --}}
                </div>

                <div class="form-row">
                    <div class="label">Password</div>
                    <div class="value"> {{ $password }}</div>
                    {{-- <button class="copy-btn" onclick="copyToClipboard('{{ $password ?? '' }}')">Copy</button> --}}
                </div>
            </div>

            <div class="warning">
                <strong>Security Note:</strong> Please change your password after your first login for better security.
            </div>

            <a href="" class="button" target="_blank">
                Login to Seller Dashboard
            </a>

            <p style="text-align:center; margin-top:30px;">
                You can now start adding products and manage your store.
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>Mero Bazar</strong> • Pokhara, Nepal</p>
            <p>If you have any questions, contact us at merobazar@gmail.com</p>
        </div>
    </div>

    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                alert('Copied to clipboard!');
            });
        }
    </script>
</body>

</html>
