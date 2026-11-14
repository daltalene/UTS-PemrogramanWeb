<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['admin'])) {
    header("location:login_admin.php");
    exit();
}

$id = isset($_GET['id']) ? $_GET['id'] : '';
$query = mysqli_query($koneksi, "SELECT * FROM table_mobil WHERE id_mobil='$id'");
$mobil = mysqli_fetch_assoc($query);

if (!$mobil) {
    header("location:admin.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_mobil      = mysqli_real_escape_string($koneksi, $_POST['nama_mobil']);
    $merk            = mysqli_real_escape_string($koneksi, $_POST['merk']);
    $harga_sewa      = mysqli_real_escape_string($koneksi, $_POST['harga_sewa']);
    $tahun_produksi  = mysqli_real_escape_string($koneksi, $_POST['tahun_produksi']);
    $warna           = mysqli_real_escape_string($koneksi, $_POST['warna']);
    $transmisi       = mysqli_real_escape_string($koneksi, $_POST['transmisi']);
    $kapasitas       = mysqli_real_escape_string($koneksi, $_POST['kapasitas']);
    $bahan_bakar     = mysqli_real_escape_string($koneksi, $_POST['bahan_bakar']);
    $jarak_tempuh    = mysqli_real_escape_string($koneksi, $_POST['jarak_tempuh']);
    $kapasitas_mesin = mysqli_real_escape_string($koneksi, $_POST['kapasitas_mesin']);
    $tenaga_maksimal = mysqli_real_escape_string($koneksi, $_POST['tenaga_maksimal']);
    $deskripsi       = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);

    $update = false;

    if (!empty($_FILES['foto']['name'])) {
        $foto_nama  = $_FILES['foto']['name'];
        $foto_tmp   = $_FILES['foto']['tmp_name'];
        $foto_baru  = time() . '_' . $foto_nama;
        $target_dir = "images/" . $foto_baru;

        if (move_uploaded_file($foto_tmp, $target_dir)) {
            $update = mysqli_query($koneksi, "UPDATE table_mobil SET 
                nama_mobil='$nama_mobil', merk='$merk', harga_sewa='$harga_sewa', gambar='$foto_baru',
                tahun_produksi='$tahun_produksi', warna='$warna', transmisi='$transmisi',
                kapasitas='$kapasitas', bahan_bakar='$bahan_bakar', jarak_tempuh='$jarak_tempuh',
                kapasitas_mesin='$kapasitas_mesin', tenaga_maksimal='$tenaga_maksimal', deskripsi='$deskripsi'
                WHERE id_mobil='$id'");
        }
    } else {
        $update = mysqli_query($koneksi, "UPDATE table_mobil SET 
            nama_mobil='$nama_mobil', merk='$merk', harga_sewa='$harga_sewa',
            tahun_produksi='$tahun_produksi', warna='$warna', transmisi='$transmisi',
            kapasitas='$kapasitas', bahan_bakar='$bahan_bakar', jarak_tempuh='$jarak_tempuh',
            kapasitas_mesin='$kapasitas_mesin', tenaga_maksimal='$tenaga_maksimal', deskripsi='$deskripsi'
            WHERE id_mobil='$id'");
    }

    if ($update) {
        header("location:admin.php?pesan=update_sukses");
        exit();
    } else {
        echo "Gagal memperbarui data: " . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Edit Mobil - Carbook Admin</title>
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
      .edit-container {
        padding-top: 120px;
        padding-bottom: 60px;
      }
      .edit-card {
        background-color: #1a1a1a !important;
        border: 1px solid #333 !important;
        border-radius: 12px;
        padding: 35px;
      }
      .edit-card label {
        color: #e0e0e0 !important;
        font-size: 13px;
      }
      .edit-card .form-control {
        background-color: #2b2b2b !important;
        color: #ffffff !important;
        border: 1px solid #444 !important;
      }
      .edit-card .form-control:focus {
        border-color: #e50914 !important;
        box-shadow: none !important;
      }
      .btn-simpan-update {
        background-color: #e50914 !important;
        color: #ffffff !important;
        border: none !important;
        font-weight: 700 !important;
        border-radius: 8px !important;
      }
      .btn-simpan-update:hover {
        background-color: #b80710 !important;
      }
      .btn-batal-dark {
        background-color: #3a3a3a !important;
        color: #ffffff !important;
        border: 1px solid #555 !important;
        font-weight: 700 !important;
        border-radius: 8px !important;
      }
      .btn-batal-dark:hover {
        background-color: #505050 !important;
        color: #ffffff !important;
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
            <li class="nav-item active"><a href="admin.php" class="nav-link">← Kembali ke Dashboard</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container edit-container">
      <div class="row justify-content-center">
        <div class="col-md-9 col-lg-8">
          <div class="edit-card shadow-lg">
            <h3 class="font-weight-bold text-white mb-4 text-center">Edit Data & Spesifikasi Mobil</h3>
            
            <form action="" method="POST" enctype="multipart/form-data">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label class="font-weight-bold">Nama Mobil</label>
                  <input type="text" name="nama_mobil" class="form-control" value="<?php echo htmlspecialchars($mobil['nama_mobil']); ?>" required>
                </div>
                <div class="form-group col-md-6">
                  <label class="font-weight-bold">Merek</label>
                  <input type="text" name="merk" class="form-control" value="<?php echo htmlspecialchars($mobil['merk']); ?>" required>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-4">
                  <label class="font-weight-bold">Harga per Hari (Rp)</label>
                  <input type="number" name="harga_sewa" class="form-control" value="<?php echo $mobil['harga_sewa']; ?>" required>
                </div>
                <div class="form-group col-md-4">
                  <label class="font-weight-bold">Tahun Produksi</label>
                  <input type="text" name="tahun_produksi" class="form-control" value="<?php echo htmlspecialchars($mobil['tahun_produksi'] ?? ''); ?>" placeholder="Contoh: 2023">
                </div>
                <div class="form-group col-md-4">
                  <label class="font-weight-bold">Warna Eksterior</label>
                  <input type="text" name="warna" class="form-control" value="<?php echo htmlspecialchars($mobil['warna'] ?? ''); ?>" placeholder="Contoh: Merah">
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-4">
                  <label class="font-weight-bold">Sistem Transmisi</label>
                  <input type="text" name="transmisi" class="form-control" value="<?php echo htmlspecialchars($mobil['transmisi'] ?? ''); ?>" placeholder="Contoh: Automatic 7-Speed">
                </div>
                <div class="form-group col-md-4">
                  <label class="font-weight-bold">Kapasitas Penumpang</label>
                  <input type="text" name="kapasitas" class="form-control" value="<?php echo htmlspecialchars($mobil['kapasitas'] ?? ''); ?>" placeholder="Contoh: 2 Kursi Sport">
                </div>
                <div class="form-group col-md-4">
                  <label class="font-weight-bold">Jenis Bahan Bakar</label>
                  <input type="text" name="bahan_bakar" class="form-control" value="<?php echo htmlspecialchars($mobil['bahan_bakar'] ?? ''); ?>" placeholder="Contoh: Pertamax Turbo">
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-4">
                  <label class="font-weight-bold">Jarak Tempuh</label>
                  <input type="text" name="jarak_tempuh" class="form-control" value="<?php echo htmlspecialchars($mobil['jarak_tempuh'] ?? ''); ?>" placeholder="Contoh: 8.500 KM">
                </div>
                <div class="form-group col-md-4">
                  <label class="font-weight-bold">Kapasitas Mesin</label>
                  <input type="text" name="kapasitas_mesin" class="form-control" value="<?php echo htmlspecialchars($mobil['kapasitas_mesin'] ?? ''); ?>" placeholder="Contoh: 6.000 cc V12">
                </div>
                <div class="form-group col-md-4">
                  <label class="font-weight-bold">Tenaga Maksimal</label>
                  <input type="text" name="tenaga_maksimal" class="form-control" value="<?php echo htmlspecialchars($mobil['tenaga_maksimal'] ?? ''); ?>" placeholder="Contoh: 660 HP">
                </div>
              </div>

              <div class="form-group">
                <label class="font-weight-bold">Deskripsi Kendaraan</label>
                <textarea name="deskripsi" class="form-control" rows="2"><?php echo htmlspecialchars($mobil['deskripsi'] ?? ''); ?></textarea>
              </div>

              <div class="form-group">
                <label class="font-weight-bold d-block">Foto Mobil Sekarang</label>
                <img src="images/<?php echo $mobil['gambar']; ?>" width="140" class="rounded border border-secondary mb-2">
              </div>

              <div class="form-group mb-4">
                <label class="font-weight-bold">Ganti Foto <span class="text-muted font-weight-normal">(Kosongkan jika tidak diubah)</span></label>
                <input type="file" name="foto" class="form-control-file text-light">
              </div>

              <div class="d-flex justify-content-between" style="gap: 10px;">
                <a href="admin.php" class="btn btn-batal-dark py-2 px-4 w-50">Batal</a>
                <button type="submit" class="btn btn-simpan-update py-2 px-4 w-50">Simpan Perubahan</button>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>