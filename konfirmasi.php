<?php
include "./backend/koneksi.php";
session_start(); // Pastikan session sudah dimulai

// Inisialisasi variabel
$name = '';
$number = '';
$email = '';
$payment_method = '';
$tempat = '';
$grand_total = 0; // Inisialisasi grand_total dengan 0

// Cek apakah form dikirim dari bayar.php
if (isset($_POST['order_btn'])) {
    $name = $_POST['name'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $payment_method = $_POST['payment_method'];
    $tempat = $_POST['tempat'];
    $grand_total = $_POST['grand_total']; // Ambil grand_total dari POST
    // validasi input
    if (empty($name) || empty($number) || empty($email) || empty($payment_method) || empty($tempat) || empty($grand_total)) {
        echo "<script>alert('Semua field harus diisi!'); window.location.href='bayar.php';</script>";
        exit;
    }
    // Simpan data ke session
    $_SESSION['name'] = $name; // Pastikan ini ada
    $_SESSION['number'] = $number; // Pastikan ini ada
    $_SESSION['email'] = $email; // Pastikan ini ada
    $_SESSION['payment_method'] = $payment_method; // Pastikan ini ada
    $_SESSION['grand_total'] = $grand_total; // Pastikan ini ada
    //Setelah berhasil menyimpan data pembayaran
    if (isset($_FILES['bukti_pembayaran']) && $_FILES['bukti_pembayaran']['error'] == 0) {
        $file_path = 'path/to/upload/directory/' . $_FILES['bukti_pembayaran']['name']; // Sesuaikan dengan path upload Anda
        move_uploaded_file($_FILES['bukti_pembayaran']['tmp_name'], $file_path);
        $_SESSION['file_path'] = $file_path; // Simpan file path di session

        // Simpan file path ke database
        $query = "UPDATE pembayaran SET bukti_pembayaran = ? WHERE id = ?";
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param("si", $file_path, $order_id); // Ganti $order_id dengan ID yang sesuai
        $stmt->execute();
        $stmt->close();
    }
    // Prepare the SQL statement to prevent SQL injection
    $query = "INSERT INTO pembayaran (name, number, email, payment_method, tempat, grand_total) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $koneksi->prepare($query);

    // Cek apakah persiapan pernyataan berhasil
    if ($stmt === false) {
        die('Error preparing statement: ' . htmlspecialchars($koneksi->error));
    }

    $stmt->bind_param("sssssi", $name, $number, $email, $payment_method, $tempat, $grand_total);

    // Execute the query
    if ($stmt->execute()) {
        // Jika berhasil, simpan ID pembayaran untuk digunakan nanti
        $order_id = $stmt->insert_id; // Ambil ID pembayaran yang baru saja dibuat

        // Set notifikasi ke session
        $_SESSION['notification'] = "Pemesanan berhasil! ID Pemesanan: " . $order_id;
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
} else {
    // Redirect jika tidak ada data
    header('Location: bayar.php');
    exit;
}

// Ambil detail menu dari cart berdasarkan order_id
$cart_query = "SELECT * FROM cart WHERE id_cart = ?";
$cart_stmt = $koneksi->prepare($cart_query);
$cart_stmt->bind_param("i", $order_id); // Ganti dengan ID yang sesuai
$cart_stmt->execute();
$cart_result = $cart_stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        .container {
            max-width: 900px;
            margin-top: 30px;
        }

        .card {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(10, 10, 10, 0.1);
        }

        .card-header {
            background-color: rgb(214, 222, 230);
            font-size: 1.2rem;
            padding: 15px;
            text-align: center;
        }

        .card-body {
            padding: 20px;
        }

        .table {
            margin-top: 20px;
        }

        .btn-primary {
            background-color: rgb(51, 118, 176);
            border: none;
        }

        .btn-primary:hover {
            background-color: rgb(13, 149, 253);
        }

        .list-group-item {
            background-color: #f8f9fa;
            border: none;
        }

        .text-center {
            font-weight: 500;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center mb-5">Konfirmasi Pembayaran</h1>
        <div class="card">
            <div class="card-header">
                Metode Pembayaran Transfer
            </div>
            <div class="card-body">
                <p class="text-center">Silakan transfer ke salah satu rekening berikut:</p>
                <ul class="list-group">
                    <li class="list-group-item">Mandiri: <strong>292263415</strong></li>
                    <li class="list-group-item">BRI: <strong>292263415</strong></li>
                    <li class="list-group-item">BCA: <strong>292263415</strong></li>
                </ul>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <strong>Detail Pemesanan</strong>
            </div>
            <div class="card-body">
                <!-- Tabel Detail Pemesanan -->
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th style="width: 30%;">Nama</th>
                            <td><?= htmlspecialchars($name); ?></td>
                        </tr>
                        <tr>
                            <th>No. Telepon</th>
                            <td><?= htmlspecialchars($number); ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?= htmlspecialchars($email); ?></td>
                        </tr>
                        <tr>
                            <th>Metode Pembayaran</th>
                            <td><?= htmlspecialchars($payment_method); ?></td>
                        </tr>
                        <tr>
                            <th>Tempat</th>
                            <td><?= htmlspecialchars($tempat); ?></td>
                        </tr>
                        <tr>
                            <th>Total Harga</th>
                            <td><strong>Rp. <?= number_format($grand_total, 0, ',', '.'); ?></strong></td>
                        </tr>
                    </tbody>
                </table>

                <!-- Detail Menu yang Dipesan -->
                <h5 class="mt-4">Detail Menu yang Dipesan</h5>
                <table class="table table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Menu</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $select_cart = mysqli_query($koneksi, "SELECT * FROM `cart`");
                        $grand_total = 0;

                        if (mysqli_num_rows($select_cart) > 0) {
                            while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                                $total_price = $fetch_cart['harga'] * $fetch_cart['jumlah'];
                                $grand_total += $total_price;
                        ?>
                                <tr>
                                    <td><?= htmlspecialchars($fetch_cart['nama_menu']); ?></td>
                                    <td><?= $fetch_cart['jumlah']; ?></td>
                                    <td>Rp. <?= number_format($fetch_cart['harga'], 0, ',', '.'); ?></td>
                                    <td>Rp. <?= number_format($total_price, 0, ',', '.'); ?></td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo "<tr><td colspan='4' class='text-center'>Belum ada menu yang dipesan.</td></tr>";
                        }
                        ?>
                        <tr class="table-light">
                            <td colspan="3" class="text-end"><strong>Total Harga:</strong></td>
                            <td><strong>Rp. <?= number_format($grand_total, 0, ',', '.'); ?></strong></td>
                        </tr>
                    </tbody>
                </table>

                <!-- Upload Bukti Pembayaran -->
                <h5 class="mt-4">Upload Bukti Pembayaran</h5>
                <?php if ($payment_method === 'transfer') : ?>
                    <form action="upload_bukti.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="order_id" value="<?= $order_id; ?>">
                        <input type="hidden" name="name" value="<?= htmlspecialchars($name); ?>">
                        <input type="hidden" name="number" value="<?= htmlspecialchars($number); ?>">
                        <input type="hidden" name="email" value="<?= htmlspecialchars($email); ?>">
                        <input type="hidden" name="payment_method" value="<?= htmlspecialchars($payment_method); ?>">
                        <input type="hidden" name="tempat" value="<?= htmlspecialchars($tempat); ?>">
                        <input type="hidden" name="grand_total" value="<?= $grand_total; ?>">
                        <div class="mb-3">
                            <label for="bukti_pembayaran" class="form-label">Pilih File Bukti Pembayaran</label>
                            <input type="file" class="form-control" id="bukti_pembayaran" name="bukti_pembayaran" required>
                        </div>
                        <button type="submit" class="btn btn-success">Upload</button>                      
                        <button type="button" class="btn btn-danger" onclick="window.location.href = 'bayar.php';">Kembali</button>
                    </form>
                <?php else : ?>
                    <p>Anda telah memilih metode pembayaran CASH. Tidak perlu mengupload bukti pembayaran.</p>
                    <!-- Tombol Lanjutkan -->
                    <div class="mt-4 text-center">
                        <a href="struk.php" class="btn btn-primary">Lanjutkan</a>
                        <button type="button" class="btn btn-danger mt-3" onclick="window.location.href = 'keranjang.php';">Kembali</button>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>