<?php
session_start();

// Hanya admin yang boleh menghapus pelanggan
    if (!isset($_SESSION['StatusUser']) || $_SESSION['StatusUser'] != 'valid1' && $_SESSION['StatusUser'] != 'valid2') {
        echo "Anda tidak berhak mengakses halaman ini!";
    exit;
}

// Cek apakah id_pelanggan ada di URL
if (!isset($_GET['id_pelanggan'])) {
    echo "ID pelanggan tidak ditemukan!";
    exit;
}

// Ambil id pelanggan
$id_pelanggan = $_GET['id_pelanggan'];

// Buka koneksi database
require(__DIR__ . '/../koneksi.php');

// Query hapus data
$sql = "DELETE FROM pelanggan WHERE id_pelanggan = ?";

$stmt = mysqli_prepare($koneksi, $sql);
mysqli_stmt_bind_param($stmt, "i", $id_pelanggan);

if (mysqli_stmt_execute($stmt)) {
    header("Location: pelanggan.php?pesan=hapus_sukses");
    exit;
} else {
    echo "Data gagal dihapus: " . mysqli_error($koneksi);
}

mysqli_close($koneksi);
?>