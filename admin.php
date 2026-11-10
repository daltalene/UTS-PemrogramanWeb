<?php
session_start();
include 'koneksi.php';

// Proteksi Halaman Admin
if (!isset($_SESSION['admin'])) {
    header("location:login_admin.php");
    exit();
}

// Ambil data mobil dari database
$hasil = mysqli_query($koneksi, "SELECT * FROM table_mobil ORDER BY id_mobil DESC");
?>
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
    <link rel="stylesheet" href="css/dark-theme.css">
  </head>
  <body>

    <!-- Navbar Dark Theme -->
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
      <div class="container">
        <a class="navbar-brand" href="index.php">Car<span>Book Admin</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
            <li class="nav-item"><a href="car.php" class="nav-link">Katalog</a></li>

            <?php if (isset($_SESSION['admin'])) { ?>
              <li class="nav-item active"><a href="admin.php" class="nav-link">Dashboard Admin</a></li>
              <li class="nav-item"><a href="#" class="nav-link">Halo, <?php echo $_SESSION['admin']; ?></a></li>
              <li class="nav-item"><a href="logout.php" class="nav-link font-weight-bold" onclick="return confirm('Yakin ingin logout?')">Logout</a></li>
            <?php } ?>

          </ul>
        </div>
      </div>
    </nav>
    <!-- END navbar -->

    <section class="ftco-section py-5">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h2 class="font-weight-bold mb-0">Kelola Data Mobil (CRUD)</h2>
          <button type="button" class="btn btn-primary font-weight-bold" data-toggle="modal" data-target="#modalTambah">
            + Tambah Mobil Baru
          </button>
        </div>

        <!-- Tabel Data Mobil Dark Theme -->
        <div class="table-responsive p-4 rounded shadow-sm border">
          <table class="table table-bordered table-striped text-center align-middle mb-0">
            <thead class="thead-dark">
              <tr>
                <th>NO</th>
                <th>FOTO</th>
                <th>NAMA MOBIL</th>
                <th>MEREK</th>
                <th>HARGA / HARI</th>
                <th>AKSI</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              while ($baris = mysqli_fetch_assoc($hasil)) {
              ?>
              <tr>
                <td class="align-middle"><?php echo $no++; ?></td>
                <td class="align-middle"><img src="images/<?php echo $baris['gambar']; ?>" width="80" class="rounded"></td>
                <td class="align-middle font-weight-bold"><?php echo $baris['nama_mobil']; ?></td>
                <td class="align-middle"><?php echo $baris['merk']; ?></td>
                <td class="align-middle">Rp <?php echo number_format($baris['harga_sewa'], 0, ',', '.'); ?></td>
                <td class="align-middle">
                  <div class="d-flex justify-content-center align-items-center" style="gap: 5px;">
                    <a href="car-single.php?id=<?php echo $baris['id_mobil']; ?>" class="btn btn-outline-secondary btn-sm">Lihat</a>
                    <a href="update_mobil.php?id=<?php echo $baris['id_mobil']; ?>" class="btn btn-warning btn-sm font-weight-bold">Ubah</a>
                    <a href="hapus_mobil.php?id=<?php echo $baris['id_mobil']; ?>" class="btn btn-danger btn-sm font-weight-bold" onclick="return confirm('Hapus data mobil ini?')">Hapus</a>
                  </div>
                </td>
              </tr>
              <?php 
              } 
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </section>

    <!-- Modal Form Tambah Mobil -->
    <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title font-weight-bold">Tambah Data Mobil Baru</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="tambah_mobil.php" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="form-group text-left">
                <label class="font-weight-bold">Nama Mobil</label>
                <input type="text" name="nama_mobil" class="form-control" placeholder="Contoh: Porsche 911 GT3" required>
              </div>
              <div class="form-group text-left">
                <label class="font-weight-bold">Merek</label>
                <input type="text" name="merek" class="form-control" placeholder="Contoh: Porsche" required>
              </div>
              <div class="form-group text-left">
                <label class="font-weight-bold">Harga per Hari (Rp)</label>
                <input type="number" name="harga" class="form-control" placeholder="Contoh: 15000000" required>
              </div>
              <div class="form-group text-left">
                <label class="font-weight-bold">Foto Mobil</label>
                <input type="file" name="foto" class="form-control-file text-muted" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary font-weight-bold">Simpan Data</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>