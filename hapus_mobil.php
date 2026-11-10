<?php
session_start();
include 'koneksi.php';

$id = $_GET['id'];

mysqli_query($koneksi, "DELETE FROM table_mobil WHERE id_mobil='$id'");

header("location:admin.php");
exit();
?>