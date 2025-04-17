<?php
session_start();
include('functions.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    if (empty($name) || empty($username) || empty($email) || empty($password)) {
        showAlert("Semua field harus diisi.", "error");
        header("Location: register.php");
        exit();
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        showAlert("Format email tidak valid.", "error");
        header("Location: register.php");
        exit();
    }
    
    if (strlen($password) < 6) {
        showAlert("Password harus terdiri dari minimal 6 karakter.", "error");
        header("Location: register.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Confirm Register</title>
    <?php echo getAlertStyles();  ?>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Miniver&family=Poppins:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap');

        body {
            font-family: "Poppins", serif;
            background: linear-gradient(to right, #e0f2fe, #fff8e1); /* Biru dan Kuning Pastel */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            width: 400px;
            padding: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color:rgb(142, 162, 169);
            margin-bottom: 25px;
        }
        .data {
            margin: 20px 0;
            padding: 15px;
            background-color: #f9f3f7;
            border: 1px solid #f9f3f7;
            border-radius: 5px;
        }
        .buttons {
            display: flex;
            justify-content: space-between;
        }
        button {
            padding: 12px 20px;
            width: 48%;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }
        .confirm {
            background-color:rgb(202, 213, 218);
            color: #333;
        }
        .edit {
            background-color: rgb(202, 213, 218); /* Biru Pastel */
            color: #333;
        }
        button:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Confirm Register Data</h2>
        <?php displayAlert(); ?>
        <div class="data">
            <p><strong>Name:</strong> <?php echo htmlspecialchars($name); ?></p>
            <p><strong>Username:</strong> <?php echo htmlspecialchars($username); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
        </div>
        <form action="login_process.php" method="POST">
            <input type="hidden" name="name" value="<?php echo htmlspecialchars($name); ?>">
            <input type="hidden" name="username" value="<?php echo htmlspecialchars($username); ?>">
            <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
            <input type="hidden" name="password" value="<?php echo htmlspecialchars($password); ?>">
            <div class="buttons">
                <button type="button" class="edit" onclick="window.history.back();">Edit Data</button>
                <button type="submit" name="register" class="confirm">Confirm</button>
            </div>
        </form>
    </div>
</body>
</html>