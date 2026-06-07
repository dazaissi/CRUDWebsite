<?php
session_start();

if (!isset($_SESSION['StatusUser']) || 
   ($_SESSION['StatusUser'] != 'valid1' && $_SESSION['StatusUser'] != 'valid2')) {
    header("Location: /latihanaja/login.php");
    exit;
}

require(__DIR__ . '/../koneksi.php');

if (!isset($_GET['id_transaksi'])) {
    echo "ID transaksi tidak ditemukan!";
    exit;
}

$id_transaksi = (int) $_GET['id_transaksi'];

$sql = "SELECT id_transaksi, id_pelanggan, id_layanan, tanggal_transaksi, berat, total_harga, status 
        FROM transaksi 
        WHERE id_transaksi = ?";

$stmt = mysqli_prepare($koneksi, $sql);
mysqli_stmt_bind_param($stmt, "i", $id_transaksi);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    echo "Data transaksi tidak ditemukan!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Edit Transaksi</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="/latihanaja/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script src="/latihanaja/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>

<body>

<?php require(__DIR__ . '/../navigasi.php'); ?>

<div class="container" style="margin-top:80px">
  <div class="card">
    <div class="card-header bg-success text-white">
      <h4 class="mb-0">Edit Data Transaksi</h4>
    </div>

    <div class="card-body">
      <form method="post" action="edit2_transaksi.php">

        <div class="mb-3">
          <label for="id_transaksi" class="form-label">ID Transaksi</label>
          <input type="text" 
                 class="form-control" 
                 id="id_transaksi" 
                 name="id_transaksi" 
                 value="<?= htmlspecialchars($row['id_transaksi']); ?>" 
                 readonly>
        </div>

        <div class="mb-3">
          <label for="id_pelanggan" class="form-label">ID Pelanggan</label>
          <input type="text" 
                 class="form-control" 
                 id="id_pelanggan" 
                 name="id_pelanggan" 
                 value="<?= htmlspecialchars($row['id_pelanggan']); ?>" 
                 readonly>
        </div>

        <div class="mb-3">
          <label for="id_layanan" class="form-label">ID Layanan</label>
          <input type="text" 
                 class="form-control" 
                 id="id_layanan" 
                 name="id_layanan" 
                 value="<?= htmlspecialchars($row['id_layanan']); ?>" 
                 readonly>
        </div>  

        <div class="mb-3">
          <label for="tanggal_transaksi" class="form-label">Tanggal Transaksi</label>
          <input type="date" 
                 class="form-control" 
                 id="tanggal_transaksi" 
                 name="tanggal_transaksi" 
                 value="<?= htmlspecialchars($row['tanggal_transaksi']); ?>" 
                 readonly>
        </div>

        <div class="mb-3">
          <label for="berat" class="form-label">Berat (Kg)</label>
          <input type="number" 
                 class="form-control" 
                 id="berat" 
                 name="berat" 
                 value="<?= htmlspecialchars($row['berat']); ?>" 
                 required>
        </div>

        <div class="mb-3">
          <label for="total_harga" class="form-label">Total Harga</label>
          <input type="number"  
                 class="form-control" 
                 id="total_harga" 
                 name="total_harga" 
                 value="<?= htmlspecialchars($row['total_harga']); ?>" 
                 required>
        </div>

        <div class="mb-3">
          <label for="status" class="form-label">Status</label>
          <select class="form-control" id="status" name="status" required>
            <option value="">Pilih Status</option>
            <option value="Diproses" <?= $row['status'] == 'Diproses' ? 'selected' : '' ?>>Diproses</option>
            <option value="Selesai" <?= $row['status'] == 'Selesai' ? 'selected' : '' ?>>Selesai</option>
            <option value="Diambil" <?= $row['status'] == 'Diambil' ? 'selected' : '' ?>>Diambil</option>
          </select>
        </div>

        <button type="submit" class="btn btn-success btn-sm">Simpan Perubahan</button>
        <button type="reset" class="btn btn-secondary btn-sm">Reset</button>
        <a href="transaksi.php" class="btn btn-danger btn-sm">Batal</a>

      </form>
    </div>
  </div>
</div>

</body>
</html>

<?php
mysqli_close($koneksi);
?>