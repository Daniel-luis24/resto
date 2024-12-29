<?php
// Memulai sesi
session_start();
require "./backend/koneksi.php";


// Periksa apakah nama produk diterima melalui parameter GET
$query = "DELETE FROM menu WHERE id_menu = '$_GET[id_menu]'";
mysqli_query($koneksi, $query) or die; 

if (isset($_GET['id_menu'])) {
    $productName = urldecode($_GET['nama_menu']); // Mendapatkan nama produk dari parameter GET

    // Periksa apakah keranjang ada dan memiliki item
    if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
        // Loop melalui keranjang untuk menemukan item yang sesuai
        foreach ($_SESSION['cart'] as $index => $query) {
            if ($query['nama_menu'] === $productName) {
                // Menghapus item dari keranjang
                unset($_SESSION['cart'][$index]);
                // Reindex array setelah penghapusan
                $_SESSION['cart'] = array_values($_SESSION['cart']);
                break; // Keluar dari loop setelah menemukan item
            }
        }
    }
}

// Redirect kembali ke halaman keranjang setelah penghapusan
header('Location: keranjang.php');
exit();
?>
