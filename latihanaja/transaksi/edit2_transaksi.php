<?php
session_start();

if (!isset($_SESSION['StatusUser']) || 
   ($_SESSION['StatusUser'] != 'valid1' && $_SESSION['StatusUser'] != 'valid2')) {
    echo "Anda tidak berhak mengakses halaman ini!";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    echo "Akses tidak valid!";
    exit;
}

require(__DIR__ . '/../koneksi.php');

$id_transaksi = $_POST['id_transaksi'];
$id_pelanggan = $_POST['id_pelanggan'];
$id_layanan = $_POST['id_layanan'];
$tanggal_transaksi = $_POST['tanggal_transaksi'];
$berat = $_POST['berat'];
$total_harga = $_POST['total_harga'];
$status = $_POST['status'];

if ($id_transaksi == "" || $id_pelanggan == "" || $id_layanan == "" || 
    $tanggal_transaksi == "" || $berat == "" || $total_harga == "" || $status == "") {
    echo "Semua data wajib diisi!";
    exit;
}

$sql = "UPDATE transaksi 
        SET id_pelanggan = ?, 
            id_layanan = ?, 
            tanggal_transaksi = ?, 
            berat = ?, 
            total_harga = ?, 
            status = ?
        WHERE id_transaksi = ?";

$stmt = mysqli_prepare($koneksi, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "iisdisi",
    $id_pelanggan,
    $id_layanan,
    $tanggal_transaksi,
    $berat,
    $total_harga,
    $status,
    $id_transaksi
);

if (mysqli_stmt_execute($stmt)) {
    header("Location: transaksi.php?pesan=edit_sukses");
    exit;
} else {
    echo "Data gagal diubah: " . mysqli_error($koneksi);
}

mysqli_close($koneksi);
?>