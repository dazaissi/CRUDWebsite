<?php
session_start();

if (!isset($_SESSION['StatusUser']) || 
   ($_SESSION['StatusUser'] != 'valid1' && $_SESSION['StatusUser'] != 'valid2')) {
    header("Location: /latihanaja/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>CRUD Transaksi Laundry</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="/latihanaja/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script src="/latihanaja/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>

<body>

<?php 
  require(__DIR__ . '/../navigasi.php');
?>   

<div class="container" style="margin-top:80px">
  <h3>Data Master Transaksi Laundry</h3>

  <p>
    <a href="add1_transaksi.php" class="btn btn-outline-success btn-sm">
      Insert Data
    </a>
  </p>

  <table class="table table-bordered table-striped" width="400px">
    <thead class="table-success">
      <tr>
        <th>Id.Transaksi</th>
        <th>Id.Pelanggan</th>
        <th>Id.Layanan</th>
        <th>Tanggal Transaksi</th>
        <th>Berat</th>
        <th>Total Harga</th>
        <th>Status</th>
        <th>Edit & Delete</th>
      </tr>
    </thead>

    <tbody>
    <?php  
      require(__DIR__ . '/../koneksi.php');
            
      $sql = "SELECT id_transaksi, id_pelanggan, id_layanan, tanggal_transaksi, berat, total_harga, status 
              FROM transaksi";    

      $query = mysqli_query($koneksi, $sql)
               or die('SQL error: '. mysqli_error($koneksi));

      while ($row = mysqli_fetch_array($query))
      {
        echo "<tr>
                <td>".$row['id_transaksi']."</td>
                <td>".$row['id_pelanggan']."</td>
                <td>".$row['id_layanan']."</td>
                <td>".$row['tanggal_transaksi']."</td>
                <td>".$row['berat']." Kg</td>
                <td>Rp ".number_format($row['total_harga'], 0, ',', '.')."</td>
                <td>".$row['status']."</td>
                <td>
                  <a href='edit1_transaksi.php?id_transaksi=".$row['id_transaksi']."' 
                     class='btn btn-outline-success btn-sm'>Edit</a>

                  <a href='delete_transaksi.php?id_transaksi=".$row['id_transaksi']."' 
                     class='btn btn-outline-danger btn-sm'
                     onClick='return confirm(\"Hapus data transaksi ".$row['id_transaksi']."?\")'>
                     Delete
                  </a>
                </td>
              </tr>";
      }

      mysqli_close($koneksi);
    ?>	
    </tbody>
  </table>       
</div>

</body>
</html>