<?php
session_start();

// Ambil data struk dari sesi jika tersedia
$receipt = $_SESSION['receipt'] ?? null;

// Pastikan $_SESSION['cart'] ada
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Ambil data keranjang
$cartItems = $_SESSION['cart'];

// Hitung total harga keranjang
$totalPrice = 0;
if (count($cartItems) > 0) {
    foreach ($cartItems as $item) {
        $totalPrice += $item['harga'] * $item['jumlah'];
    }
}

// Jika form pembayaran disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'login/db.php';

    // Ambil data dari form
    $paymentMethod = $_POST['payment_method'];
    $tableNumber = $_POST['table_number'] ?? null;
    $user = $_SESSION['username'];

    // Hitung total jumlah item di keranjang
    $totalItems = 0;
    foreach ($cartItems as $item) {
        $totalItems += $item['jumlah'];
    }

    $status = 'Completed'; // Status default transaksi

    try {
        // Simpan transaksi ke database
        $stmt = $pdo->prepare("
            INSERT INTO transactions (user, jumlah, total, status, no_meja, payment_method) 
            VALUES (:user, :jumlah, :total, :status, :no_meja, :payment_method)
        ");
        $stmt->execute([
            ':user' => $user,
            ':jumlah' => $totalItems,
            ':total' => $totalPrice,
            ':status' => $status,
            ':no_meja' => $tableNumber,
            ':payment_method' => $paymentMethod
        ]);

        // Simpan data struk ke sesi
        $_SESSION['receipt'] = [
            'cartItems' => $cartItems,
            'totalPrice' => $totalPrice,
            'paymentMethod' => $paymentMethod,
            'tableNumber' => $tableNumber,
        ];

        // Kosongkan keranjang
        $_SESSION['cart'] = [];

        // Redirect ke halaman pembayaran untuk menampilkan struk
        header('Location: pembayaran.php');
        exit();
    } catch (PDOException $e) {
        die("Gagal menyimpan transaksi: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
    <link rel="stylesheet" href="vendor/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .receipt-box {
            max-width: 500px;
            padding: 20px;
            margin: 30px auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            font-family: 'Arial', sans-serif;
        }
        .receipt-header {
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .receipt-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 16px;
        }
        .receipt-total {
            font-weight: bold;
            font-size: 18px;
            text-align: right;
            margin-top: 20px;
            color: #28a745;
        }
        .back-button {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Struk Pembayaran</h2>

    <?php if ($receipt): ?>
        <div class="receipt-box">
            <div class="receipt-header">Nama Restoran</div>

            <?php if ($receipt['tableNumber']): ?>
                <div class="receipt-item">
                    <span>Nomor Meja:</span>
                    <span><?php echo htmlspecialchars($receipt['tableNumber']); ?></span>
                </div>
            <?php else: ?>
                <div class="receipt-item">
                    <span>Jenis Pesanan:</span>
                    <span>Take Away</span>
                </div>
            <?php endif; ?>

            <div class="receipt-item">
                <span>Metode Pembayaran:</span>
                <span><?php echo htmlspecialchars($receipt['paymentMethod']); ?></span>
            </div>

            <div class="receipt-item">
                <span><strong>Rincian Belanja:</strong></span>
            </div>
            <?php foreach ($receipt['cartItems'] as $item): ?>
                <div class="receipt-item">
                    <span><?php echo htmlspecialchars($item['name']); ?> (x<?php echo $item['jumlah']; ?>)</span>
                    <span><?php echo 'Rp ' . number_format($item['harga'] * $item['jumlah'], 2, ',', '.'); ?></span>
                </div>
            <?php endforeach; ?>

            <div class="receipt-total">
                <span>Total Harga: <?php echo 'Rp ' . number_format($receipt['totalPrice'], 2, ',', '.'); ?></span>
            </div>
        </div>

        <div class="back-button">
            <a href="keranjang.php" class="btn btn-primary">Kembali ke Keranjang</a>
            <a href="transaksi.php" class="btn btn-success">Lanjutkan Belanja</a>
            <a href="cetakpembayaran.php" class="btn btn-success">cetak struk</a>
        </div>
    <?php else: ?>
        <p class="text-center text-danger">Tidak ada data pembayaran. Silakan kembali ke <a href="keranjang.php">Keranjang</a>.</p>
    <?php endif; ?>
</div>

<script src="vendor/bootstrap/bootstrap.min.js"></script>
</body>
</html>

<?php unset($_SESSION['receipt']); ?>
