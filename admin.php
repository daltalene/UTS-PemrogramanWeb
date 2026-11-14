<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['admin'])) {
    header("location:login_admin.php");
    exit();
}

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
    
    <style>
      .main-admin-content {
        padding-top: 120px !important;
        padding-bottom: 60px !important;
      }
      .btn-tambah-mobil {
        background-color: #01d28e !important;
        color: #ffffff !important;
        border: none !important;
        padding: 10px 22px !important;
        border-radius: 8px !important;
        font-weight: 700 !important;
        display: inline-block !important;
        box-shadow: 0 4px 12px rgba(1, 210, 142, 0.4) !important;
        cursor: pointer !important;
      }
      .btn-tambah-mobil:hover {
        background-color: #00b377 !important;
        color: #ffffff !important;
      }
      .btn-batal-dark {
        background-color: #3a3a3a !important;
        color: #ffffff !important;
        border: 1px solid #555 !important;
      }
      .modal-content {
        background-color: #1a1a1a !important;
        color: #ffffff !important;
        border: 1px solid #333 !important;
      }
      .modal-header, .modal-footer {
        border-color: #333 !important;
      }
      .modal .form-control {
        background-color: #2b2b2b !important;
        color: #ffffff !important;
        border: 1px solid #444 !important;
      }
      .modal label {
        color: #ffffff !important;
        font-size: 13px;
      }
    </style>
  </head>
  <body>

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
              <li class="nav-item"><a href="logout.php" class="nav-link font-weight-bold" onclick="return confirm('Yakin ingin logout?')">Logout</a></li>
            <?php } ?>

          </ul>
        </div>
      </div>
    </nav>

    <div class="container main-admin-content">
      <div class="d-flex justify-content-between align-items-center mb-4 p-3 rounded" style="background-color: #1a1a1a; border: 1px solid #333;">
        <h3 class="font-weight-bold text-white mb-0">Kelola Data Mobil</h3>
        <p class="text-muted mb-0" style="font-size: 14px;">
          Selamat datang kembali, <span class="font-weight-bold" style="color: #ffcc00;"><?php echo htmlspecialchars($_SESSION['admin']); ?></span>!
        </p>
        <button type="button" class="btn btn-tambah-mobil" data-toggle="modal" data-target="#modalTambah">
          + Tambah Mobil Baru
        </button>
      </div>

      <!-- Tabel Data Mobil -->
      <div class="table-responsive p-4 rounded shadow-sm border" style="background-color: #1a1a1a; border-color: #333 !important;">
        <table class="table table-bordered table-striped text-center align-middle mb-0 text-white">
          <thead class="thead-dark">
            <tr>
              <th>NO</th>
              <th>FOTO</th>
              <th>NAMA MOBIL</th>
              <th>MEREK</th>
              <th>SPESIFIKASI RINGKAS</th>
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
              <td class="align-middle text-left" style="font-size: 12px;">
                <div>• Transmisi: <b><?php echo !empty($baris['transmisi']) ? $baris['transmisi'] : 'Automatic'; ?></b></div>
                <div>• Kapasitas: <b><?php echo !empty($baris['kapasitas']) ? $baris['kapasitas'] : '2 Kursi'; ?></b></div>
                <div>• BBM: <b><?php echo !empty($baris['bahan_bakar']) ? $baris['bahan_bakar'] : 'Bensin'; ?></b></div>
              </td>
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

    <!-- Modal Form Tambah Mobil Lengkap dengan Spesifikasi -->
    <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title font-weight-bold text-white">Tambah Data & Spesifikasi Mobil</h5>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="tambah_mobil.php" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="form-row">
                <div class="form-group col-md-6 text-left">
                  <label class="font-weight-bold">Nama Mobil</label>
                  <input type="text" name="nama_mobil" class="form-control" placeholder="Contoh: Porsche 911 GT3" required>
                </div>
                <div class="form-group col-md-6 text-left">
                  <label class="font-weight-bold">Merek</label>
                  <input type="text" name="merk" class="form-control" placeholder="Contoh: Porsche" required>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-4 text-left">
                  <label class="font-weight-bold">Harga per Hari (Rp)</label>
                  <input type="number" name="harga_sewa" class="form-control" placeholder="Contoh: 15000000" required>
                </div>
                <div class="form-group col-md-4 text-left">
                  <label class="font-weight-bold">Tahun Produksi</label>
                  <input type="text" name="tahun_produksi" class="form-control" placeholder="Contoh: 2023" required>
                </div>
                <div class="form-group col-md-4 text-left">
                  <label class="font-weight-bold">Warna</label>
                  <input type="text" name="warna" class="form-control" placeholder="Contoh: Hitam Metalik" required>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-4 text-left">
                  <label class="font-weight-bold">Transmisi</label>
                  <select name="transmisi" class="form-control" required>
                    <option value="Automatic">Automatic</option>
                    <option value="Manual">Manual</option>
                    <option value="Automatic DCT">Automatic DCT</option>
                  </select>
                </div>
                <div class="form-group col-md-4 text-left">
                  <label class="font-weight-bold">Kapasitas Penumpang</label>
                  <input type="text" name="kapasitas" class="form-control" placeholder="Contoh: 2 Kursi / 4 Kursi" required>
                </div>
                <div class="form-group col-md-4 text-left">
                  <label class="font-weight-bold">Jenis Bahan Bakar</label>
                  <input type="text" name="bahan_bakar" class="form-control" placeholder="Contoh: Pertamax Turbo" required>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-4 text-left">
                  <label class="font-weight-bold">Jarak Tempuh (Odometer)</label>
                  <input type="text" name="jarak_tempuh" class="form-control" placeholder="Contoh: 12.000 KM" required>
                </div>
                <div class="form-group col-md-4 text-left">
                  <label class="font-weight-bold">Kapasitas Mesin</label>
                  <input type="text" name="kapasitas_mesin" class="form-control" placeholder="Contoh: 4.000 cc Boxer-6" required>
                </div>
                <div class="form-group col-md-4 text-left">
                  <label class="font-weight-bold">Tenaga Maksimal</label>
                  <input type="text" name="tenaga_maksimal" class="form-control" placeholder="Contoh: 502 HP" required>
                </div>
              </div>

              <div class="form-group text-left">
                <label class="font-weight-bold">Deskripsi Singkat Kendaraan</label>
                <textarea name="deskripsi" class="form-control" rows="2" placeholder="Jelaskan kondisi dan keunggulan mobil..."></textarea>
              </div>

              <div class="form-group text-left mb-0">
                <label class="font-weight-bold">Foto Mobil</label>
                <input type="file" name="foto" class="form-control-file text-muted" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-batal-dark" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-tambah-mobil">Simpan Data</button>
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