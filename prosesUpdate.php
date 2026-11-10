<?php
session_start();
include 'koneksi.php';

$id         = $_POST['id_mobil'];
$nama_mobil = $_POST['nama_mobil'];
$merek      = $_POST['merek'];
$harga      = $_POST['harga'];

$foto = $_FILES['foto']['name'];
$tmp  = $_FILES['foto']['tmp_name'];

if ($foto != "") {
//ini kalau gambar diganti biar langsung dipindahin ke folder images
    move_uploaded_file($tmp, "images/" . $foto);
    mysqli_query($koneksi, "UPDATE table_mobil SET nama_mobil='$nama_mobil', merk='$merek', harga_sewa='$harga', gambar='$foto' WHERE id_mobil='$id'");
} else {
//ini kalau gambar tidak diganti
    mysqli_query($koneksi, "UPDATE table_mobil SET nama_mobil='$nama_mobil', merk='$merek', harga_sewa='$harga' WHERE id_mobil='$id'");
}

header("location:admin.php");
exit();
?>