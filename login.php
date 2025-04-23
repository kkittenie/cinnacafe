<?php
session_start();
include('functions.php'); 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <?php echo getAlertStyles(); ?>
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

        .container {
            background: #ffffffdd;
            padding: 40px 30px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 420px;
            position: relative;
            overflow: hidden;
        }

        .container::before {
            content: '';
            position: absolute;
            width: 160px;
            height: 160px;
            background: #ffe5ec;
            border-radius: 50%;
            top: -50px;
            right: -50px;
            z-index: -1;
            opacity: 0.5;
        }

        .container::after {
            content: '';
            position: absolute;
            width: 130px;
            height: 130px;
            background: #cdeacd;
            border-radius: 50%;
            bottom: -40px;
            left: -40px;
            z-index: -1;
            opacity: 0.4;
        }

        h2 {
            text-align: center;
            color: #a47192;
            margin-bottom: 25px;
            font-size: 24px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            font-size: 15px;
            background-color: #fef6fb;
        }

        input:focus {
            border-color: #eac5dd;
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #f6e7f1; 
            border: none;
            color: #5c4a57;
            border-radius: 8px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s;
        }

        button:hover {
            background-color: #eac5dd;
            transform: translateY(-2px);
        }

        .link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }

        .link a {
            color: #a47192;
            text-decoration: none;
            font-weight: 500;
        }

        .link a:hover {
            color: #5c4a57;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php displayAlert(); ?>
        <form action="login_process.php" method="POST">
            <input type="text" name="username" placeholder="Username" required autofocus>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Login</button>
            <div class="link">
                <p>Don't have an account? <a href="register.php">Register here</a></p>
                <a href="index.php">Back to Home</a>
            </div>
        </form>

    </div>
</body>
</html>