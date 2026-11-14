<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user'])) {
    header("location:login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username      = mysqli_real_escape_string($koneksi, $_SESSION['user']);
    $id_mobil      = mysqli_real_escape_string($koneksi, $_POST['id_mobil']);
    $nama_mobil    = mysqli_real_escape_string($koneksi, $_POST['nama_mobil']);
    $merk          = mysqli_real_escape_string($koneksi, $_POST['merk']);
    $gambar        = mysqli_real_escape_string($koneksi, $_POST['gambar']);
    $paket_sewa    = mysqli_real_escape_string($koneksi, $_POST['paket_sewa']);
    $tanggal_mulai = mysqli_real_escape_string($koneksi, $_POST['tanggal_mulai']);
    $total_harga   = (int)$_POST['total_harga'];
    $nama_pemesan  = mysqli_real_escape_string($koneksi, $_POST['nama_pemesan']);
    $no_hp         = mysqli_real_escape_string($koneksi, $_POST['no_hp']);

    $query = "INSERT INTO table_sewa 
              (username, id_mobil, nama_mobil, merk, gambar, paket_sewa, tanggal_mulai, total_harga, nama_pemesan, no_hp, status_sewa) 
              VALUES 
              ('$username', '$id_mobil', '$nama_mobil', '$merk', '$gambar', '$paket_sewa', '$tanggal_mulai', '$total_harga', '$nama_pemesan', '$no_hp', 'Dikonfirmasi')";

    if (mysqli_query($koneksi, $query)) {
        header("location:profile.php");
        exit();
    } else {
        echo "Gagal memproses penyewaan: " . mysqli_error($koneksi);
    }
} else {
    header("location:car.php");
    exit();
}
?>