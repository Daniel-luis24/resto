<?php include "header-admin.php"; ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<body>
    <div>Edit Menu
        <?php
        require "./backend/koneksi.php";
        $id_menu = $_GET['id_menu'];
        $data = mysqli_query($koneksi, "SELECT * FROM menu WHERE id_menu = '$id_menu'");
        $row = mysqli_fetch_array($data);
        ?>
        <form action="./backend/edit.php" class="mt-2" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_menu" value="<?php echo $row['id_menu']; ?>">
            <div class="mb-3 mt-2">
                <input type="text" class="form-control" name="nama_menu" value="<?php echo $row['nama_menu']; ?>" placeholder="Nama Menu" Required>
            </div>
            <div class="input-group mb-3 mt-2">
                <span class="input-group-text">Rp</span>
                <input type="text" name="harga" value="<?php echo $row['harga']; ?>" placeholder="Harga" class="form-control" Required>
            </div>
            <div class="mb-3 mt-2">
                <select id="disabledSelect" name="kategori" class="form-select" required>
                    <option value="Makanan" <?php echo ($row['kategori'] == 'Makanan') ? 'selected' : ''; ?>>Makanan</option>
                    <option value="Minuman" <?php echo ($row['kategori'] == 'Minuman') ? 'selected' : ''; ?>>Minuman</option>
                </select>
            </div>
            <div class="input-group mb-3 mt-2">
                <span class="input-group-text" id="basic-addon3">Image</span>
                <input type="file" name="img" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                <small class="form-text text-muted"></small>
            </div>

            <div class="mt-2">
                <button class="btn btn-primary" type="submit" name="submit">Done</button>
                <button class="btn btn-danger" type="reset" value="Reset">Reset</button>
            </div>
        </form>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>