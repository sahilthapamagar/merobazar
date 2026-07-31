<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Registration Rejected</title>
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

        .content {
            padding: 50px 40px;
        }

        .icon-circle {
            width: 80px;
            height: 80px;
            background: #fef2f2;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .icon-circle svg {
            width: 45px;
            height: 45px;
            fill: #ef4444;
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

        .reason-box {
            background-color: #fef2f2;
            border: 2px solid #fca5a5;
            border-radius: 12px;
            padding: 25px;
            margin: 35px 0;
        }

        .reason-box h3 {
            margin: 0 0 12px 0;
            color: #dc2626;
            text-align: center;
            font-size: 18px;
        }

        .reason-text {
            background: white;
            border: 1px solid #fecaca;
            border-radius: 10px;
            padding: 18px 22px;
            font-size: 16px;
            color: #1f2937;
            line-height: 1.6;
        }

        .info-text {
            background: #f8fafc;
            border-radius: 10px;
            padding: 18px 22px;
            margin: 25px 0;
            font-size: 14px;
            color: #64748b;
            text-align: center;
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

        <div class="content">

            <h2>Dear {{ $seller->name }},</h2>
            <p>We regret to inform you that your seller registration request has been reviewed and unfortunately could
                not be approved at this time.</p>

            <!-- Rejection Reason -->
            <div class="reason-box">
                <h3>📋 Reason for Rejection</h3>
                <div class="reason-text">
                    {{ $seller->rejected_reason ?? 'No specific reason provided.' }}
                </div>
            </div>

            <div class="info-text">
                <strong>What's next?</strong><br>
                You may send a Email with the updated information after addressing the above concerns, or contact us for
                further clarification.
            </div>

            <p style="text-align:center; margin-top:30px;">
                We appreciate your interest in joining MeroBazar and wish you the best.
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>MeroBazar</strong> • Pokhara, Nepal</p>
            <p>If you have any questions, contact us at merobazar@gmail.com</p>
        </div>
    </div>
</body>

</html>
