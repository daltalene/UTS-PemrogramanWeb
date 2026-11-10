<?php
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];
$level    = $_POST['level'];

if ($level == 'admin') {
    $hasil = mysqli_query($koneksi, "SELECT * FROM table_admin WHERE username='$username' AND password='$password'");
    if (mysqli_num_rows($hasil) > 0) {
        $_SESSION['admin'] = $username;
        header("location:admin.php");
        exit();
    } else {
        header("location:login_admin.php?pesan=gagal");
        exit();
    }
} else {
    $hasil = mysqli_query($koneksi, "SELECT * FROM table_user WHERE username='$username' AND password='$password'");
    if (mysqli_num_rows($hasil) > 0) {
        $_SESSION['user'] = $username;
        header("location:car.php");
        exit();
    } else {
        header("location:login.php?pesan=gagal");
        exit();
    }
}
?>