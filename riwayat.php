<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user'])) {
    header("location:login.php");
    exit();
}

$username = mysqli_real_escape_string($koneksi, $_SESSION['user']);
$query = mysqli_query($koneksi, "SELECT * FROM table_sewa WHERE username='$username' ORDER BY id_sewa DESC");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Riwayat Penyewaan - Carbook</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/dark-theme.css">

    <style>
      body {
        background-color: #121212 !important;
        color: #ffffff !important;
      }
      .main-history-content {
        padding-top: 120px !important;
        padding-bottom: 70px !important;
      }
      .history-card {
        background-color: #1a1a1a !important;
        border: 1px solid #333 !important;
        border-radius: 12px;
      }
      .history-table {
        width: 100% !important;
        min-width: 750px !important;
      }
      .history-table th {
        background-color: #222222 !important;
        color: #ffffff !important;
        border-color: #333 !important;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 14px 12px !important;
      }
      .history-table td {
        border-color: #2c2c2c !important;
        color: #e0e0e0 !important;
        padding: 14px 12px !important;
        vertical-align: middle !important;
        font-size: 14px;
      }
      .badge-status {
        background-color: rgba(1, 210, 142, 0.15);
        color: #01d28e;
        border: 1px solid #01d28e;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        display: inline-block;
      }
      .btn-sewa-lagi {
        background-color: #e50914 !important;
        color: #ffffff !important;
        border: none !important;
        border-radius: 6px !important;
        font-weight: 600 !important;
        font-size: 12px !important;
        padding: 6px 14px !important;
      }
      .btn-sewa-lagi:hover {
        background-color: #b80710 !important;
      }
    </style>
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
            <li class="nav-item active"><a href="riwayat.php" class="nav-link">Riwayat Sewa</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Halo, <?php echo htmlspecialchars($_SESSION['user']); ?></a></li>
            <li class="nav-item"><a href="logout.php" class="nav-link font-weight-bold" onclick="return confirm('Yakin ingin logout?')">Logout</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container main-history-content">
      <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 p-4 history-card">
        <div class="mb-3 mb-md-0">
          <h3 class="font-weight-bold text-white mb-1">Riwayat Penyewaan Saya</h3>
          <p class="text-muted mb-0" style="font-size: 14px;">Daftar seluruh aktivitas dan transaksi sewa kendaraan akun <b><?php echo htmlspecialchars($_SESSION['user']); ?></b></p>
        </div>
        <a href="car.php" class="btn btn-primary font-weight-bold px-4 py-2">+ Sewa Mobil Baru</a>
      </div>

      <div class="table-responsive p-4 history-card shadow-sm">
        <?php if (mysqli_num_rows($query) > 0) { ?>
          <table class="table table-bordered text-center mb-0 history-table">
            <thead>
              <tr>
                <th>No</th>
                <th>Kendaraan</th>
                <th>Detail Paket & Durasi</th>
                <th>Tanggal Mulai</th>
                <th>Total Biaya</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              while ($row = mysqli_fetch_assoc($query)) {
              ?>
              <tr>
                <td><?php echo $no++; ?></td>
                <td class="text-left">
                  <div class="d-flex align-items-center" style="gap: 12px;">
                    <img src="images/<?php echo htmlspecialchars($row['gambar']); ?>" width="75" height="50" style="object-fit: cover;" class="rounded border border-secondary">
                    <div>
                      <div class="font-weight-bold text-white"><?php echo htmlspecialchars($row['nama_mobil']); ?></div>
                      <small class="text-muted"><?php echo htmlspecialchars($row['merk']); ?></small>
                    </div>
                  </div>
                </td>
                <td class="text-left">
                  <div class="font-weight-bold text-white"><?php echo htmlspecialchars($row['paket_sewa']); ?></div>
                  <small class="text-muted">Pemesan: <?php echo htmlspecialchars($row['nama_pemesan']); ?></small>
                </td>
                <td><?php echo date('d M Y', strtotime($row['tanggal_mulai'])); ?></td>
                <td class="font-weight-bold" style="color: #ffcc00;">Rp <?php echo number_format($row['total_harga'], 0, ',', '.'); ?></td>
                <td><span class="badge-status"><?php echo htmlspecialchars($row['status_sewa']); ?></span></td>
                <td>
                  <a href="car-single.php?id=<?php echo $row['id_mobil']; ?>" class="btn btn-sewa-lagi">Sewa Lagi</a>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        <?php } else { ?>
          <div class="text-center py-5">
            <h5 class="text-white font-weight-bold mb-2">Belum Ada Riwayat Penyewaan</h5>
            <p class="text-muted mb-4">Anda belum pernah melakukan transaksi penyewaan mobil. Yuk pilih armada favorit Anda sekarang!</p>
            <a href="car.php" class="btn btn-primary font-weight-bold px-4 py-2">Lihat Katalog Mobil</a>
          </div>
        <?php } ?>
      </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>