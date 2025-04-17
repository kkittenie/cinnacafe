<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $date = $_POST['date'] ?? '';
    $time = $_POST['time'] ?? '';
    $guests = $_POST['guests'] ?? '';
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Reservasi</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Miniver&family=Poppins:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap');

        body {
            font-family: "Poppins", sans-serif;
            background: linear-gradient(to right, #e0f2fe, #fff8e1); /* Pastel gradient */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .card {
            background-color: #fff;
            padding: 35px 30px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 450px;
            width: 90%;
            transition: all 0.3s ease-in-out;
        }

        h1 {
            color: #a47192;
            font-size: 28px;
            margin-bottom: 10px;
        }

        h2 {
            color: #c288b4;
            font-size: 20px;
            margin-bottom: 30px;
        }

        .info {
            background-color: #fef6fb;
            border: 1px dashed #eac5dd;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            text-align: left;
        }

        .info p {
            margin: 8px 0;
            color: #5c4a57;
        }

        a {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #f6e7f1;
            color: #5c4a57;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s;
            transition: background-color 0.3s ease, transform 0.2s;
            
        }

        a:hover {
            background-color: #eac5dd;
            transform: translateY(-2px);
        }

        .emoji {
            font-size: 32px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="emoji">🎉🍽️</div>
        <h1>Thanks, <?php echo htmlspecialchars($name); ?>!</h1>
        <h2>Your reservation will be processed.</h2>
        
        <div class="info">
            <p><strong>📞 Phone number:</strong> <?php echo htmlspecialchars($phone); ?></p>
            <p><strong>📅 Reservation date:</strong> <?php echo htmlspecialchars($date); ?></p>
            <p><strong>🕒 Reservation time:</strong> <?php echo htmlspecialchars($time); ?></p>
            <p><strong>👥 Number of guests:</strong> <?php echo htmlspecialchars($guests); ?></p>
        </div>

        <a href="index.php">Back to home</a>
    </div>
</body>
</html>
