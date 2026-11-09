<?php
session_start();
include 'koneksi.php';
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
  </head>
  <body class="bg-light">
    
    <!-- Navbar Biru Rapi -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary ftco-navbar-light awake" id="ftco-navbar" style="background: #1089ff !important; top: 0; position: relative;">
      <div class="container">
        <a class="navbar-brand text-white" href="index.php">Car<span style="color: #01d28e;">Book</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a href="index.php" class="nav-link text-white">Home</a></li>
            <li class="nav-item"><a href="car.php" class="nav-link text-white">Katalog</a></li>
            <li class="nav-item active"><a href="register.php" class="nav-link" style="color: #01d28e !important;">Login</a></li>
            <li class="nav-item"><a href="login_admin.php" class="nav-link text-white">Login Admin</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <section class="ftco-section py-5">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-5">
            <div class="bg-white p-5 rounded shadow-sm border">
              <h3 class="mb-4 font-weight-bold text-dark text-center">Daftar Akun Baru</h3>
              
              <form action="prosesRegister.php" method="POST">
                <div class="form-group text-left mb-3">
                  <label class="font-weight-bold text-dark">Nama Lengkap</label>
                  <input type="text" name="nama_lengkap" class="form-control" placeholder="Masukkan Nama Lengkap" required>
                </div>
                <div class="form-group text-left mb-3">
                  <label class="font-weight-bold text-dark">Username</label>
                  <input type="text" name="username" class="form-control" placeholder="Masukkan Username" required>
                </div>
                <div class="form-group text-left mb-4">
                  <label class="font-weight-bold text-dark">Password</label>
                  <input type="password" name="password" class="form-control" placeholder="Masukkan Password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block py-3 font-weight-bold">
                  Daftar Sekarang
                </button>
              </form>

              <div class="mt-4 text-center">
                <p class="mb-0 text-dark">Sudah punya akun? <a href="login.php" class="text-primary font-weight-bold">Login Pelanggan</a></p>
              </div>
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