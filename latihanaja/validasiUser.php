<?php
session_start();
require('koneksi.php');

// Pastikan form dikirim dengan method POST
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: login.php");
    exit;
}

// Ambil data dari form login
$id_admin = $_POST['id_admin'];
$password = $_POST['password'];

// Cari user berdasarkan id_admin
$sql = "SELECT id_admin, username, password
        FROM admin
        WHERE id_admin = ?";

$stmt = mysqli_prepare($koneksi, $sql);
mysqli_stmt_bind_param($stmt, "i", $id_admin);
mysqli_stmt_execute($stmt);

$query = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($query);

// Jika user ditemukan
if ($data) {

    // Jika password benar
    if ($data['password'] == $password) {

        // Kasir
        if ($data['id_admin'] == '1') {
            $_SESSION['StatusUser'] = 'valid1';
            $_SESSION['id_admin'] = $data['id_admin'];
            $_SESSION['username'] = $data['username'];

            header("Location: index.php");
            exit;
        }

        // Admin
        else if ($data['id_admin'] == '2') {
            $_SESSION['StatusUser'] = 'valid2';
            $_SESSION['id_admin'] = $data['id_admin'];
            $_SESSION['username'] = $data['username'];

            header("Location: index.php");
            exit;
        }

        // Kalau id_admin bukan 1 atau 2
        else {
            $_SESSION['StatusUser'] = 'invalid';
            header("Location: login.php?pesan=id_admin_salah");
            exit;
        }

    } else {
        $_SESSION['StatusUser'] = 'invalid';
        header("Location: login.php?pesan=password_salah");
        exit;
    }

} else {
    $_SESSION['StatusUser'] = 'invalid';
    header("Location: login.php?pesan=user_tidak_ditemukan");
    exit;
}
?>