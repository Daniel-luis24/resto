<?php
session_start();
include "./backend/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = $_POST['order_id'];
    $name = $_POST['name'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $payment_method = $_POST['payment_method'];
    $tempat = $_POST['tempat'];
    $grand_total = $_POST['grand_total'];

    // Cek apakah file diupload
    if (isset($_FILES['bukti_pembayaran']) && $_FILES['bukti_pembayaran']['error'] == 0) {
        $file_tmp = $_FILES['bukti_pembayaran']['tmp_name'];
        $file_name = $_FILES['bukti_pembayaran']['name'];
        $file_path = "uploads/" . basename($file_name); // Tentukan folder penyimpanan

        // Pindahkan file ke folder yang diinginkan
        if (move_uploaded_file($file_tmp, $file_path)) {
            // Simpan path file ke session
            $_SESSION['file_path'] = $file_path;

            // Redirect ke struk.php
            header('Location: struk.php');
            exit;
        } else {
            echo "Gagal mengupload file.";
        }
    } else {
        echo "Tidak ada file yang diupload.";
    }
} else {
    // Redirect jika tidak ada data
    header('Location: bayar.php');
    exit;
}
?>