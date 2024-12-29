<?php
include "./backend/koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Metode Pembayaran</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Style -->
    <style>
        body {
            background-color: #f0f4f8;
            font-family: 'Arial', sans-serif;
        }

        .checkout-form {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 50px auto;
            max-width: 600px;
        }

        .checkout-form h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 1.8rem;
            color: #333;
        }

        .inputBox {
            margin-bottom: 15px;
        }

        .inputBox span {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .grand-total {
            font-size: 1.3rem;
            font-weight: bold;
            color: #28a745;
            margin-top: 15px;
            text-align: center;
        }

        #bankInfo {
            background: #e9f7ef;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
            font-size: 0.9rem;
            color: #333;
        }

        #bankInfo p {
            margin: 8px 0;
        }

        #bankInfo i {
            cursor: pointer;
            color: #007bff;
        }

        .btn-primary {
            width: 100%;
            padding: 12px;
            font-size: 1rem;
            border-radius: 5px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        select.form-select {
            font-size: 1rem;
        }

        .order-summary {
            font-size: 0.95rem;
            color: #555;
        }

        .order-summary span {
            display: block;
        }
    </style>
</head>

<body>
    <div class="container">
        <section class="checkout-form">
            <h1 class="heading">Metode Pembayaran</h1>

            <form action="konfirmasi.php" method="post">
                <!-- Order Summary -->
                <div class="order-summary">
                    <h5>Ringkasan Pesanan:</h5>
                    <?php
                    $select_cart = mysqli_query($koneksi, "SELECT * FROM `cart`");
                    $grand_total = 0;

                    if (mysqli_num_rows($select_cart) > 0) {
                        while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                            $total_price = $fetch_cart['harga'] * $fetch_cart['jumlah'];
                            $grand_total += $total_price;
                    ?>
                            <span><?= htmlspecialchars($fetch_cart['nama_menu']); ?> (<?= $fetch_cart['jumlah']; ?>) - Rp. <?= number_format($total_price, 0, ',', '.'); ?></span>
                    <?php
                        }
                    } else {
                        echo "<span>Tidak ada pesanan ditemukan.</span>";
                    }
                    ?>
                    <span class="grand-total">Total: Rp. <?= number_format($grand_total, 0, ',', '.'); ?></span>
                </div>

                <!-- Hidden Inputs -->
                <input type="hidden" name="grand_total" value="<?= $grand_total; ?>">

                <!-- Input Fields -->
                <div class="inputBox">
                    <span>Nama</span>
                    <input type="text" class="form-control" placeholder="Nama Anda" name="name" required>
                </div>
                <div class="inputBox">
                    <span>No. Telepon</span>
                    <input type="number" class="form-control" placeholder="Nomor Telepon" name="number" required>
                </div>
                <div class="inputBox">
                    <span>Email</span>
                    <input type="email" class="form-control" placeholder="Email Anda" name="email" required>
                </div>
                <div class="inputBox">
                    <span>Metode Pembayaran</span>
                    <select name="payment_method" class="form-select" required id="paymentMethod" onchange="toggleBankInfo()">
                        <option value="">Pilih Metode Pembayaran</option>
                        <option value="cash">CASH</option>
                        <option value="transfer">TRANSFER BANK</option>
                    </select>
                </div>

                <!-- Bank Info -->
                <div id="bankInfo" style="display: none;">
                    <h5>Informasi Rekening Bank</h5>
                    <p>
                        <strong>Mandiri:</strong> 292263415 
                        <i class="fas fa-copy" onclick="copyToClipboard('292263415')"></i>
                    </p>
                    <p>
                        <strong>BCA:</strong> 292263415 
                        <i class="fas fa-copy" onclick="copyToClipboard('292263415')"></i>
                    </p>
                    <p>
                        <strong>BRI:</strong> 292263415 
                        <i class="fas fa-copy" onclick="copyToClipboard('292263415')"></i>
                    </p>
                    <p>
                        <strong>BNI:</strong> 292263415 
                        <i class="fas fa-copy" onclick="copyToClipboard('292263415')"></i>
                    </p>
                </div>

                <!-- Select Place -->
                <div class="inputBox mt-3">
                    <span>Mau Makan Dimana?</span>
                    <select name="tempat" class="form-select" required>
                        <option value="">Pilih tempat makan</option>
                        <option value="take away">Bawa Pulang (Takeaway)</option>
                        <option value="dine in">Makan di Tempat (Dine In)</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <input type="submit" value="Order Now" name="order_btn" class="btn btn-primary mt-3">
            </form>
        </section>
    </div>

    <!-- Scripts -->
    <script>
        function toggleBankInfo() {
            const paymentMethod = document.getElementById("paymentMethod").value;
            const bankInfo = document.getElementById("bankInfo");
            bankInfo.style.display = paymentMethod === "transfer" ? "block" : "none";
        }

        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                alert("Nomor rekening berhasil disalin: " + text);
            });
        }
    </script>
</body>

</html>
