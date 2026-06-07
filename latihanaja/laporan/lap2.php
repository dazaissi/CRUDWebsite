<!DOCTYPE html>
<html lang="en">
<head>
  <title>Rekap Pembayaran Per Pelanggan</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="http://localhost/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script src="http://localhost/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>

<body>
<?php
  session_start();

  if (!isset($_SESSION['StatusUser']) || 
     ($_SESSION['StatusUser'] != 'valid1' && $_SESSION['StatusUser'] != 'valid2')) {
      echo "Anda tidak berhak mengakses halaman ini!";
      exit;
  }

  require('Navigasi.php');
  require('Koneksi.php');
?>

<div class="container" style="margin-top:80px">
  <div class="card">
    <div class="card-body">
      <h3>Rekap Pembayaran Per Pelanggan</h3>

       <button onclick="window.print()" class="btn btn-outline-success btn-sm mb-3">
        Cetak Laporan
      </button>

      <table class="table table-bordered table-striped">
        <thead class="table-success">
          <tr>
            <th>Id.Pelanggan</th>
            <th>Nama Pelanggan</th>
            <th>Alamat</th>
            <th>No.HP</th>
            <th>Jumlah Memesan</th>
            <th>Jumlah Pembayaran</th>
          </tr>
        </thead>

        <tbody>
        <?php
          $total_pembayaran = 0;

          $sql = "SELECT 
                    pelanggan.id_pelanggan,
                    pelanggan.nama_pelanggan,
                    pelanggan.alamat,
                    pelanggan.no_hp,
                    COUNT(transaksi.id_transaksi) AS jumlah_memesan,
                    SUM(transaksi.total_harga) AS jumlah_pembayaran
                  FROM pelanggan
                  INNER JOIN transaksi 
                    ON pelanggan.id_pelanggan = transaksi.id_pelanggan
                  GROUP BY 
                    pelanggan.id_pelanggan,
                    pelanggan.nama_pelanggan,
                    pelanggan.alamat,
                    pelanggan.no_hp
                  ORDER BY pelanggan.id_pelanggan ASC";

          $query = mysqli_query($koneksi, $sql)
                   or die('SQL error: ' . mysqli_error($koneksi));

          while ($row = mysqli_fetch_array($query)) {
            $total_pembayaran += $row['jumlah_pembayaran'];

            echo "<tr>
                    <td>".$row['id_pelanggan']."</td>
                    <td>".$row['nama_pelanggan']."</td>
                    <td>".$row['alamat']."</td>
                    <td>".$row['no_hp']."</td>
                    <td>".$row['jumlah_memesan']."x</td>
                    <td>Rp ".number_format($row['jumlah_pembayaran'], 0, ',', '.')."</td>
                  </tr>";
          }
        ?>

          <tr>
            <td colspan="5" class="text-end"><b>Total Pembayaran :</b></td>
            <td><b>Rp <?php echo number_format($total_pembayaran, 0, ',', '.'); ?></b></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php mysqli_close($koneksi); ?>
</body>
</html>