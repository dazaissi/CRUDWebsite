<?php
session_start();

if (!isset($_SESSION['StatusUser']) || 
   ($_SESSION['StatusUser'] != 'valid1')) {
    echo "Anda tidak berhak mengakses halaman ini!";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    echo "Akses tidak valid!";
    exit;
}

require('../koneksi.php');

$id_layanan = $_POST['id_layanan'];
$nama_layanan = $_POST['nama_layanan'];
$harga_kg = $_POST['harga_kg'];

if ($id_layanan == "" || $nama_layanan == "" || $harga_kg == "") {
    echo "Semua data wajib diisi!";
    exit;
}

$sql = "UPDATE layanan 
        SET nama_layanan = ?, 
            harga_kg = ?
        WHERE id_layanan = ?";

$stmt = mysqli_prepare($koneksi, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "sii",
    $nama_layanan,
    $harga_kg,
    $id_layanan
);

if (mysqli_stmt_execute($stmt)) {
    header("Location: ../layanan/layanan.php?pesan=edit_sukses");
    exit;
} else {
    echo "Data gagal diubah: " . mysqli_error($koneksi);
}

mysqli_close($koneksi);
?>