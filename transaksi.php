<?php
include './backend/koneksi.php';

if (isset($_POST['add_to_cart'])) {
    $nama_menu = $_POST['product_name'];
    $harga_menu = $_POST['product_price'];
    $image_menu = $_POST['product_image'];
    $jumlah = $_POST['jumlah'];

    $select_cart = mysqli_query($koneksi, "SELECT * FROM `cart` WHERE nama_menu = '$nama_menu'");

    if (mysqli_num_rows($select_cart) > 0) {
        $message[] = 'Belum Menambahkan Menu !!!';
    } else {
        $insert_product = mysqli_query($koneksi, "INSERT INTO `cart`(nama_menu, harga, img, jumlah) VALUES('$nama_menu', '$harga_menu', '$image_menu', '$jumlah')");
        $message[] = 'Berhasil Di Tambahkan Ke Keranjang';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Mie Bangladesh</title>
    <meta name="description" content="Resto">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- External CSS -->
    <link rel="stylesheet" href="vendor/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/select2/select2.min.css">
    <link rel="stylesheet" href="vendor/owlcarousel/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdn.rawgit.com/noelboss/featherlight/1.7.13/release/featherlight.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/brands.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700|Josefin+Sans:300,400,700">
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.min.css">

    <!-- Modernizr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>

    <!-- Internal CSS for improved design -->
    <style>
        /* Card container */
        .card-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 15px;
            margin-bottom: 20px;
            transition: transform 0.3s ease-in-out;
        }

        .card-container:hover {
            transform: scale(1.05);
        }

        /* Styling untuk gambar menu */
        .menu-img {
            margin-right: 20px;
        }

        .menu-name {
            font-size: 1.25rem;
            font-weight: bold;
            color: #333;
        }

        .menu-price {
            font-size: 1.1rem;
            color: #F66B0E;
            margin-bottom: 15px;
        }

        /* Styling untuk tombol Add to Cart */
        .btn-add-cart {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        .btn-add-cart:hover {
            background-color: #218838;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .menus {
                flex-direction: column;
                text-align: center;
            }

            .card-container {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .menu-img {
                margin-bottom: 15px;
            }

            .text-wrap {
                width: 100%;
            }
        }

        
    </style>

</head>

<body data-spy="scroll" data-target="#navbar">
    <div id="canvas-overlay"></div>
    <div class="boxed-page">
        <nav id="navbar-header" class="navbar navbar-expand-lg">
            <div class="container" style="display: flex; justify-content: space-between; align-items: center; position: relative;">
              
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="lnr lnr-menu"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav d-flex" style="display: flex; justify-content: flex-start; align-items: center;">
                        <li class="nav-item" style="margin: 0 10px;">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        
                        <li class="nav-item" style="margin: 0 10px;">
                            <a class="nav-link" href="keranjang.php">
                                <?php
                                $select_rows = mysqli_query($koneksi, "SELECT * FROM `cart`") or die('query failed');
                                $row_count = mysqli_num_rows($select_rows);
                                echo $row_count; ?>
                                <i class="fas fa-shopping-cart"></i>
                            </a>
                        </li>
                    </ul>

                    <!-- Logo ditempatkan di tengah -->
                    <a class="navbar-brand" href="index.php" style="position: absolute; left: 50%; transform: translateX(-50%);">
                        <img src="img/logoo.jpg" alt="Logo" style="max-height: 50px;">
                    </a>

                    <ul class="navbar-nav d-flex" style="display: flex; justify-content: flex-end; align-items: center;">
                        <li class="nav-item" style="margin: 0 10px;">
                            <a class="nav-link" href="login/register.php">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        <!-- Content Section -->
        <section id="gtco-menu">
            <div class="container">
                <div class="section-content">
                    <div class="row mb-5">
                        <div class="col-md-12">
                            <div class="heading-section text-center">
                                <h2>Menu Kami</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 menu-wrap">
                            <h3 class="text-center mb-5">Makanan</h3>
                            <?php
                            $pilih_menu = mysqli_query($koneksi, "SELECT * FROM `menu` WHERE kategori ='Makanan'");
                            if (mysqli_num_rows($pilih_menu) > 0) {
                                while ($menu = mysqli_fetch_assoc($pilih_menu)) {
                            ?>
                                    <form action="" method="POST">
                                        <div class="menus d-flex align-items-center mt-5 card-container">
                                            <div class="menu-img rounded-circle">
                                                <img class="img-fluid" src="./gambar/<?php echo $menu['img']; ?>" alt="" width="150px" height="150px">
                                            </div>
                                            <div class="text-wrap">
                                                <h4 class="menu-name"><?php echo $menu['nama_menu']; ?></h4>
                                                <p class="menu-price">Rp. <?php echo $menu['harga']; ?></p>
                                                <input type="hidden" name="product_name" value="<?php echo $menu['nama_menu']; ?>">
                                                <input type="hidden" name="product_price" value="<?php echo $menu['harga']; ?>">
                                                <input type="hidden" name="product_image" value="<?php echo $menu['img']; ?>">
                                                <input type="number" name="jumlah" class="form-control" placeholder="Jumlah Pesanan" required>
                                                <input type="submit" class="btn-add-cart" value="Add to Cart" name="add_to_cart">
                                            </div>
                                        </div>
                                    </form>
                            <?php
                                }
                            };
                            ?>
                        </div>
                        <div class="col-lg-6 menu-wrap">
                            <h3 class="text-center mb-5">Minuman</h3>
                            <?php
                            $pilih_menu = mysqli_query($koneksi, "SELECT * FROM `menu` WHERE kategori ='Minuman'");
                            if (mysqli_num_rows($pilih_menu) > 0) {
                                while ($menu = mysqli_fetch_assoc($pilih_menu)) {
                            ?>
                                    <form action="" method="POST">
                                        <div class="menus d-flex align-items-center mt-5 card-container">
                                            <div class="menu-img rounded-circle">
                                                <img class="img-fluid" src="./gambar/<?php echo $menu['img']; ?>" alt="" width="150px" height="150px">
                                            </div>
                                            <div class="text-wrap">
                                                <h4 class="menu-name"><?php echo $menu['nama_menu']; ?></h4>
                                                <p class="menu-price">Rp. <?php echo $menu['harga']; ?></p>
                                                <input type="hidden" name="product_name" value="<?php echo $menu['nama_menu']; ?>">
                                                <input type="hidden" name="product_price" value="<?php echo $menu['harga']; ?>">
                                                <input type="hidden" name="product_image" value="<?php echo $menu['img']; ?>">
                                                <input type="number" name="jumlah" class="form-control" placeholder="Jumlah Pesanan" required>
                                                <input type="submit" class="btn-add-cart" value="Add to Cart" name="add_to_cart">
                                            </div>
                                        </div>
                                    </form>
                            <?php
                                }
                            };
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End of Content Section -->

        <!-- Footer Section -->
        <?php include "footer.php" ?>
        <!-- End of Footer Section -->
    </div>
</body>

</html>