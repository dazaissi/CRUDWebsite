<?php
session_start();

if (!isset($_SESSION['StatusUser']) || $_SESSION['StatusUser'] != 'valid1' && $_SESSION['StatusUser'] != 'valid2') {
    echo "Anda tidak berhak mengakses halaman ini!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Form Input Pelanggan</title>
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
      <h4 class="mb-0">Input Data Pelanggan</h4>
    </div>

    <div class="card-body">
      <form method="POST" action="add2_pelanggan.php">

        <div class="mb-3">
          <label for="tb1" class="form-label">ID Pelanggan</label>
          <input type="text" 
                 class="form-control" 
                 id="tb1" 
                 placeholder="Isikan ID Pelanggan" 
                 name="id_pelanggan" 
                 required>
        </div>

        <div class="mb-3">
          <label for="tb2" class="form-label">Nama Pelanggan</label>
          <input type="text" 
                 class="form-control" 
                 id="tb2" 
                 placeholder="Isikan Nama Pelanggan" 
                 name="nama_pelanggan" 
                 required>
        </div>

        <div class="mb-3">
          <label for="tb3" class="form-label">No Handphone</label>
          <input type="number" 
                 class="form-control" 
                 id="tb3" 
                 placeholder="Isikan No Handphone" 
                 name="no_hp" 
                 required>
        </div>

        
        <div class="mb-4">
          <label for="tb3" class="form-label">Alamat</label>
          <input type="text" 
                 class="form-control" 
                 id="tb3" 
                 placeholder="Isikan Alamat" 
                 name="alamat" 
                 required>
        </div>

        <button type="submit" class="btn btn-outline-success btn-sm">Rekam</button>
        <button type="reset" class="btn btn-outline-secondary btn-sm">Hapus Form</button>
        <a href="pelanggan.php" class="btn btn-outline-danger btn-sm">Batal</a>

      </form>
    </div>
  </div>
</div>

</body>
</html>