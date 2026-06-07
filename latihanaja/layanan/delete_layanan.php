<?php
session_start();

// Hanya admin yang boleh menghapus layanan
if (!isset($_SESSION['StatusUser']) || $_SESSION['StatusUser'] != 'valid1') {
    echo "Anda tidak berhak mengakses halaman ini!";
    exit;
}

// Cek apakah id_layanan ada di URL
if (!isset($_GET['id_layanan'])) {
    echo "ID layanan tidak ditemukan!";
    exit;
}

// Ambil id layanan
$id_layanan = $_GET['id_layanan'];

// Buka koneksi database
require(__DIR__ . '/../koneksi.php');

// Query hapus data
$sql = "DELETE FROM layanan WHERE id_layanan = ?";

$stmt = mysqli_prepare($koneksi, $sql);
mysqli_stmt_bind_param($stmt, "i", $id_layanan);

if (mysqli_stmt_execute($stmt)) {
    header("Location: layanan.php?pesan=hapus_sukses");
    exit;
} else {
    echo "Data gagal dihapus: " . mysqli_error($koneksi);
}

mysqli_close($koneksi);
?>