<?php
session_start();
include 'koneksi.php';

if (isset($_SESSION['user'])) {
    header("location:car.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Login User - Carbook</title>
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
            <li class="nav-item"><a href="register.php" class="nav-link">Register</a></li>
            <li class="nav-item active"><a href="login.php" class="nav-link">Login</a></li>
            <li class="nav-item"><a href="login_admin.php" class="nav-link">Login Admin</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <section class="ftco-section py-5">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-6 block-9 mb-md-5">
            <h2 class="text-center mb-4 font-weight-bold">Login Pelanggan</h2>
            
            <?php if (isset($_GET['pesan']) && $_GET['pesan'] == 'gagal') { ?>
              <div class="alert alert-danger text-left p-3 mb-4" role="alert" style="border-radius: 8px; font-size: 14px;">
                Username atau password salah.
              </div>
            <?php } ?>

            <form action="prosesLogin.php" method="POST" class="p-5 contact-form rounded shadow-sm border">
              <input type="hidden" name="level" value="user">
              <div class="form-group">
                <label for="username" class="font-weight-bold">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Masukkan Username" required>
              </div>
              <div class="form-group">
                <label for="password" class="font-weight-bold">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan Password" required>
              </div>
              <div class="form-group mb-4">
                <input type="submit" value="Masuk Ke Akun" class="btn btn-primary py-3 px-5 btn-block font-weight-bold">
              </div>
              <div class="text-center">
                <p class="mb-0">Belum punya akun? <a href="register.php" class="font-weight-bold">Daftar Sekarang</a></p>
              </div>
            </form>

          </div>
        </div>
      </div>
    </section>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>