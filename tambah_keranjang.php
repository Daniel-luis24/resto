<?php
// Memulai sesi jika belum dimulai
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Pastikan $_SESSION['cart'] ada
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Data item baru yang akan ditambahkan (dikirim melalui formulir atau request POST)
$newItem = [
    'name' => $_POST['name'], // Nama produk dari form
    'harga' => (float) $_POST['harga'], // Harga produk dari form
    'jumlah' => (int) $_POST['jumlah'], // Jumlah produk dari form
];

// Flag untuk mengecek apakah item sudah ada di keranjang
$itemExists = false;

// Periksa apakah produk sudah ada di keranjang
foreach ($_SESSION['cart'] as &$item) {
    if ($item['name'] === $newItem['name']) {
        // Jika produk sudah ada, tambahkan jumlahnya
        $item['jumlah'] += $newItem['jumlah'];
        $itemExists = true;
        break;
    }
}

// Jika item belum ada, tambahkan sebagai item baru
if (!$itemExists) {
    $_SESSION['cart'][] = $newItem;
}

// Redirect kembali ke halaman keranjang
header("Location: keranjang.php");
exit;
