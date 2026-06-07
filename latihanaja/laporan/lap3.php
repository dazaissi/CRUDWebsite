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
  <title>Rekap Penerimaan Per Layanan</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="http://localhost/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script src="http://localhost/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>

<body>
<?php
  require('Navigasi.php');
  require('Koneksi.php');
?>

<div class="container" style="margin-top:80px">
  <div class="card">
    <div class="card-body">
      <h3>Rekap Penerimaan Per Layanan</h3>

      <button onclick="window.print()" class="btn btn-outline-success btn-sm mb-3">
        Cetak Laporan
      </button>

      <table class="table table-bordered table-striped">
        <thead class="table-success">
          <tr>
            <th>ID Layanan</th>
            <th>Nama Layanan</th>
            <th>Harga/Kg</th>
            <th>Jumlah Transaksi</th>
            <th>Total Berat</th>
            <th>Jumlah Penerimaan</th>
          </tr>
        </thead>

        <tbody>
        <?php
          $total_penerimaan = 0;

          $sql = "SELECT 
                    layanan.id_layanan,
                    layanan.nama_layanan,
                    layanan.harga_kg,
                    COUNT(transaksi.id_transaksi) AS jumlah_transaksi,
                    COALESCE(SUM(transaksi.berat), 0) AS total_berat,
                    COALESCE(SUM(transaksi.total_harga), 0) AS jumlah_penerimaan
                  FROM layanan
                  LEFT JOIN transaksi 
                    ON layanan.id_layanan = transaksi.id_layanan
                  GROUP BY 
                    layanan.id_layanan,
                    layanan.nama_layanan,
                    layanan.harga_kg
                  ORDER BY layanan.id_layanan ASC";

          $query = mysqli_query($koneksi, $sql)
                   or die('SQL error: ' . mysqli_error($koneksi));

          while ($row = mysqli_fetch_array($query)) {
            $total_penerimaan += $row['jumlah_penerimaan'];

            echo "<tr>
                    <td>".$row['id_layanan']."</td>
                    <td>".$row['nama_layanan']."</td>
                    <td>Rp ".number_format($row['harga_kg'], 0, ',', '.')."</td>
                    <td>".$row['jumlah_transaksi']."x</td>
                    <td>".$row['total_berat']." Kg</td>
                    <td>Rp ".number_format($row['jumlah_penerimaan'], 0, ',', '.')."</td>
                  </tr>";
          }
        ?>

          <tr>
            <td colspan="5" class="text-end"><b>Total Penerimaan :</b></td>
            <td>
              <b>Rp <?php echo number_format($total_penerimaan, 0, ',', '.'); ?></b>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php mysqli_close($koneksi); ?>
</body>
</html>