<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user'])) {
    header("location:login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] != 'POST' || empty($_POST['id_mobil'])) {
    header("location:car.php");
    exit();
}

$id_mobil      = htmlspecialchars($_POST['id_mobil']);
$nama_mobil    = htmlspecialchars($_POST['nama_mobil']);
$merk          = htmlspecialchars($_POST['merk']);
$gambar        = htmlspecialchars($_POST['gambar']);
$paket_sewa    = htmlspecialchars($_POST['paket_sewa']);
$tanggal_mulai = htmlspecialchars($_POST['tanggal_mulai']);
$total_harga   = (int)$_POST['total_harga'];
$nama_pemesan  = htmlspecialchars($_POST['nama_pemesan']);
$no_hp         = htmlspecialchars($_POST['no_hp']);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Pembayaran - Carbook</title>
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
      .payment-container {
        padding-top: 130px;
        padding-bottom: 70px;
      }
      .dark-card {
        background-color: #1a1a1a !important;
        border: 1px solid #333 !important;
        border-radius: 12px;
      }
      .pay-option-box {
        background-color: #241819;
        border: 2px solid #e50914;
        border-radius: 10px;
        padding: 20px;
      }
      .pay-option-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
      }
      .brand-badges {
        display: flex;
        align-items: center;
        gap: 6px;
        flex-wrap: wrap;
      }
      .card-badge {
        font-size: 11px;
        font-weight: 700;
        padding: 3px 8px;
        border-radius: 4px;
        letter-spacing: 0.5px;
      }
      .badge-visa { background-color: #1a1f71; color: #ffffff; }
      .badge-mc { background-color: #eb001b; color: #ffffff; }
      .badge-jcb { background-color: #0b4ea2; color: #ffffff; }
      .badge-amex { background-color: #2e77bc; color: #ffffff; }

      .dark-card label {
        color: #cccccc !important;
        font-size: 12.5px;
        font-weight: 600;
        margin-bottom: 6px;
      }
      .dark-card .form-control {
        background-color: #262626 !important;
        color: #ffffff !important;
        border: 1px solid #444 !important;
        height: 46px !important;
        border-radius: 8px;
      }
      .dark-card .form-control:focus {
        border-color: #e50914 !important;
        box-shadow: none !important;
      }
      .dark-card .form-control::placeholder {
        color: #888888 !important;
      }
      .summary-row {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid #2b2b2b;
        font-size: 13.5px;
      }
      .summary-row:last-child {
        border-bottom: none;
      }
      .btn-batal-dark {
        background-color: #333333 !important;
        color: #ffffff !important;
        border: 1px solid #555 !important;
        border-radius: 8px;
        font-weight: 600;
      }
      .btn-batal-dark:hover {
        background-color: #484848 !important;
        color: #ffffff !important;
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
            <li class="nav-item active"><a href="car.php" class="nav-link">Katalog</a></li>
            <li class="nav-item"><a href="profile.php" class="nav-link">Profile</a></li>
            <li class="nav-item"><a href="logout.php" class="nav-link font-weight-bold" onclick="return confirm('Yakin ingin logout?')">Logout</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div style="position: absolute; top: 82px; left: 0; right: 0; z-index: 10; pointer-events: none;">
      <div class="container">
        <span style="font-size: 13px; color: rgba(255, 255, 255, 0.75); letter-spacing: 0.5px;">
          Halo, <strong style="color: #ffffff;"><?php echo htmlspecialchars($_SESSION['user']); ?></strong>
        </span>
      </div>
    </div>

    <div class="container payment-container">
      <div class="row">
        
        <div class="col-lg-7 mb-4">
          <div class="p-4 dark-card shadow-sm">
            <h4 class="font-weight-bold text-white mb-1">Metode Pembayaran</h4>
            <p class="text-muted mb-4" style="font-size: 13px;">Masukkan detail kartu Anda untuk menyelesaikan transaksi penyewaan</p>

            <form action="proses_sewa.php" method="POST">
              <input type="hidden" name="id_mobil" value="<?php echo $id_mobil; ?>">
              <input type="hidden" name="nama_mobil" value="<?php echo $nama_mobil; ?>">
              <input type="hidden" name="merk" value="<?php echo $merk; ?>">
              <input type="hidden" name="gambar" value="<?php echo $gambar; ?>">
              <input type="hidden" name="paket_sewa" value="<?php echo $paket_sewa; ?>">
              <input type="hidden" name="tanggal_mulai" value="<?php echo $tanggal_mulai; ?>">
              <input type="hidden" name="total_harga" value="<?php echo $total_harga; ?>">
              <input type="hidden" name="nama_pemesan" value="<?php echo $nama_pemesan; ?>">
              <input type="hidden" name="no_hp" value="<?php echo $no_hp; ?>">
              <input type="hidden" name="metode_pembayaran" value="Credit/Debit Card">

              <div class="pay-option-box mb-4">
                <div class="pay-option-header pb-3 mb-3" style="border-bottom: 1px solid #3d282a;">
                  <span class="font-weight-bold text-white" style="font-size: 15px;">Credit / Debit Card</span>
                  <div class="brand-badges">
                    <span class="card-badge badge-visa">VISA</span>
                    <span class="card-badge badge-mc">Mastercard</span>
                  </div>
                </div>

                <div class="form-group mb-3">
                  <label>Nomor Kartu (Bank Card No.)</label>
                  <input type="text" id="inputCardNo" class="form-control" placeholder="4532 1234 5678 9010" maxlength="19" required>
                </div>

                <div class="form-group mb-3">
                  <label>Cardholder Name</label>
                  <input type="text" id="inputCardName" class="form-control" placeholder="Masukkan nama sesuai kartu" value="<?php echo $nama_pemesan; ?>" required>
                </div>

                <div class="form-row">
                  <div class="form-group col-6 mb-0">
                    <label>Expiration Date</label>
                    <input type="text" id="inputCardExp" class="form-control" placeholder="MM/YY" maxlength="5" required>
                  </div>
                  <div class="form-group col-6 mb-0">
                    <label>CVV / CVC</label>
                    <input type="password" id="inputCardCvv" class="form-control" placeholder="***" maxlength="4" required>
                  </div>
                </div>
              </div>

              <div class="d-flex justify-content-between" style="gap: 12px;">
                <a href="car.php" class="btn btn-batal-dark py-3 px-4 w-50 text-center">Batalkan</a>
                <button type="submit" class="btn btn-primary py-3 px-4 w-50 font-weight-bold">Bayar Sekarang →</button>
              </div>
            </form>
          </div>
        </div>

        <div class="col-lg-5">
          <div class="p-4 dark-card shadow-sm">
            <h5 class="font-weight-bold text-white mb-3 pb-3" style="border-bottom: 1px solid #333;">Ringkasan Penyewaan</h5>

            <div class="d-flex align-items-center mb-3 pb-3" style="border-bottom: 1px solid #2b2b2b; gap: 14px;">
              <img src="images/<?php echo $gambar; ?>" width="95" height="65" style="object-fit: cover;" class="rounded border border-secondary">
              <div>
                <span style="color: #e50914; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;"><?php echo $merk; ?></span>
                <h5 class="font-weight-bold text-white mb-0"><?php echo $nama_mobil; ?></h5>
              </div>
            </div>

            <div class="summary-row">
              <span class="text-muted">Paket &amp; Layanan</span>
              <span class="text-white font-weight-bold"><?php echo $paket_sewa; ?></span>
            </div>
            <div class="summary-row">
              <span class="text-muted">Tanggal Mulai</span>
              <span class="text-white font-weight-bold"><?php echo date('d M Y', strtotime($tanggal_mulai)); ?></span>
            </div>
            <div class="summary-row">
              <span class="text-muted">Nama Pemesan</span>
              <span class="text-white font-weight-bold"><?php echo $nama_pemesan; ?></span>
            </div>
            <div class="summary-row">
              <span class="text-muted">No. WhatsApp / HP</span>
              <span class="text-white font-weight-bold"><?php echo $no_hp; ?></span>
            </div>

            <div class="mt-3 pt-3 d-flex justify-content-between align-items-center" style="border-top: 1px dashed #444;">
              <span class="text-muted font-weight-bold">Total Pembayaran</span>
              <span class="font-weight-bold" style="font-size: 24px; color: #ffcc00;">
                Rp <?php echo number_format($total_harga, 0, ',', '.'); ?>
              </span>
            </div>
          </div>
        </div>

      </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script>
      $(document).ready(function() {
        $('#inputCardNo').on('input', function() {
          var val = $(this).val().replace(/\D/g, '').substring(0, 16);
          var formatted = val.match(/.{1,4}/g);
          $(this).val(formatted ? formatted.join(' ') : '');
        });

        $('#inputCardExp').on('input', function() {
          var val = $(this).val().replace(/\D/g, '').substring(0, 4);
          $(this).val(val.length >= 3 ? val.substring(0, 2) + '/' + val.substring(2) : val);
        });
      });
    </script>
  </body>
</html>