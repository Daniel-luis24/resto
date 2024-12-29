<?php
include "./backend/koneksi.php";

// Check if the form was submitted
if (isset($_POST['order_btn'])) {
    // Retrieve form data
    $name = $_POST['name'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $payment_method = $_POST['payment_method'];

    // Fetch cart items
    $select_cart = mysqli_query($koneksi, "SELECT * FROM `cart`");
    $grand_total = 0;
    $order_details = [];

    if (mysqli_num_rows($select_cart) > 0) {
        while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
            $total_price = $fetch_cart['harga'] * $fetch_cart['jumlah'];
            $grand_total += $total_price;
            $order_details[] = [
                'name' => $fetch_cart['nama_menu'],
                'quantity' => $fetch_cart['jumlah'],
                'price' => $fetch_cart['harga'],
                'total' => $total_price
            ];
        }
    } else {
        echo "<div class='display-order'><span>Cart is empty</span></div>";
        exit;
    }
} else {
    echo "<div class='display-order'><span>No order data found</span></div>";
    exit;
}
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
            background-color: #f8f9fa;
        }
        .receipt {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 50px auto;
            max-width: 600px;
        }
        .heading {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="receipt">
            <h1 class="heading">Struk Pembayaran</h1>
            <p><strong>Nama:</strong> <?= htmlspecialchars($name); ?></p>
            <p><strong>No. Telepon:</strong> <?= htmlspecialchars($number); ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($email); ?></p>
            <p><strong>Metode Pembayaran:</strong> <?= htmlspecialchars($payment_method); ?></p>
            <hr>
            <h5>Detail Pesanan:</h5>
            <ul>
                <?php foreach ($order_details as $item): ?>
                    <li><?= htmlspecialchars($item['name']); ?> (<?= $item['quantity']; ?>) - Rp. <?= number_format($item['total'], 0, ',', '.'); ?></li>
                <?php endforeach; ?>
            </ul>
            <hr>
            <h4>Total Harga: Rp. <?= number_format($grand_total, 0, ',', '.'); ?></h4>
            <p>Terima kasih atas pesanan Anda!</p>
        </div>
    </div>
</body>
</html>