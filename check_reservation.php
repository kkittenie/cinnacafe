<?php
session_start();
include('functions.php'); 
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    
    if (empty($name) || empty($phone)) {
        showAlert("Please fill in all fields.", "error");
    } else {
        $stmt = $conn->prepare("SELECT * FROM reservations WHERE name = ? AND phone_number = ? ORDER BY created_at DESC");
        $stmt->bind_param("ss", $name, $phone);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            // Reservations found
            $_SESSION['reservation_name'] = $name;
            $_SESSION['reservation_phone'] = $phone;
            header("Location: view_reservation_status.php");
            exit();
        } else {
            showAlert("No reservation found with the provided information.", "error");
        }
        
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Check Reservation Status</title>
    <?php echo getAlertStyles(); ?>
    <style>
        /* importing fonts */
        @import url('https://fonts.googleapis.com/css2?family=Miniver&family=Poppins:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap');

        body {
            font-family: "Poppins", serif;
            background: linear-gradient(to right, #e0f2fe, #fff8e1);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        
        .container {
            width: 400px;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .container a {
            display: block;
            text-align: center;
            font-size: small;
            margin-top: 20px;
            cursor: pointer;
            color: rgb(154, 108, 138);
            text-decoration: none;
        }
        
        .container a:hover {
            color: rgb(98, 61, 85);
        }
    
        h2 {
            text-align: center;
            color: rgb(154, 108, 138);
            margin-bottom: 25px;
        }
        
        p.description {
            text-align: center;
            color: #666;
            margin-bottom: 20px;
            font-size: 14px;
        }
        
        input[type="text"], input[type="number"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            font-family: "Poppins", serif;
        }
        
        button {
            width: 100%;
            padding: 12px;
            background-color: #f9f3f7; 
            border: none;
            color: #333;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.3s ease;
            font-family: "Poppins", serif;
            transition: background-color 0.3s ease, transform 0.2s;
        }
        
        button:hover {
            background-color: rgb(238, 205, 227);
            transform: translateY(-2px);
        }
        
        .emoji {
            font-size: 32px;
            margin-bottom: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="emoji">🔍</div>
        <h2>Check Reservation Status</h2>
        <p class="description">Enter your name and phone number to check your reservation status</p>
        
        <?php displayAlert(); ?>
        
        <form method="POST" action="">
            <input type="text" name="name" placeholder="Your name" required>
            <input type="number" name="phone" placeholder="Your phone number" required>
            <button type="submit">Check Status</button>
        </form>
        
        <a href="index.php">Back to Home</a>
    </div>
</body>
</html>