<?php
include "./backend/koneksi.php";
session_start();

// Cek apakah ada data yang dikirim
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];

    // Update status pesanan di database
    $query = "UPDATE pembayaran SET status = 'Diterima' WHERE id = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("i", $order_id);

    if ($stmt->execute()) {
         // Set notifikasi ke session
        $_SESSION['notification'] = "Pesanan berhasil ditandai sebagai diterima!";
    } else {
        $_SESSION['notification'] = "Gagal memperbarui status pesanan: " . $stmt->error;
    }
    $stmt->close();
} else {
    $_SESSION['notification'] = "Tidak ada ID pesanan yang diterima.";
}

// Redirect kembali ke halaman pesanan
header('Location: pesanan.php');
exit;
?>