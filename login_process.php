<?php
session_start();
include('config.php');
include('functions.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = '';
    $username = trim($_POST['username']);
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'];

    // Cek apakah ini proses login atau registrasi
    if (isset($_POST['login'])) {
        // LOGIN PROCESS
        $query = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['name'] = $user['name'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['user_id'] = $user['id'];
                header("Location: dashboard.php");
                exit();
            } else {
                showAlert("Password invalid. Try again.", "error");
                header("Location: login.php");
                exit();
            }
        } else {
            showAlert("Username invalid.", "error");
            header("Location: login.php");
            exit();
        }
        $stmt->close();
    } else if (isset($_POST['register'])) {
        $name = trim($_POST['name']);
        // REGISTER PROCESS

        // Periksa apakah username atau email sudah digunakan
        $query_check = "SELECT * FROM users WHERE username = ? OR email = ?";
        $stmt_check = $conn->prepare($query_check);
        $stmt_check->bind_param("ss", $username, $email);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($result_check->num_rows > 0) {
            showAlert("Username or Email already used.", "error");
            header("Location: register.php");
            exit();
        }
        $stmt_check->close();

        // Hash password
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Insert user baru
        $query = "INSERT INTO users (name, username, email, password) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssss", $name, $username, $email, $password_hash);

        if ($stmt->execute()) {
            $_SESSION['user_id'] = $stmt->insert_id;
            $_SESSION['name'] = $name;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            showAlert("Registration succeed! Welcome, " . $name . ".", "success");
            header("Location: dashboard.php");
            exit();
        } else {
            showAlert("Can't save data: " . $stmt->error, "error");
            header("Location: register.php");
            exit();
        }
        $stmt->close();
    } else {
        showAlert("Action invalid.", "error");
        header("Location: login.php");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}
?>