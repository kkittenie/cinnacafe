<?php
session_start();
include('config.php');
include('functions.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = '';
    $level = '';
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
                $_SESSION['level'] = $user['level'];

                switch ($user['level']) {
                    case 'admin':
                        header("Location: admin/admin_dashboard.php");
                        break;
                    case 'user':
                        header("Location: dashboard.php");
                        break;
                }
                exit();
            } else {
                showAlert("Password salah. Silakan coba lagi.", "error");
                header("Location: login.php");
                exit();
            }
        } else {
            showAlert("Username tidak ditemukan.", "error");
            header("Location: login.php");
            exit();
        }
        $stmt->close();
    } else if (isset($_POST['register'])) {
        $name = trim($_POST['name']);
        $level = 'user'; 

        // Periksa apakah username atau email sudah digunakan
        $query_check = "SELECT * FROM users WHERE username = ? OR email = ?";
        $stmt_check = $conn->prepare($query_check);
        $stmt_check->bind_param("ss", $username, $email);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($result_check->num_rows > 0) {
            showAlert("Username atau Email sudah digunakan.", "error");
            header("Location: register.php");
            exit();
        }
        $stmt_check->close();

        // Hash password
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Insert user baru
        $query = "INSERT INTO users (name, username, email, level, password) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssss", $name, $username, $email, $level, $password_hash);

        if ($stmt->execute()) {
            $_SESSION['user_id'] = $stmt->insert_id;
            $_SESSION['name'] = $name;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['level'] = $level;
            showAlert("Registrasi berhasil! Selamat datang, " . $name . ".", "success");
            header("Location: user_dashboard.php");
            exit();
        } else {
            showAlert("Gagal menyimpan data: " . $stmt->error, "error");
            header("Location: register.php");
            exit();
        }
        $stmt->close();
    } else {
        showAlert("Aksi tidak valid.", "error");
        header("Location: login.php");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}
?>
