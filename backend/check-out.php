<?php
include 'koneksi.php';

if (isset($_POST['order_btn'])) {
    $name = $_POST['name'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $payment_method = $_POST['payment_method'];

    // Logika untuk memproses pembayaran
    if ($payment_method == 'cash') {
        // Proses pembayaran cash
    } elseif ($payment_method == 'qris') {
        // Proses pembayaran QRIS
    } elseif ($payment_method == 'mbanking') {
        // Proses pembayaran M-Banking
    }

    // Simpan data pemesanan ke database atau lakukan tindakan lain yang diperlukan
}

    $cart_query = mysqli_query($koneksi, "SELECT * FROM `cart`");
    $harga_total = 0;
    $product_name = [];
    if (mysqli_num_rows($cart_query) > 0) {
        while ($product_item = mysqli_fetch_assoc($cart_query)) {
            $product_name[] = $product_item['nama_menu'] . ' (' . $product_item['jumlah'] . ') ';
            $product_price = $product_item['harga'] * $product_item['jumlah'];
            $harga_total += $product_price;
        }
    }

    $total_menu = implode(', ', $product_name);

    // Masukkan ke database
    $detail_query = mysqli_query($koneksi, "INSERT INTO `order`(name, number, email, total_menu, total_harga) VALUES('$name','$number','$email','$total_menu','$harga_total')") or die('query failed');

    if ($cart_query && $detail_query) {
        // Clear the cart after successful order
        mysqli_query($koneksi, "DELETE FROM `cart`") or die('query failed');

        echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Success Payment</title>
            <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC' crossorigin='anonymous'>
            <style>
                body {
                    background-color: #f8f9fa;
                }
                .order-message-container {
                    max-width: 600px;
                    margin: 50px auto;
                    padding: 20px;
                    background: #fff;
                    border-radius: 8px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }
                .message-container {
                    text-align: center;
                }
                .total {
                    font-weight: bold;
                    color: #28a745;
                }
                .customer-details p {
                    margin: 5px 0;
                }
            </style>
        </head>
        <body>
            <div class='order-message-container'>
                <div class='message-container'>
                    <h3>TERIMA KASIH !</h3>
                    <div class='order-detail'>
                        <span> Pesanan: " . $total_menu . "</span>
                        <span class='total'> 
                        <br>Total Harga: Rp" . number_format($harga_total, 0, ',', '.') . " </span>
                    </div>
                    <div class='customer-details'>
                        <p> Nama Pemesan: <span>" . $name . "</span> </p>
                        <p> No.Tlp: <span>" . $number . "</span> </p>
                        <p> Email: <span>" . $email . "</span> </p>
                    </div>
                    <a href='./../transaksi.php' class='btn btn-success'>Continue Shopping</a>
                </div>
            </div>
            <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js' integrity='sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM' crossorigin='anonymous'></script>
        </body>
        </html>
        ";
    }

?>