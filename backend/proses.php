<?php
require "koneksi.php";

$nama_menu = $_POST['nama_menu'];
$harga = $_POST['harga'];
$kategori = $_POST['kategori'];
$img = $_FILES['img']['name'];
$file_tmp = $_FILES['img']['tmp_name'];

move_uploaded_file($file_tmp, './../gambar/' . $img);

$query = "INSERT INTO menu SET nama_menu='$nama_menu', kategori='$kategori', harga='$harga', img='$img'";
mysqli_query($koneksi, $query) or die;
// mysqli_errno($conn) or die;
header("location:./../tambah-menu.php");
