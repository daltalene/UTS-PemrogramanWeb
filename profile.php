<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user'])) {
    header("location:login.php");
    exit();
}

date_default_timezone_set('Asia/Jakarta');
$username_lama = mysqli_real_escape_string($koneksi, $_SESSION['user']);

// Otomatis ubah status menjadi 'Selesai' jika durasi sewa sudah habis
$cek_aktif = mysqli_query($koneksi, "SELECT * FROM table_sewa WHERE username='$username_lama' AND status_sewa='Dikonfirmasi'");
while ($sewa_aktif = mysqli_fetch_assoc($cek_aktif)) {
    preg_match('/(\d+)\s*(Jam|Hari|Minggu)/i', $sewa_aktif['paket_sewa'], $matches);
    $durasi = isset($matches[1]) ? (int)$matches[1] : 1;
    $satuan = isset($matches[2]) ? strtolower($matches[2]) : 'hari';

    $jam_mulai = !empty($sewa_aktif['waktu_transaksi']) ? date('H:i:s', strtotime($sewa_aktif['waktu_transaksi'])) : '00:00:00';
    $timestamp_mulai = strtotime($sewa_aktif['tanggal_mulai'] . ' ' . $jam_mulai);

    if ($satuan == 'jam') {
        $timestamp_selesai = strtotime("+$durasi hours", $timestamp_mulai);
    } elseif ($satuan == 'minggu') {
        $timestamp_selesai = strtotime("+" . ($durasi * 7) . " days", $timestamp_mulai);
    } else {
        $timestamp_selesai = strtotime("+$durasi days", $timestamp_mulai);
    }

    if (time() >= $timestamp_selesai) {
        $id_selesai = (int)$sewa_aktif['id_sewa'];
        mysqli_query($koneksi, "UPDATE table_sewa SET status_sewa='Selesai' WHERE id_sewa='$id_selesai'");
    }
}

// Handler Batalkan Penyewaan (tanpa alert)
if (isset($_GET['batal_id'])) {
    $batal_id = (int)$_GET['batal_id'];
    mysqli_query($koneksi, "UPDATE table_sewa SET status_sewa='Dibatalkan' WHERE id_sewa='$batal_id' AND username='$username_lama'");
    header("location:profile.php");
    exit();
}

// Handler Ubah Profil (tanpa alert saat berhasil)
if (isset($_POST['simpan_profil'])) {
    $nama_baru     = mysqli_real_escape_string($koneksi, trim($_POST['nama_lengkap']));
    $email_baru    = mysqli_real_escape_string($koneksi, trim($_POST['email_baru']));
    $username_baru = mysqli_real_escape_string($koneksi, trim($_POST['username_baru']));
    $password_baru = mysqli_real_escape_string($koneksi, trim($_POST['password_baru']));

    if (!empty($username_baru)) {
        $cek_user = mysqli_query($koneksi, "SELECT * FROM table_user WHERE (username='$username_baru' OR email='$email_baru') AND username != '$username_lama'");
        if (mysqli_num_rows($cek_user) > 0) {
            header("location:profile.php?error=duplikat");
            exit();
        }

        if (!empty($password_baru)) {
            $update = mysqli_query($koneksi, "UPDATE table_user SET nama_lengkap='$nama_baru', email='$email_baru', username='$username_baru', password='$password_baru' WHERE username='$username_lama'");
        } else {
            $update = mysqli_query($koneksi, "UPDATE table_user SET nama_lengkap='$nama_baru', email='$email_baru', username='$username_baru' WHERE username='$username_lama'");
        }

        if ($update) {
            mysqli_query($koneksi, "UPDATE table_sewa SET username='$username_baru' WHERE username='$username_lama'");
            $_SESSION['user'] = $username_baru;
            header("location:profile.php");
            exit();
        }
    }
}

