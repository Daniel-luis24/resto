<?php
require './../backend/koneksi.php'; // Koneksi ke database
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validasi input
    if (empty($username) || empty($password)) {
        $_SESSION['error'] = "Username dan password tidak boleh kosong.";
        header("Location: ./../login/login.php");
        exit;
    }

    // Cek username dan password
    $query = "SELECT id, username, password, role FROM users WHERE username = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Set session
            $_SESSION['id_user'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Arahkan berdasarkan role
            if ($user['role'] == 'admin') {
                header("Location: ./../admin.php");
            } else {
                header("Location: ./../transaksi.php");
            }
            exit;
        } else {
            $_SESSION['error'] = "Username atau password salah.";
            header("Location: ../login/login.php");
            exit;
        }
    } else {
        $_SESSION['error'] = "Username atau password salah.";
        header("Location: ../login/login.php");
        exit;
    }
}
?>