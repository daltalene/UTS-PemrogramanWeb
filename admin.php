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
            <li class="nav-item active"><a href="admin.php" class="nav-link" style="color: #01d28e !important;">Admin</a></li>
          </ul>
        </div>
      </div>
    </nav>

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
          <table class="table table-bordered table-striped text-center">
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
              
              <tr>
                <td>1</td>
                <td><img src="images/car-1.jpg" width="80" class="rounded"></td>
                <td>Mercedes Grand Sedan</td>
                <td>Chevrolet</td>
                <td>$500</td>
                <td>
                  <a href="#" class="btn btn-warning btn-sm font-weight-bold">Edit</a>
                  <a href="#" class="btn btn-danger btn-sm font-weight-bold" onclick="return confirm('Yakin hapus?')">Hapus</a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </section>

    <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title font-weight-bold">Tambah Mobil Baru</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="admin.php" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="form-group">
                <label class="font-weight-bold">Nama Mobil</label>
                <input type="text" name="nama_mobil" class="form-control" required>
              </div>
              <div class="form-group">
                <label class="font-weight-bold">Merek</label>
                <input type="text" name="merek" class="form-control" required>
              </div>
              <div class="form-group">
                <label class="font-weight-bold">Harga per Hari ($)</label>
                <input type="number" name="harga" class="form-control" required>
              </div>
              <div class="form-group">
                <label class="font-weight-bold">Foto Mobil</label>
                <input type="file" name="foto" class="form-control-file" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
              <button type="submit" name="simpan" class="btn btn-primary">Simpan Mobil</button>
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