$data_user = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM table_user WHERE username='$username_lama'"));
$query_riwayat = mysqli_query($koneksi, "SELECT * FROM table_sewa WHERE username='$username_lama' ORDER BY id_sewa DESC");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Profile Saya - Carbook</title>
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
      .main-profile-content {
        padding-top: 135px !important;
        padding-bottom: 70px !important;
      }
      .profile-card {
        background-color: #1a1a1a !important;
        border: 1px solid #333 !important;
        border-radius: 12px;
      }
      .profile-card .form-control {
        background-color: #262626 !important;
        color: #ffffff !important;
        border: 1px solid #444 !important;
        height: 46px !important;
      }
      .profile-card .form-control:focus {
        border-color: #e50914 !important;
        box-shadow: none !important;
      }
      .profile-card label {
        color: #cccccc !important;
        font-size: 13px;
        font-weight: 600;
      }
      .avatar-circle {
        width: 75px;
        height: 75px;
        background: linear-gradient(135deg, #e50914, #8b0000);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
        font-weight: 700;
        color: #fff;
        margin: 0 auto 15px auto;
        text-transform: uppercase;
      }
      .history-table {
        width: 100% !important;
        min-width: 650px !important;
      }
      .history-table th {
        background-color: #222222 !important;
        color: #ffffff !important;
        border-color: #333 !important;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 13px 10px !important;
      }
      .history-table td {
        border-color: #2c2c2c !important;
        color: #e0e0e0 !important;
        padding: 13px 10px !important;
        vertical-align: middle !important;
        font-size: 13px;
      }
      .badge-status {
        background-color: rgba(1, 210, 142, 0.15);
        color: #01d28e;
        border: 1px solid #01d28e;
        padding: 4px 11px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        display: inline-block;
      }
      .badge-selesai {
        background-color: rgba(59, 130, 246, 0.15);
        color: #60a5fa;
        border: 1px solid #3b82f6;
        padding: 4px 11px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        display: inline-block;
      }
      .badge-batal {
        background-color: rgba(229, 9, 20, 0.15);
        color: #ff4d4d;
        border: 1px solid #e50914;
        padding: 4px 11px;
        border-radius: 20px;
        font-size: 11px;
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
        padding: 6px 12px !important;
      }
      .btn-sewa-lagi:hover {
        background-color: #b80710 !important;
      }
      .btn-batal {
        background-color: transparent !important;
        color: #bbbbbb !important;
        border: 1px solid #555 !important;
        border-radius: 6px !important;
        font-weight: 500 !important;
        font-size: 11px !important;
        padding: 5px 10px !important;
      }
      .btn-batal:hover {
        border-color: #e50914 !important;
        color: #ff4d4d !important;
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
            <li class="nav-item active"><a href="profile.php" class="nav-link">Profile</a></li>
            <li class="nav-item"><a href="logout.php" class="nav-link font-weight-bold">Logout</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div style="position: absolute; top: 82px; left: 0; right: 0; z-index: 10; pointer-events: none;">
      <div class="container">
        <span style="font-size: 13px; color: rgba(255, 255, 255, 0.75); letter-spacing: 0.5px; font-weight: 400;">
          Halo, <strong style="color: #ffffff; font-weight: 600;"><?php echo htmlspecialchars($_SESSION['user']); ?></strong>
        </span>
      </div>
    </div>

    <div class="container main-profile-content">
      <div class="row">
        
        <div class="col-lg-4 mb-4">
          <div class="p-4 profile-card shadow-sm">
            <div class="text-center mb-4 pb-3" style="border-bottom: 1px solid #333;">
              <div class="avatar-circle">
                <?php echo substr($_SESSION['user'], 0, 1); ?>
              </div>
              <h4 class="font-weight-bold text-white mb-0"><?php echo htmlspecialchars($data_user['nama_lengkap'] ?? $_SESSION['user']); ?></h4>
              <small class="text-muted d-block">@<?php echo htmlspecialchars($_SESSION['user']); ?></small>
              <small class="text-muted d-block mb-2"><?php echo htmlspecialchars(!empty($data_user['email']) ? $data_user['email'] : 'Email belum diatur'); ?></small>
              <span class="badge badge-secondary px-3 py-1" style="font-size: 11px;">Member CarBook</span>
            </div>

            <h5 class="font-weight-bold text-white mb-3">Ubah Profile</h5>

            <?php if (isset($_GET['error']) && $_GET['error'] == 'duplikat') { ?>
              <div class="alert alert-danger py-2" style="font-size: 12px;">Username atau Email sudah digunakan akun lain!</div>
            <?php } ?>

            <form action="profile.php" method="POST">
              <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="form-control" value="<?php echo htmlspecialchars($data_user['nama_lengkap'] ?? ''); ?>" required>
              </div>
              <div class="form-group">
                <label>Email</label>
                <input type="email" name="email_baru" class="form-control" value="<?php echo htmlspecialchars($data_user['email'] ?? ''); ?>" placeholder="nama@email.com" required>
              </div>
              <div class="form-group">
                <label>Username</label>
                <input type="text" name="username_baru" class="form-control" value="<?php echo htmlspecialchars($data_user['username']); ?>" required>
              </div>
              <div class="form-group">
                <label>Password Baru</label>
                <input type="password" name="password_baru" class="form-control" placeholder="Kosongkan jika tidak diubah">
                <small class="text-muted">Isi hanya jika ingin mengganti password.</small>
              </div>
              <button type="submit" name="simpan_profil" class="btn btn-primary btn-block py-2 font-weight-bold mt-3">
                Simpan Perubahan
              </button>
            </form>
          </div>
        </div>

        <div class="col-lg-8">
          <div class="p-4 profile-card shadow-sm">
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-4 pb-3" style="border-bottom: 1px solid #333;">
              <div class="mb-2 mb-sm-0">
                <h4 class="font-weight-bold text-white mb-1">Riwayat Penyewaan Saya</h4>
                <p class="text-muted mb-0" style="font-size: 13px;">Transaksi sewa kendaraan akun <b><?php echo htmlspecialchars($_SESSION['user']); ?></b></p>
              </div>
              <div>
                <a href="car.php" class="btn btn-primary font-weight-bold px-3 py-2" style="font-size: 13px;">+ Sewa Mobil</a>
              </div>
            </div>

            <div class="table-responsive">
              <?php if (mysqli_num_rows($query_riwayat) > 0) { ?>
                <table class="table table-bordered text-center mb-0 history-table">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Kendaraan</th>
                      <th>Paket & Durasi</th>
                      <th>Tgl Mulai</th>
                      <th>Total Biaya</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($query_riwayat)) {
                    ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td class="text-left">
                        <div class="d-flex align-items-center" style="gap: 10px;">
                          <img src="images/<?php echo htmlspecialchars($row['gambar']); ?>" width="65" height="45" style="object-fit: cover;" class="rounded border border-secondary">
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
                      <td>
                        <?php if ($row['status_sewa'] == 'Dibatalkan') { ?>
                          <span class="badge-batal">Dibatalkan</span>
                        <?php } elseif ($row['status_sewa'] == 'Selesai') { ?>
                          <span class="badge-selesai">Selesai</span>
                        <?php } else { ?>
                          <span class="badge-status"><?php echo htmlspecialchars($row['status_sewa']); ?></span>
                        <?php } ?>
                      </td>
                      <td>
                        <div class="d-flex flex-column" style="gap: 6px;">
                          <a href="car-single.php?id=<?php echo $row['id_mobil']; ?>" class="btn btn-sewa-lagi">Sewa Lagi</a>
                          <?php if ($row['status_sewa'] == 'Dikonfirmasi') { ?>
                            <a href="profile.php?batal_id=<?php echo $row['id_sewa']; ?>" class="btn btn-batal">Batalkan</a>
                          <?php } ?>
                        </div>
                      </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              <?php } else { ?>
                <div class="text-center py-5">
                  <h5 class="text-white font-weight-bold mb-2">Belum Ada Riwayat Penyewaan</h5>
                  <p class="text-muted mb-4" style="font-size: 14px;">Anda belum pernah melakukan transaksi penyewaan mobil. Yuk pilih armada favorit Anda sekarang!</p>
                  <a href="car.php" class="btn btn-primary font-weight-bold px-4 py-2">Lihat Katalog Mobil</a>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>

      </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>