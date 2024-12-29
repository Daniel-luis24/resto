<?php

include './backend/koneksi.php';

if (isset($_POST['update_update_btn'])) {
    $update_value = $_POST['update_quantity'];
    $update_id = $_POST['update_quantity_id'];
    $update_jumlah_query = mysqli_query($koneksi, "UPDATE `cart` SET jumlah = '$update_value' WHERE id_cart = '$update_id'");
    if ($update_jumlah_query) {
        header('location:keranjang.php');
    };
};

if (isset($_GET['remove'])) {
    $remove_id_cart = $_GET['remove'];
    mysqli_query($koneksi, "DELETE FROM `cart` WHERE id_cart = '$remove_id_cart'");
    header('location:keranjang.php');
};

if (isset($_GET['delete_all'])) {
    mysqli_query($koneksi, "DELETE FROM `cart`");
    header('location:keranjang.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mie Bangladesh</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.min.css">

</head>

<body>

    <!-- <?php include 'header.php'; ?> -->

    <div class="container">

        <section class="shopping-cart">

            <h1 class="heading">Bang lades Mie</h1>

            <table class="table table-success table-striped">

                <thead>
                    <th>Gambar Menu</th>
                    <th>Nama Menu</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>total</th>
                    <th>action</th>
                </thead>

                <tbody>

                    <?php

                    $select_cart = mysqli_query($koneksi, "SELECT * FROM `cart`");
                    $grand_total = 0;

                    if (mysqli_num_rows($select_cart) > 0) {
                        while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                            $sub_total = $fetch_cart['harga'] * $fetch_cart['jumlah']; // Hitung subtotal tanpa memformat
                            $grand_total += $sub_total; // Tambahkan subtotal ke total
                    ?>

                            <tr>
                                <td><img src="gambar/<?php echo $fetch_cart['img']; ?>" height="100" alt=""></td>
                                <td><?php echo $fetch_cart['nama_menu']; ?></td>
                                <td>Rp. <?php echo number_format($fetch_cart['harga']); ?></td>
                                <td>
                                    <form action="" method="post">
                                        <input type="hidden" name="update_quantity_id" value="<?php echo $fetch_cart['id_cart']; ?>">
                                        <input type="number" name="update_quantity" min="1" value="<?php echo $fetch_cart['jumlah']; ?>">
                                        <input type="submit" value="update" class="btn btn-warning" name="update_update_btn">
                                    </form>
                                </td>
                                <td>Rp. <?php echo number_format($sub_total); ?></td> <!-- Format subtotal hanya untuk tampilan -->
                                <td><a href="keranjang.php?remove=<?php echo $fetch_cart['id_cart']; ?>" onclick="return confirm('Hapus Dari Keranjang?')" class="btn btn-danger"> <i class="fas fa-trash"></i> Hapus</a></td>
                            </tr>

                    <?php
                        }
                    }

                    ?>
                    <tr class="table-bottom">
                        <td><a href="transaksi.php" class="btn btn-outline-primary" style="margin-top: 0;">Pilih Menu Lainnya</a></td>
                        <td colspan="3">Total Bayar</td>
                        <td>Rp. <?php echo $grand_total; ?></td>
                        <td><a href="keranjang.php?delete_all" onclick="return confirm('Hapus Semua Dari Keranjang?');" class="btn btn-danger"> <i class="fas fa-trash"></i> Hapus Semua</a></td>
                    </tr>

                </tbody>

            </table>

            <div class="checkout-btn-btn-danger ">
                <a href="bayar.php" name="order_btn" class="btn btn-outline-success d-grid gap-2 <?= ($grand_total > 1) ? '' : 'disabled'; ?>">Bayar</a>
            </div>

        </section>

    </div>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>

</html>