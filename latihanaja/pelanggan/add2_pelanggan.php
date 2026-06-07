<?php
session_start();

// Admin dan kasir boleh tambah pelanggan
if (!isset($_SESSION['StatusUser']) || 
   ($_SESSION['StatusUser'] != 'valid1' && $_SESSION['StatusUser'] != 'valid2')) {
    echo "Anda tidak berhak mengakses halaman ini!";
    exit;
}

// Cek apakah data dikirim dari form POST
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    echo "Akses tidak valid!";
    exit;
}

// Buka koneksi database
require('../koneksi.php');

// Mengambil data dari form
$id_pelanggan = $_POST['id_pelanggan'];
$nama_pelanggan = $_POST['nama_pelanggan'];
$alamat = $_POST['alamat'];
$no_hp = $_POST['no_hp'];

// Validasi sederhana
if ($id_pelanggan == "" || $nama_pelanggan == "" || $alamat == "" || $no_hp == "") {
    echo "Semua data wajib diisi!";
    exit;
}

// Query tambah data
$sql = "INSERT INTO pelanggan 
        (id_pelanggan, nama_pelanggan, alamat, no_hp)
        VALUES (?, ?, ?, ?)";

$stmt = mysqli_prepare($koneksi, $sql);
mysqli_stmt_bind_param($stmt, "ssss", $id_pelanggan, $nama_pelanggan, $alamat, $no_hp);

if (mysqli_stmt_execute($stmt)) {
    header("Location: ../pelanggan/pelanggan.php?pesan=tambah_sukses");
    exit;
} else {
    echo "Data gagal ditambahkan: " . mysqli_error($koneksi);
}

mysqli_close($koneksi);
?>