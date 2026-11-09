<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['admin'])) {
    header("location:login_admin.php");
    exit();
}

$id    = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM table_mobil WHERE id_mobil='$id'");
$baris = mysqli_fetch_assoc($query);
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
  </head>
  <body class="bg-light">
    
    <!-- Navbar Biru -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary ftco-navbar-light awake" id="ftco-navbar" style="background: #1089ff !important; top: 0; position: relative;">
      <div class="container">
        <a class="navbar-brand text-white" href="index.php">Car<span style="color: #01d28e;">Book Admin</span></a>
        <div class="collapse navbar-collapse" id="ftco-nav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a href="admin.php" class="nav-link text-white">← Kembali ke Dashboard</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <section class="ftco-section py-5">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-6 bg-white p-5 rounded shadow-sm border">
            <h3 class="mb-4 font-weight-bold text-dark">Edit Data Mobil</h3>
            
            <form action="prosesUpdate.php" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="id_mobil" value="<?php echo $baris['id_mobil']; ?>">
              
              <div class="form-group mb-3">
                <label class="font-weight-bold text-dark">Nama Mobil</label>
                <input type="text" name="nama_mobil" class="form-control" value="<?php echo $baris['nama_mobil']; ?>" required>
              </div>
              <div class="form-group mb-3">
                <label class="font-weight-bold text-dark">Merek</label>
                <input type="text" name="merek" class="form-control" value="<?php echo $baris['merk']; ?>" required>
              </div>
              <div class="form-group mb-3">
                <label class="font-weight-bold text-dark">Harga per Hari (Rp)</label>
                <input type="number" name="harga" class="form-control" value="<?php echo $baris['harga_sewa']; ?>" required>
              </div>
              <div class="form-group mb-4">
                <label class="font-weight-bold text-dark">Foto Mobil Sekarang</label><br>
                <img src="images/<?php echo $baris['gambar']; ?>" width="120" class="rounded mb-3 border"><br>
                <label class="font-weight-bold text-dark">Ganti Foto (Kosongkan jika tidak diubah)</label>
                <input type="file" name="foto" class="form-control-file">
              </div>
              
              <button type="submit" class="btn btn-primary font-weight-bold px-4">Simpan Perubahan</button>
              <a href="admin.php" class="btn btn-secondary font-weight-bold px-4">Batal</a>
            </form>
          </div>
        </div>
      </div>
    </section>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>