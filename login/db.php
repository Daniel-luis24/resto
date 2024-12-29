<?php
$host = 'localhost';
$dbname = 'dewi'; // Ganti dengan nama database Anda
$username = 'root'; // Ganti jika menggunakan username lain
$password = ''; // Ganti dengan password database Anda

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}
?>
