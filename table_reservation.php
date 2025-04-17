<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Table Reservation</title>
    
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
            text-align: center;
            font-size: small;
            margin-top: 30px;
            cursor: pointer;
            color: rgb(154, 108, 138);
        }
        .container a:hover {
            color: rgb(98, 61, 85);
        }
    
        h2 {
            text-align: center;
            color:rgb(154, 108, 138);
            margin-bottom: 25px;
        }
        input[type="text"], input[type="date"], input[type="time"], input[type="number"] {
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
            background-color:rgb(238, 205, 227);
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Table Reservation</h2>
        <form action="dashboard2.php" method="POST" class="contact-form">
            <input type="text" name="name" placeholder="Your name" class="form-input" required>
            <input type="text" name="phone" placeholder="Your phone number" class="form-input" required>
            <input type="date" name="date" placeholder="Registration date" class="form-input" required>
            <input type="time" name="time" placeholder="Registration time" class="form-input" required>
            <input type="number" name="guests" placeholder="Number of guests" class="form-input" required>
            <button type="submit" class="submit-button">Submit</button>
        </form>
    </div>
</body>
</html>