<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['StatusUser']) || 
   ($_SESSION['StatusUser'] != 'valid1' && $_SESSION['StatusUser'] != 'valid2')) {
    echo "Anda tidak berhak mengakses halaman ini!";
    exit;
}

// Cek apakah halaman diakses dari form POST
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

// Query edit data
$sql = "UPDATE pelanggan 
        SET nama_pelanggan = ?, 
            alamat = ?, 
            no_hp = ?
        WHERE id_pelanggan = ?";

$stmt = mysqli_prepare($koneksi, $sql);

mysqli_stmt_bind_param(
    $stmt, 
    "sssi", 
    $nama_pelanggan, 
    $alamat, 
    $no_hp, 
    $id_pelanggan
);

// Jalankan query
if (mysqli_stmt_execute($stmt)) {
    header("Location: ../pelanggan/pelanggan.php?pesan=edit_sukses");
    exit;
} else {
    echo "Data gagal diubah: " . mysqli_error($koneksi);
}

mysqli_close($koneksi);
?>