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
$id_transaksi = $_POST['id_transaksi'];
$id_pelanggan = $_POST['id_pelanggan'];
$id_layanan = $_POST['id_layanan'];
$tanggal_transaksi = $_POST['tanggal_transaksi'];
$berat = $_POST['berat'];
$total_harga = $_POST['total_harga'];
$status = $_POST['status'];

// Validasi sederhana
if ($id_transaksi == "" || $id_pelanggan == "" || $id_layanan == "" || $tanggal_transaksi == "" || $berat == "" || $total_harga == "" || $status == "") {
    echo "Semua data wajib diisi!";
    exit;
}

// Query tambah data
$sql = "INSERT INTO transaksi 
        (id_transaksi, id_pelanggan, id_layanan, tanggal_transaksi, berat, total_harga, status)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($koneksi, $sql);
mysqli_stmt_bind_param(
    $stmt,
    "iiisdis",
    $id_transaksi,
    $id_pelanggan,
    $id_layanan,
    $tanggal_transaksi,
    $berat,
    $total_harga,
    $status
);

if (mysqli_stmt_execute($stmt)) {
    header("Location: ../transaksi/transaksi.php?pesan=tambah_sukses");
    exit;
} else {
    echo "Data gagal ditambahkan: " . mysqli_error($koneksi);
}

mysqli_close($koneksi);
?>