<?php
session_start();
include 'koneksi.php';

$nama_lengkap = trim($_POST['nama_lengkap']);
$username     = trim($_POST['username']);
$password     = $_POST['password'];

// 1. Validasi Username (Min 5 karakter, hanya huruf & angka, tanpa spasi/simbol)
if (!preg_match('/^[a-zA-Z0-9]{5,}$/', $username)) {
    echo "<script>
            alert('Username Minimal 5 karakter. Hanya boleh huruf dan angka, tanpa spasi atau karakter khusus.');
            window.history.back();
          </script>";
    exit();
}

// 2. Validasi Password (Minimal 8 karakter)
if (strlen($password) < 8) {
    echo "<script>
            alert('Password Minimal 8 karakter.');
            window.history.back();
          </script>";
    exit();
}

// 3. Cek apakah username sudah pernah terdaftar di database
$cek_user = mysqli_query($koneksi, "SELECT * FROM table_user WHERE username='$username'");
if (mysqli_num_rows($cek_user) > 0) {
    echo "<script>
            alert('Username sudah digunakan, silakan pilih username yang lain');
            window.history.back();
          </script>";
    exit();
}

// 4. Simpan ke database jika semua validasi lolos
$query = mysqli_query($koneksi, "INSERT INTO table_user VALUES('', '$username', '$password', '$nama_lengkap')");

if ($query) {
    echo "<script>
            alert('Registrasi berhasil! Silakan login.');
            window.location='login.php';
          </script>";
} else {
    echo "<script>
            alert('Gagal mendaftar, terjadi kesalahan.');
            window.history.back();
          </script>";
}
?>