<?php
session_start(); // Mulai session
include "./backend/koneksi.php";

// Ambil data dari session
$name = isset($_SESSION['name']) ? $_SESSION['name'] : 'Data tidak tersedia';
$number = isset($_SESSION['number']) ? $_SESSION['number'] : 'Data tidak tersedia';
$email = isset($_SESSION['email']) ? $_SESSION['email'] : 'Data tidak tersedia';
$payment_method = isset($_SESSION['payment_method']) ? $_SESSION['payment_method'] : 'Data tidak tersedia';
$grand_total = isset($_SESSION['grand_total']) ? $_SESSION['grand_total'] : 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        .container {
            max-width: 700px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 1.5rem;
            margin: 0;
        }

        .table {
            width: 100%;
            margin-bottom: 20px;
        }

        .table th,
        .table td {
            padding: 8px;
            text-align: left;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
        }

        .total {
            font-weight: bold;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
        } 

        img {
            display: block;
            margin: 10px auto;
            max-width: 100%;
            height: auto;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .btn {
            text-decoration: none;
            color: white;
            background-color:rgb(51, 118, 176);
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
        }

        .btn:hover {
            background-color:rgb(0, 103, 194);
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Struk Pembayaran</h1>
        </div>

        <!-- Detail Pemesanan -->
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>Nama</th>
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
                    <th>Total Harga</th>
                    <td>Rp. <?= number_format($grand_total, 0, ',', '.'); ?></td>
                </tr>
            </tbody>
        </table>

        <!-- Menu yang Dipesan -->
        <h5>Menu yang Dipesan</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Menu</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total</th>
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
                    echo "<tr><td colspan='4' class='text-center'>Tidak ada data</td></tr>";
                }
                ?>
                <tr>
                    <td colspan="3" class="text-end total">Total Harga:</td>
                    <td class="total">Rp. <?= number_format($grand_total, 0, ',', '.'); ?></td>
                </tr>
            </tbody>
        </table>

        <!-- Bukti Pembayaran -->
        <h5>Bukti Pembayaran</h5>
        <?php
        if (isset($_SESSION['file_path'])) {
            $file_path = $_SESSION['file_path'];
            if (file_exists($file_path)) {
                echo '<img src="' . htmlspecialchars($file_path) . '" alt="Bukti Pembayaran">';
            } else {
                echo '<p>Bukti pembayaran tidak ditemukan.</p>';
            }
        } else {
            echo '<p>Tidak ada bukti pembayaran yang diupload.</p>';
        }
        ?>

        <div class="footer">
            <a href="transaksi.php" class="btn">Kembali Ke Menu</a>
        </div>
    </div>
</body>

</html>
