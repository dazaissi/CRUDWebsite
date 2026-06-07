<?php
session_start();

// Hanya admin yang boleh menghapus layanan
if (!isset($_SESSION['StatusUser']) || $_SESSION['StatusUser'] != 'valid1' && $_SESSION['StatusUser'] != 'valid2') {
    echo "Anda tidak berhak mengakses halaman ini!";
    exit;
}

// Cek apakah id_layanan ada di URL
if (!isset($_GET['id_transaksi'])) {
    echo "ID transaksi tidak ditemukan!";
    exit;
}

// Ambil id transaksi
$id_transaksi = $_GET['id_transaksi'];

// Buka koneksi database
require('../koneksi.php');

// Query hapus data
$sql = "DELETE FROM transaksi WHERE id_transaksi = ?";

$stmt = mysqli_prepare($koneksi, $sql);
mysqli_stmt_bind_param($stmt, "i", $id_transaksi);

if (mysqli_stmt_execute($stmt)) {
    header("Location: ../transaksi/transaksi.php?pesan=hapus_sukses");
    exit;
} else {
    echo "Data gagal dihapus: " . mysqli_error($koneksi);
}

mysqli_close($koneksi);
?>