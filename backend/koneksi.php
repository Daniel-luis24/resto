<?php
$host = "localhost";      // Server database
$user = "root";           // Username MySQL
$password = "";           // Password MySQL
$database = "dewi";       // Nama database yang benar

$koneksi = mysqli_connect($host, $user, $password, $database);

if ($koneksi->connect_error) {
    die("Koneksi database gagal: " . $koneksi->connect_error); // Tampilkan error
}
