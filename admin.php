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
            <li class="nav-item"><a href="login.php" class="nav-link">Login</a></li>
            <li class="nav-item active"><a href="admin.php" class="nav-link">Login Admin</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <section class="ftco-section py-5">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h2 class="font-weight-bold">Kelola Data Mobil (CRUD)</h2>
          <button type="button" class="btn btn-primary font-weight-bold" data-toggle="modal" data-target="#modalTambah">
            + Tambah Mobil Baru
          </button>
        </div>

        <!-- Tabel Data Mobil -->
        <div class="table-responsive p-4 rounded shadow-sm border">
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
              <tr>
                <td>1</td>
                <td><img src="images/car-1.jpg" width="80" class="rounded"></td>
                <td>Mercedes SLK Roadster</td>
                <td>Mercedes-Benz</td>
                <td>Rp 7.500.000</td>
                <td>
                  <button class="btn btn-warning btn-sm font-weight-bold mr-1" data-toggle="modal" data-target="#modalEdit">Edit</button>
                  <a href="#" class="btn btn-danger btn-sm font-weight-bold" onclick="return confirm('Yakin ingin menghapus mobil ini?')">Hapus</a>
                </td>
              </tr>
              <tr>
                <td>2</td>
                <td><img src="images/car-2.jpg" width="80" class="rounded"></td>
                <td>Range Rover Sport SUV</td>
                <td>Land Rover</td>
                <td>Rp 10.500.000</td>
                <td>
                  <button class="btn btn-warning btn-sm font-weight-bold mr-1" data-toggle="modal" data-target="#modalEdit">Edit</button>
                  <a href="#" class="btn btn-danger btn-sm font-weight-bold" onclick="return confirm('Yakin ingin menghapus mobil ini?')">Hapus</a>
                </td>
              </tr>
              <tr>
                <td>3</td>
                <td><img src="images/car-3.jpg" width="80" class="rounded"></td>
                <td>McLaren 720S Supercar</td>
                <td>McLaren</td>
                <td>Rp 22.500.000</td>
                <td>
                  <button class="btn btn-warning btn-sm font-weight-bold mr-1" data-toggle="modal" data-target="#modalEdit">Edit</button>
                  <a href="#" class="btn btn-danger btn-sm font-weight-bold" onclick="return confirm('Yakin ingin menghapus mobil ini?')">Hapus</a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </section>

    <!-- Tambah Mobil -->
    <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title font-weight-bold">Tambah Data Mobil Baru</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="#" method="POST">
            <div class="modal-body">
              <div class="form-group">
                <label>Nama Mobil</label>
                <input type="text" class="form-control" placeholder="Contoh: Porsche 911 GT3" required>
              </div>
              <div class="form-group">
                <label>Merek</label>
                <input type="text" class="form-control" placeholder="Contoh: Porsche" required>
              </div>
              <div class="form-group">
                <label>Harga Sewa / Hari (Rp)</label>
                <input type="number" class="form-control" placeholder="15000000" required>
              </div>
              <div class="form-group">
                <label>Foto Mobil</label>
                <input type="file" class="form-control-file text-muted">
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

    <!-- Edit Mobil -->
    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title font-weight-bold">Edit Data Mobil</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="#" method="POST">
            <div class="modal-body">
              <div class="form-group">
                <label>Nama Mobil</label>
                <input type="text" class="form-control" value="Mercedes SLK Roadster" required>
              </div>
              <div class="form-group">
                <label>Merek</label>
                <input type="text" class="form-control" value="Mercedes-Benz" required>
              </div>
              <div class="form-group">
                <label>Harga Sewa / Hari (Rp)</label>
                <input type="number" class="form-control" value="7500000" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary font-weight-bold">Update Data</button>
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