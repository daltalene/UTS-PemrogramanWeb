<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_lengkap = mysqli_real_escape_string($koneksi, trim($_POST['nama_lengkap']));
    $email        = mysqli_real_escape_string($koneksi, trim($_POST['email']));
    $username     = mysqli_real_escape_string($koneksi, trim($_POST['username']));
    $password     = mysqli_real_escape_string($koneksi, trim($_POST['password']));

    //validasi agar sesuai aturan di form register
    if (empty($nama_lengkap) || empty($email) || empty($username) || empty($password)) {
        echo "<script>alert('Semua kolom wajib diisi!'); window.location='register.php';</script>";
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Format email tidak valid!'); window.location='register.php';</script>";
        exit();
    }

    if (!preg_match('/^[a-zA-Z0-9]{5,}$/', $username)) {
        echo "<script>alert('Username minimal 5 karakter); window.location='register.php';</script>";
        exit();
    }

    if (strlen($password) < 8) {
        echo "<script>alert('Password minimal 8 karakter!'); window.location='register.php';</script>";
        exit();
    }

    //cek apakah username atau email sudah terdaftar
    $cek = mysqli_query($koneksi, "SELECT * FROM table_user WHERE username='$username' OR email='$email'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Username atau Email sudah terdaftar! Silakan gunakan yang lain.'); window.location='register.php';</script>";
        exit();
    }

    //simpan data user baru ke database
    $simpan = mysqli_query($koneksi, "INSERT INTO table_user (nama_lengkap, email, username, password) VALUES ('$nama_lengkap', '$email', '$username', '$password')");

    if ($simpan) {
        echo "<script>alert('Registrasi berhasil! Silakan login dengan akun Anda.'); window.location='login.php';</script>";
    } else {
        echo "<script>alert('Registrasi gagal: " . mysqli_error($koneksi) . "'); window.location='register.php';</script>";
    }
} else {
    header("location:register.php");
    exit();
}
?>