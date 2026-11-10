<?php
session_start();
include 'koneksi.php';

$nama_mobil = $_POST['nama_mobil'];
$merek      = $_POST['merek'];
$harga      = $_POST['harga'];

$foto = $_FILES['foto']['name'];
$tmp  = $_FILES['foto']['tmp_name'];

//ini buat nyimpen gambar ke folder images
move_uploaded_file($tmp, "images/" . $foto);

mysqli_query($koneksi, "INSERT INTO table_mobil VALUES('', '$nama_mobil', '$merek', '$harga', '$foto')");

header("location:admin.php");
exit();
?>