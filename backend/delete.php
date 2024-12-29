<?php
require "koneksi.php";
// untuk di html
$data = mysqli_query($koneksi, "SELECT * FROM menu WHERE id_menu = '$_GET[id_menu]'");
$row = mysqli_fetch_array($data);

// untuk hapus img di folder gambar
$img = $row['img'];
$filePath = './../gambar/' . $img; // Ensure this points to the actual file
if (file_exists($filePath)) {
    unlink($filePath); // This will delete the file
}

// Delete related records in keranjang first
$queryDeleteKeranjang = "DELETE FROM keranjang WHERE id_menu = '$_GET[id_menu]'";
mysqli_query($koneksi, $queryDeleteKeranjang) or die(mysqli_error($koneksi));

// Now delete the menu item
$query = "DELETE FROM menu WHERE id_menu = '$_GET[id_menu]'";
mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

header("location:./../tambah-menu.php");

?>