<?php include "header-admin.php"; ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<body>
    <div class="container my-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white text-center">
                <h3 class="mb-0">Tambah Menu</h3>
            </div>
            <div class="card-body">
                <!-- Menu -->
                <form action="./backend/proses.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nama_menu" class="form-label">Nama Menu</label>
                        <input type="text" class="form-control" name="nama_menu" id="nama_menu" placeholder="Masukkan Nama Menu" required>
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="text" name="harga" id="harga" class="form-control" placeholder="Masukkan Harga" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <select id="kategori" name="kategori" class="form-select" required>
                            <option value="" disabled selected>Pilih Kategori...</option>
                            <option value="Makanan">Makanan</option>
                            <option value="Minuman">Minuman</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="img" class="form-label">Gambar</label>
                        <input type="file" name="img" class="form-control" id="img" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </div>
                </form>
            </div>
        </div>

        <h3 class="mt-5 text-center">Menu List</h3>

        <!-- makanan -->
        <div class="table-responsive mt-4">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Nama Makanan</th>
                        <th>Harga</th>
                        <th>Image</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require "./backend/koneksi.php";
                    $dataMakanan = mysqli_query($koneksi, "SELECT * FROM menu WHERE kategori = 'Makanan'") or die(mysqli_error($koneksi));
                    while ($row = mysqli_fetch_array($dataMakanan)) {
                    ?>
                        <tr>
                            <td><?= htmlspecialchars($row['nama_menu']); ?></td>
                            <td>Rp. <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                            <td><img src="./gambar/<?= htmlspecialchars($row['img']); ?>" style="width: 100px; height: 100px; object-fit: cover;"></td>
                            <td class="text-center">
                                <a href="./backend/delete.php?id_menu=<?= $row['id_menu']; ?>" class="btn btn-danger btn-sm">Hapus</a>
                                <a href="./edit-menu.php?id_menu=<?= $row['id_menu']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- minuman -->
        <div class="table-responsive mt-4">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Nama Minuman</th>
                        <th>Harga</th>
                        <th>Image</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $dataMinuman = mysqli_query($koneksi, "SELECT * FROM menu WHERE kategori = 'Minuman'") or die(mysqli_error($koneksi));
                    while ($row = mysqli_fetch_array($dataMinuman)) {
                    ?>
                        <tr>
                            <td><?= htmlspecialchars($row['nama_menu']); ?></td>
                            <td>Rp. <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                            <td><img src="./gambar/<?= htmlspecialchars($row['img']); ?>" style="width: 100px; height: 100px; object-fit: cover;"></td>
                            <td class="text-center">
                                <a href="./backend/delete.php?id_menu=<?= $row['id_menu']; ?>" class="btn btn-danger btn-sm">Hapus</a>
                                <a href="./edit-menu.php?id_menu=<?= $row['id_menu']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
