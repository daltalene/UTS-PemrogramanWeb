<?php
session_start();
if (isset($_SESSION['user'])) {
    header("location:car.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Register User - Carbook</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/dark-theme.css">
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
      <div class="container">
        <a class="navbar-brand" href="index.php">Car<span>Book</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
            <li class="nav-item"><a href="car.php" class="nav-link">Katalog</a></li>
            <li class="nav-item"><a href="login.php" class="nav-link">Login</a></li>
            <li class="nav-item"><a href="login_admin.php" class="nav-link">Login Admin</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center mt-5">
          <div class="col-md-5">
            <div class="p-4 rounded shadow-sm border" style="background-color: #1a1a1a; border-color: #333 !important;">
              <form action="prosesRegister.php" method="POST">
                <div class="form-group">
                  <label class="font-weight-bold text-white">Nama Lengkap</label>
                  <input type="text" name="nama_lengkap" class="form-control" placeholder="Masukkan Nama Lengkap" required>
                </div>

                <div class="form-group">
                  <label class="font-weight-bold text-white">Email</label>
                  <input type="email" name="email" class="form-control" placeholder="Masukkan Alamat Email" required>
                </div>

                <div class="form-group">
                  <label class="font-weight-bold text-white">Username</label>
                  <input type="text" name="username" class="form-control" placeholder="Minimal 5 karakter" pattern="[a-zA-Z0-9]{5,}" title="Minimal 5 karakter huruf atau angka tanpa spasi" required>
                </div>

                <div class="form-group">
                  <label class="font-weight-bold text-white">Password</label>
                  <input type="password" name="password" class="form-control" placeholder="Minimal 8 karakter" minlength="8" required>
                </div>

                <button type="submit" name="register" class="btn btn-primary btn-block py-3 font-weight-bold mt-4">
                  Daftar Sekarang
                </button>

                <p class="text-center text-white mt-3 mb-0" style="font-size: 14px;">
                  Sudah punya akun? <a href="login.php" class="font-weight-bold">Login Pelanggan</a>
                </p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>