<?php
session_start();

// Admin dan kasir boleh tambah pelanggan
if (!isset($_SESSION['StatusUser']) || 
   ($_SESSION['StatusUser'] != 'valid1')) {
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
$id_layanan = $_POST['id_layanan'];
$nama_layanan = $_POST['nama_layanan'];
$harga_kg = $_POST['harga_kg'];

// Validasi sederhana
if ($id_layanan == "" || $nama_layanan == "" || $harga_kg == "") {
    echo "Semua data wajib diisi!";
    exit;
}

// Query tambah data
$sql = "INSERT INTO layanan 
        (id_layanan, nama_layanan, harga_kg)
        VALUES (?, ?, ?)";

$stmt = mysqli_prepare($koneksi, $sql);
mysqli_stmt_bind_param($stmt, "ssd", $id_layanan, $nama_layanan, $harga_kg);

if (mysqli_stmt_execute($stmt)) {
    header("Location: ../layanan/layanan.php?pesan=tambah_sukses");
    exit;
} else {
    echo "Data gagal ditambahkan: " . mysqli_error($koneksi);
}

mysqli_close($koneksi);
?>