<?php 
print '<!-- Set navbar fixed top --> 

<nav class="navbar navbar-expand-sm bg-success navbar-dark fixed-top"> 
  <div class="container-fluid">

    <a class="navbar-brand" href="/latihanaja/index.php">Laundry</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">

        <li class="nav-item">
          <a class="nav-link" href="/latihanaja/index.php">Home</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Data Master</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/latihanaja/pelanggan/pelanggan.php">Pelanggan</a></li>
            <li><a class="dropdown-item" href="/latihanaja/layanan/layanan.php">Layanan</a></li>
          </ul>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="/latihanaja/transaksi/transaksi.php">Data Transaksi</a>
        </li>	    

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Laporan</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/latihanaja/laporan/lap1.php">Laporan Transaksi Laundry</a></li>
            <li><a class="dropdown-item" href="/latihanaja/laporan/lap2.php">Laporan Penerimaan Per Pelanggan</a></li>
            <li><a class="dropdown-item" href="/latihanaja/laporan/lap3.php">Laporan Penerimaan Per Layanan</a></li>			
          </ul>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="/latihanaja/logout.php">Logout</a>
        </li>

      </ul>
    </div>
  </div>
</nav>';
?>