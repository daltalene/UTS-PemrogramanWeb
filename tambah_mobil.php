<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['admin'])) {
    header("location:login_admin.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_mobil      = mysqli_real_escape_string($koneksi, $_POST['nama_mobil']);
    $merk            = mysqli_real_escape_string($koneksi, $_POST['merk']);
    $harga_sewa      = mysqli_real_escape_string($koneksi, $_POST['harga_sewa']);
    $tahun_produksi  = mysqli_real_escape_string($koneksi, $_POST['tahun_produksi']);
    $warna           = mysqli_real_escape_string($koneksi, $_POST['warna']);
    $transmisi       = mysqli_real_escape_string($koneksi, $_POST['transmisi']);
    $kapasitas       = mysqli_real_escape_string($koneksi, $_POST['kapasitas']);
    $bahan_bakar     = mysqli_real_escape_string($koneksi, $_POST['bahan_bakar']);
    $jarak_tempuh    = mysqli_real_escape_string($koneksi, $_POST['jarak_tempuh']);
    $kapasitas_mesin = mysqli_real_escape_string($koneksi, $_POST['kapasitas_mesin']);
    $tenaga_maksimal = mysqli_real_escape_string($koneksi, $_POST['tenaga_maksimal']);
    $deskripsi       = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);

    $foto_nama  = $_FILES['foto']['name'];
    $foto_tmp   = $_FILES['foto']['tmp_name'];
    $foto_baru  = time() . '_' . $foto_nama;
    $target_dir = "images/" . $foto_baru;

    if (move_uploaded_file($foto_tmp, $target_dir)) {
        $query = "INSERT INTO table_mobil 
                  (nama_mobil, merk, harga_sewa, gambar, tahun_produksi, warna, transmisi, kapasitas, bahan_bakar, jarak_tempuh, kapasitas_mesin, tenaga_maksimal, deskripsi) 
                  VALUES 
                  ('$nama_mobil', '$merk', '$harga_sewa', '$foto_baru', '$tahun_produksi', '$warna', '$transmisi', '$kapasitas', '$bahan_bakar', '$jarak_tempuh', '$kapasitas_mesin', '$tenaga_maksimal', '$deskripsi')";
        
        $simpan = mysqli_query($koneksi, $query);

        if ($simpan) {
            header("location:admin.php?pesan=sukses");
        } else {
            echo "Gagal menyimpan data: " . mysqli_error($koneksi);
        }
    } else {
        echo "Gagal mengunggah foto.";
    }
} else {
    header("location:admin.php");
}
?>