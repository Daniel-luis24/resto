<section id="gtco-menu" class="section-padding" style="background-color: #ffffff;">
    <div class="container">
        <div class="section-content">
            <div class="row mb-5">
                <div class="col-md-12">
                    <div class="heading-section text-center">
                        <span style="font-size: 1.2rem; text-transform: uppercase; letter-spacing: 2px; color: #333;">
                            Specialties
                        </span>
                        <h2 style="font-family: 'Georgia', serif; margin-bottom: 20px; color: #000;">
                            Menu Kami
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <!-- Makanan -->
                <div class="col-lg-6 menu-wrap">
                    <div class="heading-menu">
                        <h3 class="text-center mb-5" style="text-transform: uppercase; color: #000;">Makanan</h3>
                    </div>
                    <?php
                    require "./backend/koneksi.php";
                    $data = mysqli_query($koneksi, "SELECT * FROM menu WHERE kategori = 'Makanan'") or die(mysqli_error($koneksi));
                    while ($row = mysqli_fetch_array($data)) {
                    ?>
                        <div style="display: flex; align-items: center; margin-bottom: 20px; padding: 15px; background-color: #ffffff; border: 1px solid #eaeaea; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); transition: transform 0.3s ease, box-shadow 0.3s ease;">
                            <div style="width: 100px; height: 100px; border-radius: 50%; overflow: hidden; border: 1px solid #eaeaea; margin-right: 15px;">
                                <img src="./gambar/<?php echo $row['img']; ?>" alt="Menu Image" style="object-fit: cover; width: 100%; height: 100%;">
                            </div>
                            <div>
                                <h4 style="margin: 0; color: #000;"><?php echo $row['nama_menu']; ?></h4>
                                <p style="margin: 0; color: #555;">Rp. <?php echo number_format($row['harga'], 0, ',', '.'); ?></p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <!-- Minuman -->
                <div class="col-lg-6 menu-wrap">
                    <div class="heading-menu">
                        <h3 class="text-center mb-5" style="text-transform: uppercase; color: #000;">Minuman</h3>
                    </div>
                    <?php
                    $data = mysqli_query($koneksi, "SELECT * FROM menu WHERE kategori = 'Minuman'") or die(mysqli_error($koneksi));
                    while ($row = mysqli_fetch_array($data)) {
                    ?>
                        <div style="display: flex; align-items: center; margin-bottom: 20px; padding: 15px; background-color: #ffffff; border: 1px solid #eaeaea; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); transition: transform 0.3s ease, box-shadow 0.3s ease;">
                            <div style="width: 100px; height: 100px; border-radius: 50%; overflow: hidden; border: 1px solid #eaeaea; margin-right: 15px;">
                                <img src="./gambar/<?php echo $row['img']; ?>" alt="Menu Image" style="object-fit: cover; width: 100%; height: 100%;">
                            </div>
                            <div>
                                <h4 style="margin: 0; color: #000;"><?php echo $row['nama_menu']; ?></h4>
                                <p style="margin: 0; color: #555;">Rp. <?php echo number_format($row['harga'], 0, ',', '.'); ?></p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
