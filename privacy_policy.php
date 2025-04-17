<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Privacy Policy | CinnaCafe</title>
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
        <h1>Privacy Policy</h1>
        <p><strong>Last updated:</strong> April 17, 2025</p>

        <h2>📌 Introduction</h2>
        <p>Welcome to <strong>CinnaCafe</strong>. We value your privacy and are committed to protecting your personal information. This Privacy Policy explains how we collect, use, and safeguard the information you provide to us.</p>

        <h2>📋 Information We Collect</h2>
        <ul>
            <li>Personal details such as name, email, and phone number</li>
            <li>Order and purchase information if you order online</li>
            <li>Usage data including IP address, browser type, and cookies</li>
        </ul>

        <h2>🔐 How We Use Your Information</h2>
        <ul>
            <li>To manage reservations, orders, or customer requests</li>
            <li>To send special offers, news, or event updates (only with your permission)</li>
            <li>To improve our website and service experience</li>
        </ul>

        <h2>🛡️ Data Security</h2>
        <p>We implement reasonable security measures to protect your data. However, no system is 100% secure, and we cannot guarantee absolute protection.</p>

        <h2>👥 Third-Party Services</h2>
        <p>We may use third-party tools (such as analytics, payment processors, or reservation platforms) that process information on our behalf. These services have their own privacy policies.</p>

        <h2>📄 Your Rights</h2>
        <p>You have the right to access, update, or delete your personal data. To exercise any of these rights, please contact us at the email address below.</p>

        <h2>✏️ Policy Changes</h2>
        <p>We may update this policy from time to time. Any changes will be posted here with the new effective date.</p>

        <h2>📬 Contact Us</h2>
        <p>If you have questions or concerns about this Privacy Policy, you can contact us at:</p>
        <p><strong>Email:</strong> <a href="mailto:info@yourcafename.com">info@cinnacafe.com</a></p>

        <a href="index.php" class="back-link">⬅ Back to Home</a>
    </div>
</body>
</html>
