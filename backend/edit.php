<?php
require "koneksi.php";

if (isset($_POST['submit'])) {
    $id_menu = $_POST['id_menu'];
    $nama_menu = $_POST['nama_menu'];
    $harga = $_POST['harga'];
    $kategori = $_POST['kategori'];
    
    // Handle image upload
    $img = $_FILES['img']['name'];
    $target_dir = './../gambar/';
    $target_file = $target_dir . basename($img);
    
    // Get the current image from the database
    $data = mysqli_query($koneksi, "SELECT * FROM menu WHERE id_menu = '$id_menu'");
    $row = mysqli_fetch_array($data);
    $current_img = $row['img'];

    // Check if an image is uploaded
    if (!empty($img)) {
        // Delete the old image if it exists
        if (file_exists($target_dir . $current_img)) {
            unlink($target_dir . $current_img);
        }

        // Upload the new image
        if (move_uploaded_file($_FILES['img']['tmp_name'], $target_file)) {
            // If upload is successful, set the current image to the new image
            $current_img = $img;
        } else {
            // Handle the error if the upload fails
            die("Error uploading the new image.");
        }
    } 
    // If no new image is uploaded, keep the current image
    // $current_img remains unchanged

    // Update the database with the new values
    $query = "UPDATE menu SET nama_menu='$nama_menu', harga='$harga', kategori='$kategori', img='$current_img' WHERE id_menu='$id_menu'";
    mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

    // Redirect to the menu page
    header("location:./../tambah-menu.php");
}
?>