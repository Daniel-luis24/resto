<?php
include "header-admin.php"; // Pastikan koneksi database sudah benar

// Inisialisasi variabel untuk filter
$filter = isset($_POST['filter']) ? $_POST['filter'] : '';

// Ambil data pesanan dari tabel pembayaran berdasarkan filter
if ($filter == 'harian' && !empty($_POST['selected_date'])) {
    $selected_date = $_POST['selected_date'];
    $start_date = $selected_date . ' 00:00:00'; // Awal hari
    $end_date = $selected_date . ' 23:59:59'; // Akhir hari
    $query = "SELECT * FROM pembayaran WHERE tanggal_pemesanan BETWEEN '$start_date' AND '$end_date' ORDER BY tanggal_pemesanan DESC";
} elseif ($filter == 'bulanan' && !empty($_POST['selected_month']) && !empty($_POST['selected_year'])) {
    $selected_month = $_POST['selected_month'];
    $selected_year = $_POST['selected_year'];
    $start_date = $selected_year . '-' . $selected_month . '-01'; // Awal bulan
    $end_date = $selected_year . '-' . $selected_month . '-' . date('t', strtotime($start_date)); // Akhir bulan
    $query = "SELECT * FROM pembayaran WHERE tanggal_pemesanan BETWEEN '$start_date' AND '$end_date' ORDER BY tanggal_pemesanan DESC";
} else {
    // Jika tidak ada filter, ambil semua data
    $query = "SELECT * FROM pembayaran ORDER BY tanggal_pemesanan DESC";
}

// Pastikan query tidak kosong sebelum dieksekusi
if (!empty($query)) {
    $result = mysqli_query($koneksi, $query);
    if (!$result) {
        die("Query Error: " . mysqli_error($koneksi));
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kasir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="container my-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white text-center">
                <h3 class="mb-0"><i class="fas fa-file-alt me-2"></i>Laporan Kasir</h3>
            </div>
            <div class="card-body">
                <!-- Form Filter -->
                <form method="post" class="mb-4">
                    <div class="row gy-2">
                        <div class="col-md-3">
                            <select name="filter" class="form-select" onchange="toggleDateInput(this)">
                                <option value="" disabled selected>Pilih Filter...</option>
                                <option value="harian" <?= $filter == 'harian' ? 'selected' : ''; ?>>Harian</option>
                                <option value="bulanan" <?= $filter == 'bulanan' ? 'selected' : ''; ?>>Bulanan</option>
                            </select>
                        </div>
                        <div class="col-md-3" id="dateInput" style="display: none;">
                            <input type="date" name="selected_date" class="form-control" value="<?= isset($_POST['selected_date']) ? $_POST['selected_date'] : ''; ?>">
                        </div>
                        <div class="col-md-3" id="monthYearInput" style="display: none;">
                            <div class="row gx-1">
                                <div class="col">
                                    <select name="selected_month" class="form-select">
                                        <option value="" disabled selected>Bulan</option>
                                        <?php for ($m = 1; $m <= 12; $m++): ?>
                                            <option value="<?= str_pad($m, 2, '0', STR_PAD_LEFT); ?>" <?= (isset($_POST['selected_month']) && $_POST['selected_month'] == str_pad($m, 2, '0', STR_PAD_LEFT)) ? 'selected' : ''; ?>>
                                                <?= date('F', mktime(0, 0, 0, $m, 1)); ?>
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="col">
                                    <select name="selected_year" class="form-select">
                                        <option value="" disabled selected>Tahun</option>
                                        <?php
                                        $current_year = date('Y');
                                        for ($y = 2020; $y <= $current_year; $y++): ?>
                                            <option value="<?= $y; ?>" <?= (isset($_POST['selected_year']) && $_POST['selected_year'] == $y) ? 'selected' : ''; ?>>
                                                <?= $y; ?>
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-success w-100"><i class="fas fa-search me-2"></i>Terapkan</button>
                        </div>
                    </div>
                </form>

                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="table-primary text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>No. Telepon</th>
                                <th>Email</th>
                                <th>Metode Pembayaran</th>
                                <th>Tempat</th>
                                <th>Total Harga</th>
                                <th>Tanggal Pemesanan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                                <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td class="text-center"><?= $no++; ?></td>
                                        <td><?= htmlspecialchars($row['name']); ?></td>
                                        <td><?= htmlspecialchars($row['number']); ?></td>
                                        <td><?= htmlspecialchars($row['email']); ?></td>
                                        <td><?= htmlspecialchars($row['payment_method']); ?></td>
                                        <td><?= htmlspecialchars($row['tempat']); ?></td>
                                        <td>Rp. <?= number_format($row['grand_total'], 0, ',', '.'); ?></td>
                                        <td><?= htmlspecialchars($row['tanggal_pemesanan']); ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center text-danger">Tidak ada data ditemukan.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle input fields based on filter selection
        document.querySelector('select[name="filter"]').addEventListener('change', function () {
            var dateInput = document.getElementById('dateInput');
            var monthYearInput = document.getElementById('monthYearInput');
            if (this.value === 'harian') {
                dateInput.style.display = 'block';
                monthYearInput.style.display = 'none';
            } else if (this.value === 'bulanan') {
                dateInput.style.display = 'none';
                monthYearInput.style.display = 'block';
            } else {
                dateInput.style.display = 'none';
                monthYearInput.style.display = 'none';
            }
        });
    </script>
</body>

</html>
