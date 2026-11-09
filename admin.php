<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Dashboard Admin - Carbook</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body class="bg-light">
    
    <!-- Navbar Biru Tua Theme -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary ftco-navbar-light awake" id="ftco-navbar" style="background: #1089ff !important; top: 0; position: relative;">
      <div class="container">
        <a class="navbar-brand text-white" href="index.php">Car<span style="color: #01d28e;">Book Admin</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a href="index.php" class="nav-link text-white">Home</a></li>
            <li class="nav-item"><a href="car.php" class="nav-link text-white">Katalog</a></li>
            <li class="nav-item"><a href="login.php" class="nav-link text-white">Login</a></li>
            <li class="nav-item active"><a href="admin.php" class="nav-link" style="color: #01d28e !important;">Login Admin</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- END navbar -->

    <section class="ftco-section bg-light py-5">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h2 class="font-weight-bold text-dark">Kelola Data Mobil (CRUD)</h2>
          <!-- Tombol Pemicu Modal Tambah Mobil -->
          <button type="button" class="btn btn-primary font-weight-bold" data-toggle="modal" data-target="#modalTambah">
            + Tambah Mobil Baru
          </button>
        </div>

        <!-- Tabel Data Mobil -->
        <div class="table-responsive bg-white p-4 rounded shadow-sm border">
          <table class="table table-bordered table-striped text-center align-middle">
            <thead class="thead-dark">
              <tr>
                <th>No</th>
                <th>Foto</th>
                <th>Nama Mobil</th>
                <th>Merek</th>
                <th>Harga / Hari</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <!-- Contoh Data Dummy (Nanti diganti perulangan PHP oleh Backend) -->
              <tr>
                <td>1</td>
                <td><img src="images/car-1.jpg" width="80" class="rounded"></td>
                <td>Mercedes SLK Roadster</td>
                <td>Mercedes-Benz</td>
                <td>Rp 7.500.000</td>
                <td>
                  <a href="#" class="btn btn-warning btn-sm font-weight-bold