<!DOCTYPE html>
<html lang="en">
<head>
  <title>CRUD Layanan Laundry</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="/latihanaja/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script src="/latihanaja/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>

<body>
<?php require(__DIR__ . '/../navigasi.php'); ?>

<div class="container" style="margin-top:80px">
  <h3>Data Master Layanan Laundry</h3>
  <p><a href="add1_layanan.php" class='btn btn-outline-success btn-sm'>Insert Data</a></p>
  <table class="table table-bordered table-striped" width="400px">
    <thead class="table-success">
      <tr>
        <th>Id.Layanan</th>
		    <th>Nama Layanan</th>
        <th>Harga/Kg</th>
        <th>Edit & Delete</th>
      </tr>
    </thead>
<tbody>
<?php  
   // Buka koneksi database
 require(__DIR__ . '/../koneksi.php'); 
		  
   // Query mengambil data layanan
   $sql = "SELECT id_layanan, nama_layanan, harga_kg FROM layanan";    
   $query = mysqli_query($koneksi,$sql)
            or die('SQL error: '. mysqli_error($koneksi));

   // Menampilkan data layanan
   while ($row = mysqli_fetch_array($query))
   {
	 echo "<tr>
	       <td>$row[id_layanan]</td>
		   <td>$row[nama_layanan]</td>
	       <td>$row[harga_kg]</td>
           <td><a href='edit1_layanan.php?id_layanan=$row[id_layanan]' class='btn btn-outline-success btn-sm'>Edit</a>
		       <a href='delete_layanan.php?id_layanan=$row[id_layanan]' class='btn btn-outline-success btn-sm'
			      onClick='return confirm(\"Hapus data layanan $row[nama_layanan]?\")'>Delete</a></td>
		   </tr>";
   }
   // Tutup koneksi database
   mysqli_close($koneksi);
?>	
</tbody>
</table>       
</div>
</body>
</html>