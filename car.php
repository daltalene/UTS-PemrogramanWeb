<?php
session_start();
include 'koneksi.php';

// Ambil semua data mobil dari database
$hasil = mysqli_query($koneksi, "SELECT * FROM table_mobil ORDER BY id_mobil DESC");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Carbook - Katalog Mobil</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="css/ionicons.min.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/dark-theme.css">
  </head>
  <body>
    
    <!-- Navbar Dark Theme Multi-Level -->
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
      <div class="container">
        <a class="navbar-brand" href="index.php">Car<span>Book</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
            <li class="nav-item active"><a href="car.php" class="nav-link">Katalog</a></li>

            <?php if (isset($_SESSION['admin'])) { ?>
              <li class="nav-item"><a href="admin.php" class="nav-link">Dashboard Admin</a></li>
              <li class="nav-item"><a href="#" class="nav-link">Halo, <?php echo $_SESSION['admin']; ?></a></li>
              <li class="nav-item"><a href="logout.php" class="nav-link font-weight-bold" onclick="return confirm('Yakin ingin logout?')">Logout</a></li>

            <?php } elseif (isset($_SESSION['user'])) { ?>
              <li class="nav-item"><a href="#" class="nav-link">Halo, <?php echo $_SESSION['user']; ?></a></li>
              <li class="nav-item"><a href="logout.php" class="nav-link font-weight-bold" onclick="return confirm('Yakin ingin logout?')">Logout</a></li>

            <?php } else { ?>
              <li class="nav-item"><a href="register.php" class="nav-link">Register</a></li>
              <li class="nav-item"><a href="login.php" class="nav-link">Login</a></li>
              <li class="nav-item"><a href="login_admin.php" class="nav-link">Login Admin</a></li>
            <?php } ?>

          </ul>
        </div>
      </div>
    </nav>
    
    <section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_3.jpg'); background-position: center; min-height: 350px;">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-start py-5">
          <div class="col-md-9 pb-5">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Katalog <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-3 bread">Pilih Mobil Impian Anda</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section">
    	<div class="container">
    		<div class="row">
          
          <?php 
          // Perulangan while untuk menampilkan data mobil dinamis dari database
          while ($baris = mysqli_fetch_assoc($hasil)) { 
          ?>
    			<div class="col-md-4 mb-4">
    				<div class="car-wrap rounded">
    					<div class="img rounded d-flex align-items-end" style="background-image: url(images/<?php echo $baris['gambar']; ?>); height: 240px; background-size: cover; background-position: center;"></div>
    					<div class="text p-4">
    						<h2 class="mb-0"><a href="car-single.php?id=<?php echo $baris['id_mobil']; ?>"><?php echo $baris['nama_mobil']; ?></a></h2>
    						<div class="d-flex mb-3">
	    						<span class="cat"><?php echo $baris['merk']; ?></span>
	    						<p class="price ml-auto">Rp <?php echo number_format($baris['harga_sewa'], 0, ',', '.'); ?> <span>/hari</span></p>
    						</div>
    						<p class="d-flex mb-0 d-block">
                  <a href="car-single.php?id=<?php echo $baris['id_mobil']; ?>" class="btn btn-primary py-2 mr-1">Book now</a> 
                  <a href="car-single.php?id=<?php echo $baris['id_mobil']; ?>" class="btn btn-secondary py-2 ml-1">Details</a>
                </p>
    					</div>
    				</div>
    			</div>
          <?php } ?>

    		</div>
    	</div>
    </section>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>