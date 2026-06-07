<?php
session_start();

if (!isset($_SESSION['StatusUser']) || 
   ($_SESSION['StatusUser'] != 'valid1' && $_SESSION['StatusUser'] != 'valid2')) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home Laundry</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="http://localhost/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script src="http://localhost/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>

<body>

<?php require('navigasi.php'); ?>

<div class="container" style="margin-top:80px">
  <h2>Selamat Datang di Sistem Laundry</h2>

  <?php
  if ($_SESSION['StatusUser'] == 'valid1') {
      echo "<div class='alert alert-success'>Anda login sebagai Admin</div>";
  } else {
      echo "<div class='alert alert-info'>Anda login sebagai Kasir</div>";
  }
  ?>
</div>

</body>
</html>