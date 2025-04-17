<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
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

        .profile-container {
            background: #ffffffdd;
            padding: 40px 30px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            max-width: 480px;
            width: 100%;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .profile-container::before {
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

        .profile-container::after {
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

        h1 {
            color: #a47192;
            font-size: 26px;
            margin-bottom: 10px;
        }

        .info {
            margin: 25px 0;
            text-align: left;
            background-color: #fef6fb;
            border: 1px dashed #eac5dd;
            border-radius: 12px;
            padding: 20px;
            color: #5c4a57;
            font-size: 16px;
        }

        .info p {
            margin: 10px 0;
        }

        a {
            display: inline-block;
            margin-top: 15px;
            padding: 12px 22px;
            background-color: #f6e7f1;
            color: #5c4a57;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.2s;
        }

        a:hover {
            background-color: #eac5dd;
            transform: translateY(-2px);
        }

        .btn-group {
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 25px;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <h1>Hi, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h1>

        <div class="info">
            <p><strong>🆔 Name:</strong> <?php echo htmlspecialchars($_SESSION['name']); ?></p>
            <p><strong>📧 Email:</strong> <?php echo htmlspecialchars($_SESSION['email']); ?></p>
        </div>

        <div class="btn-group">
            <a href="index.php">🏠 Home</a>
            <a href="logout.php">🔓 Logout</a>
        </div>
    </div>
</body>
</html>
