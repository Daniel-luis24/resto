<?php
include "header-admin.php";

// Cek apakah ada notifikasi
if (isset($_SESSION['notification'])) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">'
       . htmlspecialchars($_SESSION['notification']) .
       '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'
       . '</div>';
    unset($_SESSION['notification']);
}

// Ambil data pembayaran dari database
$query = "SELECT * FROM pembayaran"; // Sesuaikan dengan kondisi yang diperlukan
$result = $koneksi->query($query);
?>

<div class="container my-5" style="background-color: #f8f9fa; padding: 2rem; border-radius: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
    <h1 class="text-center mb-4" style="font-family: 'Times New Roman', Times, serif; color:rgb(31, 102, 184);">Daftar Pemesanan</h1>

    <?php if ($result->num_rows > 0): ?>
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="col">
                    <div class="card shadow border-0" style="font-family: 'Georgia', serif;">
                        <div class="card-header bg-secondary text-white text-center">
                            <h5 class="mb-0" style="font-style: italic;">Detail Pemesanan</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Nama:</strong> <?= htmlspecialchars($row['name']); ?></p>
                            <p><strong>No. Telepon:</strong> <?= htmlspecialchars($row['number']); ?></p>
                            <p><strong>Email:</strong> <?= htmlspecialchars($row['email']); ?></p>
                            <p><strong>Metode Pembayaran:</strong> <?= htmlspecialchars($row['payment_method']); ?></p>
                            <p><strong>Tempat:</strong> <?= htmlspecialchars($row['tempat']); ?></p>
                            <p><strong>Total Harga:</strong> <span class="badge bg-success">Rp. <?= number_format($row['grand_total'], 0, ',', '.'); ?></span></p>

                            <?php if (!empty($row['bukti_pembayaran'])): ?>
                                <h5 class="mt-3 text-dark">Bukti Pembayaran</h5>
                                <img src="<?= htmlspecialchars($row['bukti_pembayaran']); ?>" alt="Bukti Pembayaran" class="img-fluid rounded shadow-sm">
                            <?php else: ?>
                                <p class="text-danger">Tidak ada bukti pembayaran yang diupload.</p>
                            <?php endif; ?>

                            <div class="mt-4 text-center">
                                <?php if ($row['status'] != 'Diterima'): ?>
                                    <form action="update_status.php" method="post" class="d-inline">
                                        <input type="hidden" name="order_id" value="<?= $row['id']; ?>">
                                        <button type="submit" class="btn btn-dark btn-lg px-4"><i class="fas fa-check-circle"></i> Terima</button>
                                    </form>
                                <?php else: ?>
                                    <p class="text-success mb-0 text-center fw-bold" style="font-size: 1.2rem;"><i class="fas fa-check-circle"></i> Pesanan Diterima</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-warning text-center fs-4" role="alert" style="font-family: 'Courier New', Courier, monospace;">
            <i class="fas fa-exclamation-circle"></i> Tidak ada data pemesanan.
        </div>
    <?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
