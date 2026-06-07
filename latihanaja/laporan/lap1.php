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
  <title>Laporan Transaksi Laundry</title>
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
      <h3>Laporan Transaksi Laundry</h3>

      <button onclick="window.print()" class="btn btn-outline-success btn-sm mb-3">
        Cetak Laporan
      </button>

      <table class="table table-bordered table-striped">
        <thead class="table-success">
          <tr>
            <th>ID Transaksi</th>
            <th>Tanggal</th>
            <th>ID Pelanggan</th>
            <th>Nama Pelanggan</th>
            <th>No HP</th>
            <th>ID Layanan</th>
            <th>Layanan</th>
            <th>Harga/Kg</th>
            <th>Berat</th>
            <th>Total Harga</th>
            <th>Status</th>
          </tr>
        </thead>

        <tbody>
        <?php
          $total_pendapatan = 0;

          $sql = "SELECT 
                    transaksi.id_transaksi,
                    transaksi.tanggal_transaksi,
                    transaksi.id_pelanggan,
                    pelanggan.nama_pelanggan,
                    pelanggan.no_hp,
                    layanan.id_layanan,
                    layanan.nama_layanan,
                    layanan.harga_kg,
                    transaksi.berat,
                    transaksi.total_harga,
                    transaksi.status
                  FROM transaksi
                  INNER JOIN pelanggan 
                    ON transaksi.id_pelanggan = pelanggan.id_pelanggan
                  INNER JOIN layanan 
                    ON transaksi.id_layanan = layanan.id_layanan
                  ORDER BY transaksi.id_transaksi ASC";

          $query = mysqli_query($koneksi, $sql)
                   or die('SQL error: ' . mysqli_error($koneksi));

          while ($row = mysqli_fetch_array($query)) {
            $total_pendapatan += $row['total_harga'];

            echo "<tr>
                    <td>".$row['id_transaksi']."</td>
                    <td>".$row['tanggal_transaksi']."</td>
                    <td>".$row['id_pelanggan']."</td>
                    <td>".$row['nama_pelanggan']."</td>
                    <td>".$row['no_hp']."</td>
                    <td>".$row['id_layanan']."</td>
                    <td>".$row['nama_layanan']."</td>
                    <td>Rp ".number_format($row['harga_kg'], 0, ',', '.')."</td>
                    <td>".$row['berat']." Kg</td>
                    <td>Rp ".number_format($row['total_harga'], 0, ',', '.')."</td>
                    <td>".$row['status']."</td>
                  </tr>";
          }
        ?>

          <tr>
            <td colspan="8" class="text-end"><b>Total Pendapatan</b></td>
            <td colspan="2">
              <b>Rp <?php echo number_format($total_pendapatan, 0, ',', '.'); ?></b>
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