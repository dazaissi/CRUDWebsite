<?php
session_start();

if (!isset($_SESSION['StatusUser']) || $_SESSION['StatusUser'] != 'valid1') {
    echo "Anda tidak berhak mengakses halaman ini!";
    exit;
}
?>
    
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Form Input Layanan</title>
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
      <h4 class="mb-0">Input Data Layanan</h4>
    </div>

    <div class="card-body">
      <form method="POST" action="../layanan/add2_layanan.php">

        <div class="mb-3">
          <label for="tb1" class="form-label">ID Layanan</label>
          <input type="text" 
                 class="form-control" 
                 id="tb1" 
                 placeholder="Isikan ID Layanan" 
                 name="id_layanan" 
                 required>
        </div>

        <div class="mb-3">
          <label for="tb2" class="form-label">Nama Layanan</label>
          <input type="text" 
                 class="form-control" 
                 id="tb2" 
                 placeholder="Isikan Nama Layanan" 
                 name="nama_layanan" 
                 required>
        </div>

        <div class="mb-3">
          <label for="tb3" class="form-label">Harga per KG</label>
          <input type="number" 
                 class="form-control" 
                 id="tb3" 
                 placeholder="Isikan Harga per KG" 
                 name="harga_kg" 
                 required>
        </div>

        <button type="submit" class="btn btn-outline-success btn-sm">Rekam</button>
        <button type="reset" class="btn btn-outline-secondary btn-sm">Hapus Form</button>
        <a href="../layanan/layanan.php " class="btn btn-outline-danger btn-sm">Batal</a>

      </form>
    </div>
  </div>
</div>

</body>
</html>