<!DOCTYPE html>
<html lang="en">
<head>
  <title>CRUD Pelanggan Laundry</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="http://localhost/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script src="http://localhost/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>

<body>
<?php 
  require('../navigasi.php');
?>   
<div class="container" style="margin-top:80px">
  <h3>Data Master Pelanggan Laundry</h3>
  <p><a href="../pelanggan/add1_pelanggan.php" class='btn btn-outline-success btn-sm'>Insert Data</a></p>
  <table class="table table-bordered table-striped" width="400px">
    <thead class="table-success">
      <tr>
        <th>Id.Pelanggan</th>
		<th>Nama Pelanggan</th>
        <th>Alamat</th>
		<th>Telepon</th>
		<th>Edit & Delete</th>
      </tr>
    </thead>
<tbody>
<?php  
   // Buka koneksi database
   require('../koneksi.php');
		  
   // Query mengambil data pelanggan
   $sql = "SELECT id_pelanggan, nama_pelanggan,no_hp, alamat FROM pelanggan";    
   $query = mysqli_query($koneksi,$sql)
            or die('SQL error: '. mysqli_error($koneksi));

   // Menampilkan data pelanggan
   while ($row = mysqli_fetch_array($query))
   {
	 echo "<tr>
	       <td>$row[id_pelanggan]</td>
		   <td>$row[nama_pelanggan]</td>
	       <td>$row[alamat]</td>
		   <td>$row[no_hp]</td>
           <td><a href='../pelanggan/edit1_pelanggan.php?id_pelanggan=$row[id_pelanggan]' class='btn btn-outline-success btn-sm'>Edit</a>
		       <a href='../pelanggan/delete_pelanggan.php?id_pelanggan=$row[id_pelanggan]' class='btn btn-outline-success btn-sm'
			      onClick='return confirm(\"Hapus data pelanggan $row[nama_pelanggan]?\")'>Delete</a></td>
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