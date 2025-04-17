<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Refund Policy | CinnaCafe</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Miniver&family=Poppins:wght@400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f8edeb, #d8e2dc, #fcd5ce, #fae1dd);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .policy-container {
            background: #ffffffdd;
            padding: 40px 30px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            max-width: 760px;
            width: 100%;
            color: #5c4a57;
            position: relative;
            overflow: hidden;
        }

        .policy-container::before {
            content: '';
            position: absolute;
            width: 180px;
            height: 180px;
            background: #ffe5ec;
            border-radius: 50%;
            top: -60px;
            right: -60px;
            z-index: -1;
            opacity: 0.5;
        }

        .policy-container::after {
            content: '';
            position: absolute;
            width: 140px;
            height: 140px;
            background: #cdeacd;
            border-radius: 50%;
            bottom: -40px;
            left: -40px;
            z-index: -1;
            opacity: 0.4;
        }

        h1, h2 {
            color: #a47192;
            margin-bottom: 14px;
        }

        p, li {
            font-size: 15px;
            line-height: 1.6;
            margin-bottom: 12px;
        }

        ul {
            margin-left: 20px;
        }

        a.back-link {
            display: inline-block;
            margin-top: 25px;
            padding: 12px 22px;
            background-color: #f6e7f1;
            color: #5c4a57;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.2s;
        }

        a.back-link:hover {
            background-color: #eac5dd;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="policy-container">
        <h1>Refund Policy</h1>
        <p><strong>Last updated:</strong> April 17, 2025</p>

        <h2>📦 Order Cancellations</h2>
        <p>We accept cancellations within <strong>2 hours</strong> of placing an order. To cancel, please contact us immediately at <a href="mailto:info@yourcafename.com">info@yourcafename.com</a>.</p>

        <h2>💸 Refund Eligibility</h2>
        <p>Refunds are available under the following conditions:</p>
        <ul>
            <li>The order was incorrect or incomplete due to our mistake.</li>
            <li>The item arrived damaged or spoiled (please provide a photo within 24 hours).</li>
            <li>You contacted us within the allowed time frame.</li>
        </ul>

        <h2>📅 Non-Refundable Items</h2>
        <p>Please note that we do not offer refunds for:</p>
        <ul>
            <li>Digital gift cards or vouchers once delivered</li>
            <li>Change of mind after order preparation</li>
            <li>Orders that are not picked up or delivered due to customer unavailability</li>
        </ul>

        <h2>⏱️ Processing Time</h2>
        <p>If your refund is approved, we will process it within <strong>5–7 business days</strong>. The refund will be applied to your original method of payment.</p>

        <h2>📬 Contact Us</h2>
        <p>If you have questions or need help with a refund request, feel free to reach out:</p>
        <p><strong>Email:</strong> <a href="mailto:info@yourcafename.com">info@cinnacafe.com</a><br>

        <a href="index.php" class="back-link">⬅ Back to Home</a>
    </div>
</body>
</html>
