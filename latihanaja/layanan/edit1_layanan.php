<?php
session_start();

if (!isset($_SESSION['StatusUser']) || 
   ($_SESSION['StatusUser'] != 'valid1')) {
    echo "Anda tidak berhak mengakses halaman ini!";
    exit;
}

require(__DIR__ . '/../koneksi.php');

if (!isset($_GET['id_layanan'])) {
    echo "ID layanan tidak ditemukan!";
    exit;
}

$id_layanan = (int) $_GET['id_layanan'];

$sql = "SELECT id_layanan, nama_layanan, harga_kg 
        FROM layanan 
        WHERE id_layanan = ?";

$stmt = mysqli_prepare($koneksi, $sql);
mysqli_stmt_bind_param($stmt, "i", $id_layanan);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    echo "Data layanan tidak ditemukan!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Edit Layanan</title>
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
      <h4 class="mb-0">Edit Data Layanan</h4>
    </div>

    <div class="card-body">
      <form method="post" action="edit2_layanan.php">

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
          <label for="nama_layanan" class="form-label">Nama Layanan</label>
          <input type="text" 
                 class="form-control" 
                 id="nama_layanan" 
                 name="nama_layanan" 
                 value="<?= htmlspecialchars($row['nama_layanan']); ?>" 
                 required>
        </div>

        <div class="mb-3">
          <label for="harga_kg" class="form-label">Harga/Kg</label>
          <input type="number" 
                 class="form-control" 
                 id="harga_kg" 
                 name="harga_kg" 
                 value="<?= htmlspecialchars($row['harga_kg']); ?>" 
                 required>
        </div>  
               

        <button type="submit" class="btn btn-success btn-sm">Simpan Perubahan</button>
        <button type="reset" class="btn btn-secondary btn-sm">Reset</button>
        <a href="layanan.php" class="btn btn-danger btn-sm">Batal</a>

      </form>
    </div>
  </div>
</div>

</body>
</html>

<?php
mysqli_close($koneksi);
?>