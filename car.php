<?php
session_start();
include 'koneksi.php';

$hasil = mysqli_query($koneksi, "SELECT * FROM table_mobil ORDER BY id_mobil DESC");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Carbook - Katalog Mobil</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="css/ionicons.min.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/dark-theme.css">

    <style>
      .btn-batal-dark {
        background-color: #3a3a3a !important;
        color: #ffffff !important;
        border: 1px solid #555 !important;
      }
      .btn-batal-dark:hover {
        background-color: #505050 !important;
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

            <?php if (isset($_SESSION['admin'])) { ?>
              <li class="nav-item"><a href="admin.php" class="nav-link">Dashboard Admin</a></li>
              <li class="nav-item"><a href="logout.php" class="nav-link font-weight-bold" onclick="return confirm('Yakin ingin logout?')">Logout</a></li>

            <?php } elseif (isset($_SESSION['user'])) { ?>
              <li class="nav-item"><a href="profile.php" class="nav-link">Profile</a></li>
              <li class="nav-item"><a href="logout.php" class="nav-link font-weight-bold" onclick="return confirm('Yakin ingin logout?')">Logout</a></li>

            <?php } else { ?>
              <li class="nav-item"><a href="login.php" class="nav-link">Login</a></li>
              <li class="nav-item"><a href="login_admin.php" class="nav-link">Login Admin</a></li>
            <?php } ?>

          </ul>
        </div>
      </div>
    </nav>

<?php if (isset($_SESSION['admin']) || isset($_SESSION['user'])) { ?>
  <div style="position: absolute; top: 82px; left: 0; right: 0; z-index: 10; pointer-events: none;">
    <div class="container">
      <span style="font-size: 13px; color: rgba(255, 255, 255, 0.75); letter-spacing: 0.5px; font-weight: 400;">
        <?php 
          if (isset($_SESSION['admin'])) {
            echo "Halo, <strong style='color: #ffffff; font-weight: 600;'>" . htmlspecialchars($_SESSION['admin']) . "</strong>";
          } elseif (isset($_SESSION['user'])) {
            echo "Halo, <strong style='color: #ffffff; font-weight: 600;'>" . htmlspecialchars($_SESSION['user']) . "</strong>";
          }
        ?>
      </span>
    </div>
  </div>
<?php } ?>
    
    <section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_katalog.jpg'); background-position: center; min-height: 350px;">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-start py-5">
          <div class="col-md-9 pb-5">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Katalog <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-3 bread">Pilih Mobil Impian Anda</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section">
    	<div class="container">
    		<div class="row">
          
          <?php 
          date_default_timezone_set('Asia/Jakarta');
          $waktu_sekarang = time();

          while ($baris = mysqli_fetch_assoc($hasil)) { 
            $id_mbl = $baris['id_mobil'];
            $sedang_disewa = false;
            $info_selesai = "";

            $cek_sewa = mysqli_query($koneksi, "SELECT * FROM table_sewa WHERE id_mobil='$id_mbl' AND status_sewa='Dikonfirmasi' ORDER BY id_sewa DESC LIMIT 1");
            
            if (mysqli_num_rows($cek_sewa) > 0) {
              $data_sewa = mysqli_fetch_assoc($cek_sewa);
              
              preg_match('/(\d+)\s*(Jam|Hari|Minggu)/i', $data_sewa['paket_sewa'], $matches);
              $durasi = isset($matches[1]) ? (int)$matches[1] : 1;
              $satuan = isset($matches[2]) ? strtolower($matches[2]) : 'hari';

              $jam_mulai = date('H:i:s', strtotime($data_sewa['waktu_transaksi']));
              $timestamp_mulai = strtotime($data_sewa['tanggal_mulai'] . ' ' . $jam_mulai);

              if ($satuan == 'jam') {
                $timestamp_selesai = strtotime("+$durasi hours", $timestamp_mulai);
              } elseif ($satuan == 'minggu') {
                $timestamp_selesai = strtotime("+" . ($durasi * 7) . " days", $timestamp_mulai);
              } else {
                $timestamp_selesai = strtotime("+$durasi days", $timestamp_mulai);
              }

              if ($waktu_sekarang < $timestamp_selesai) {
                $sedang_disewa = true;
                $info_selesai = date('d M Y, H:i', $timestamp_selesai);
              }
            }
          ?>
    			<div class="col-md-4 mb-4">
    				<div class="car-wrap rounded position-relative">
              <div style="position: absolute; top: 15px; right: 15px; z-index: 5;">
                <?php if ($sedang_disewa) { ?>
                  <span class="badge badge-danger px-3 py-2 shadow" style="font-size: 12px; border-radius: 20px;">
                    Sedang Disewa
                  </span>
                <?php } else { ?>
                  <span class="badge badge-success px-3 py-2 shadow" style="font-size: 12px; border-radius: 20px; background-color: #01d28e;">
                    Tersedia
                  </span>
                <?php } ?>
              </div>

    					<div class="img rounded d-flex align-items-end" style="background-image: url(images/<?php echo $baris['gambar']; ?>); height: 240px; background-size: cover; background-position: center; <?php echo $sedang_disewa ? 'filter: grayscale(40%);' : ''; ?>"></div>
    					<div class="text p-4">
    						<h2 class="mb-0"><a href="car-single.php?id=<?php echo $baris['id_mobil']; ?>"><?php echo $baris['nama_mobil']; ?></a></h2>
    						<div class="d-flex mb-3">
	    						<span class="cat"><?php echo $baris['merk']; ?></span>
	    						<p class="price ml-auto">Rp <?php echo number_format($baris['harga_sewa'], 0, ',', '.'); ?> <span>/hari</span></p>
    						</div>

                <?php if ($sedang_disewa) { ?>
                  <p class="text-warning mb-2" style="font-size: 12px;">Tersedia kembali: <b><?php echo $info_selesai; ?> WIB</b></p>
                  <p class="d-flex mb-0 d-block">
                    <button class="btn btn-secondary py-2 mr-1" disabled style="cursor: not-allowed; opacity: 0.6;">Sedang Disewa</button>
                    <a href="car-single.php?id=<?php echo $baris['id_mobil']; ?>" class="btn btn-outline-light py-2 ml-1">Details</a>
                  </p>
                <?php } else { ?>
                  <p class="d-flex mb-0 d-block">
                    <button type="button"
                      class="btn btn-primary py-2 mr-1 btn-quick-book"
                      data-id="<?php echo $baris['id_mobil']; ?>"
                      data-nama="<?php echo htmlspecialchars($baris['nama_mobil']); ?>"
                      data-merk="<?php echo htmlspecialchars($baris['merk']); ?>"
                      data-gambar="<?php echo htmlspecialchars($baris['gambar']); ?>"
                      data-harga="<?php echo (int)$baris['harga_sewa']; ?>">
                      Book now
                    </button>
                    <a href="car-single.php?id=<?php echo $baris['id_mobil']; ?>" class="btn btn-secondary py-2 ml-1">Details</a>
                  </p>
                <?php } ?>
    					</div>
    				</div>
    			</div>
          <?php } ?>

    		</div>
    	</div>
    </section>

    <!-- Modal Konfirmasi Penyewaan Mobil (Langsung muncul saat klik Book now) -->
    <div class="modal fade" id="modalBookingKatalog" tabindex="-1" role="dialog" aria-labelledby="modalBookingKatalogLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title font-weight-bold" id="modalBookingKatalogLabel">Konfirmasi Penyewaan Mobil</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="proses_sewa.php" method="POST">
            <div class="modal-body">
              <input type="hidden" name="id_mobil" id="quickIdMobil">
              <input type="hidden" name="merk" id="quickMerk">
              <input type="hidden" name="gambar" id="quickGambar">
              <input type="hidden" name="total_harga" id="quickTotalHargaAngka">

              <div class="form-group text-left">
                <label class="font-weight-bold">Mobil Yang Dipilih</label>
                <input type="text" name="nama_mobil" id="quickNamaMobil" class="form-control" readonly>
              </div>

              <div class="form-group text-left">
                <label class="font-weight-bold">Detail Paket & Layanan</label>
                <select name="paket_sewa" id="quickSelectPaket" class="form-control">
                  <option value="1 Jam (Lepas Kunci)" data-mult="0.10">1 Jam (Lepas Kunci)</option>
                  <option value="1 Hari (Lepas Kunci)" data-mult="1">1 Hari (Lepas Kunci)</option>
                  <option value="1 Hari (Dengan Sopir)" data-mult="1" data-sopir="150000">1 Hari (Dengan Sopir)</option>
                  <option value="1 Minggu (Lepas Kunci)" data-mult="6">1 Minggu (Lepas Kunci)</option>
                </select>
              </div>

              <div class="form-row text-left">
                <div class="form-group col-md-6">
                  <label class="font-weight-bold">Tanggal Mulai Sewa</label>
                  <input type="date" name="tanggal_mulai" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                </div>
                <div class="form-group col-md-6">
                  <label class="font-weight-bold">Total Pembayaran</label>
                  <input type="text" id="quickTotalHargaTeks" class="form-control font-weight-bold" style="color: #ffcc00 !important;" readonly>
                </div>
              </div>

              <div class="form-group text-left">
                <label class="font-weight-bold">Nama Lengkap Pemesan</label>
                <input type="text" name="nama_pemesan" class="form-control" placeholder="Masukkan nama lengkap Anda" required>
              </div>

              <div class="form-group text-left">
                <label class="font-weight-bold">Nomor WhatsApp / HP</label>
                <input type="tel" name="no_hp" class="form-control" placeholder="08xxxxxxxxxx" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-batal-dark" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary font-weight-bold">Konfirmasi & Pesan Sekarang</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

    <script>
      $(document).ready(function() {
        var hargaHarianAktif = 0;

        function formatRupiah(angka) {
          return 'Rp ' + Math.round(angka).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function hitungQuickTotal() {
          var selectedOpt = $('#quickSelectPaket option:selected');
          var mult  = parseFloat(selectedOpt.data('mult')) || 0.10;
          var sopir = parseInt(selectedOpt.data('sopir')) || 0;
          var total = Math.round(hargaHarianAktif * mult) + sopir;

          $('#quickTotalHargaAngka').val(total);
          $('#quickTotalHargaTeks').val(formatRupiah(total));
        }

        $('.btn-quick-book').on('click', function() {
          hargaHarianAktif = parseInt($(this).data('harga')) || 0;

          $('#quickIdMobil').val($(this).data('id'));
          $('#quickNamaMobil').val($(this).data('nama'));
          $('#quickMerk').val($(this).data('merk'));
          $('#quickGambar').val($(this).data('gambar'));
          $('#quickSelectPaket').val('1 Jam (Lepas Kunci)');

          hitungQuickTotal();
          $('#modalBookingKatalog').modal('show');
        });

        $('#quickSelectPaket').on('change', hitungQuickTotal);
      });
    </script>
  </body>
</html>