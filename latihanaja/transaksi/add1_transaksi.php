<?php
session_start();

if (!isset($_SESSION['StatusUser']) || 
   ($_SESSION['StatusUser'] != 'valid1' && $_SESSION['StatusUser'] != 'valid2')) {
    echo "Anda tidak berhak mengakses halaman ini!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Form Input Transaksi</title>
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
      <h4 class="mb-0">Input Data Transaksi</h4>
    </div>

    <div class="card-body">
      <form method="POST" action="add2_transaksi.php">

        <div class="mb-3">
          <label for="id_transaksi" class="form-label">ID Transaksi</label>
          <input type="text" 
                 class="form-control" 
                 id="id_transaksi" 
                 placeholder="Isikan ID Transaksi" 
                 name="id_transaksi" 
                 required>
        </div>

        <div class="mb-3">
          <label for="id_layanan" class="form-label">ID Layanan</label>
          <input type="text" 
                 class="form-control" 
                 id="id_layanan" 
                 placeholder="Isikan ID Layanan" 
                 name="id_layanan" 
                 required>
        </div>

        <div class="mb-3">
          <label for="id_pelanggan" class="form-label">ID Pelanggan</label>
          <input type="text" 
                 class="form-control" 
                 id="id_pelanggan" 
                 placeholder="Isikan ID Pelanggan" 
                 name="id_pelanggan" 
                 required>
        </div>

        <div class="mb-3">
          <label for="tanggal_transaksi" class="form-label">Tanggal Transaksi</label>
          <input type="date" 
                 class="form-control" 
                 id="tanggal_transaksi" 
                 name="tanggal_transaksi" 
                 required>
        </div>

        <div class="mb-3">
          <label for="berat" class="form-label">Berat</label>
          <input type="number" 
                 class="form-control" 
                 id="berat" 
                 placeholder="Isikan Berat" 
                 name="berat" 
                 required>
        </div>

        <div class="mb-4">
          <label for="total_harga" class="form-label">Total Harga</label>
          <input type="number" 
                 class="form-control" 
                 id="total_harga" 
                 placeholder="Isikan Total Harga" 
                 name="total_harga" 
                 required>
        </div>

        <div class="mb-3">
          <label for="status" class="form-label">Status</label>
          <select class="form-control" id="status" name="status" required>
            <option value="">Pilih Status</option>
            <option value="Diproses">Diproses</option>
            <option value="Selesai">Selesai</option>
            <option value="Diambil">Diambil</option>
          </select>
        </div>

        <button type="submit" class="btn btn-outline-success btn-sm">Rekam</button>
        <button type="reset" class="btn btn-outline-secondary btn-sm">Hapus Form</button>
        <a href="transaksi.php" class="btn btn-outline-danger btn-sm">Batal</a>

      </form>
    </div>
  </div>
</div>

</body>
</html>