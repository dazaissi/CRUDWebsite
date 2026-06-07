<?php
session_start();

if (!isset($_SESSION['StatusUser']) || 
   ($_SESSION['StatusUser'] != 'valid1' && $_SESSION['StatusUser'] != 'valid2')) {
    echo "Anda tidak berhak mengakses halaman ini!";
    exit;
}

require('../koneksi.php');

if (!isset($_GET['id_pelanggan'])) {
    echo "ID pelanggan tidak ditemukan!";
    exit;
}

$id_pelanggan = (int) $_GET['id_pelanggan'];

$sql = "SELECT id_pelanggan, nama_pelanggan, no_hp, alamat 
        FROM pelanggan 
        WHERE id_pelanggan = ?";

$stmt = mysqli_prepare($koneksi, $sql);
mysqli_stmt_bind_param($stmt, "i", $id_pelanggan);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    echo "Data pelanggan tidak ditemukan!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Edit Pelanggan</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="http://localhost/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script src="http://localhost/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>

<body>

<?php require('../navigasi.php'); ?>

<div class="container" style="margin-top:80px">
  <div class="card">
    <div class="card-header bg-success text-white">
      <h4 class="mb-0">Edit Data Pelanggan</h4>
    </div>

    <div class="card-body">
      <form method="post" action="../pelanggan/edit2_pelanggan.php">

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
          <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
          <input type="text" 
                 class="form-control" 
                 id="nama_pelanggan" 
                 name="nama_pelanggan" 
                 value="<?= htmlspecialchars($row['nama_pelanggan']); ?>" 
                 required>
        </div>

        <div class="mb-3">
          <label for="alamat" class="form-label">Alamat</label>
          <input type="text" 
                 class="form-control" 
                 id="alamat" 
                 name="alamat" 
                 value="<?= htmlspecialchars($row['alamat']); ?>" 
                 required>
        </div>

        <div class="mb-3">
          <label for="no_hp" class="form-label">No HP</label>
          <input type="text" 
                 class="form-control" 
                 id="no_hp" 
                 name="no_hp" 
                 value="<?= htmlspecialchars($row['no_hp']); ?>" 
                 required>
        </div>

        <button type="submit" class="btn btn-success btn-sm">Simpan Perubahan</button>
        <button type="reset" class="btn btn-secondary btn-sm">Reset</button>
        <a href="../pelanggan/pelanggan.php" class="btn btn-danger btn-sm">Batal</a>

      </form>
    </div>
  </div>
</div>

</body>
</html>

<?php
mysqli_close($koneksi);
?>