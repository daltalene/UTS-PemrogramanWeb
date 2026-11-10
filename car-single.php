<?php
session_start();
include 'koneksi.php';

$id = isset($_GET['id']) ? $_GET['id'] : '';

$query = mysqli_query($koneksi, "SELECT * FROM table_mobil WHERE id_mobil='$id'");
$mobil = mysqli_fetch_assoc($query);

if (!$mobil) {
    header("location:car.php");
    exit();
}

$harga_hari   = $mobil['harga_sewa'];
$harga_jam    = $harga_hari * 0.10;
$harga_minggu = $harga_hari * 6;

// Menentukan Spesifikasi Mobil Dinamis
$jarak_tempuh = isset($mobil['jarak_tempuh']) && !empty($mobil['jarak_tempuh']) ? $mobil['jarak_tempuh'] : (10000 + ($mobil['id_mobil'] * 2500)) . " KM";
$transmisi    = isset($mobil['transmisi']) && !empty($mobil['transmisi']) ? $mobil['transmisi'] : ($mobil['id_mobil'] % 2 == 0 ? "Automatic Tiptronic" : "Manual 6-Speed");
$kursi        = isset($mobil['kapasitas']) && !empty($mobil['kapasitas']) ? $mobil['kapasitas'] : (strpos(strtolower($mobil['nama_mobil']), 'suv') !== false ? "7 Kursi" : "2 Kursi Sport");
$bbm          = isset($mobil['bahan_bakar']) && !empty($mobil['bahan_bakar']) ? $mobil['bahan_bakar'] : (strpos(strtolower($mobil['nama_mobil']), 'supercar') !== false || strpos(strtolower($mobil['nama_mobil']), 'gt') !== false ? "Pertamax Turbo" : "Bensin Premium");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Detail Mobil - <?php echo $mobil['nama_mobil']; ?></title>
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
              <li class="nav-item"><a href="#" class="nav-link">Halo, <?php echo $_SESSION['admin']; ?></a></li>
              <li class="nav-item"><a href="logout.php" class="nav-link font-weight-bold" onclick="return confirm('Yakin ingin logout?')">Logout</a></li>

            <?php } elseif (isset($_SESSION['user'])) { ?>
              <li class="nav-item"><a href="#" class="nav-link">Halo, <?php echo $_SESSION['user']; ?></a></li>
              <li class="nav-item"><a href="logout.php" class="nav-link font-weight-bold" onclick="return confirm('Yakin ingin logout?')">Logout</a></li>

            <?php } else { ?>
              <li class="nav-item"><a href="login.php" class="nav-link">Login</a></li>
              <li class="nav-item"><a href="login_admin.php" class="nav-link">Login Admin</a></li>
            <?php } ?>

          </ul>
        </div>
      </div>
    </nav>

    <section class="ftco-section ftco-car-details pt-5">
      <div class="container">
      	<div class="row justify-content-center">
      		<div class="col-md-12">
      			<div class="car-details">
      				<div class="img rounded" style="background-image: url(images/<?php echo $mobil['gambar']; ?>); height: 400px; background-size: cover; background-position: center;"></div>
      				<div class="text text-center mt-4">
      					<span class="subheading" style="color: #e50914 !important; font-weight: 700; text-transform: uppercase;"><?php echo $mobil['merk']; ?></span>
      					<h2 class="text-white font-weight-bold"><?php echo $mobil['nama_mobil']; ?></h2>
      				</div>
      			</div>
      		</div>
      	</div>

        <!-- Rincian Harga Sewa Dinamis -->
        <div class="row my-4">
          <div class="col-md-4 text-center mb-3 mb-md-0">
            <div class="p-4 rounded shadow-sm border" style="background-color: #1a1a1a; border-color: #333 !important;">
              <h5 class="text-muted">Sewa Per Jam</h5>
              <h3 class="font-weight-bold" style="color: #e50914;">Rp <?php echo number_format($harga_jam, 0, ',', '.'); ?> <span style="font-size: 14px; color: #888;">/ Jam</span></h3>
            </div>
          </div>
          <div class="col-md-4 text-center mb-3 mb-md-0">
            <div class="p-4 rounded shadow-sm border" style="background-color: #1a1a1a; border-color: #e50914 !important;">
              <h5 class="text-muted">Sewa Per Hari</h5>
              <h3 class="font-weight-bold" style="color: #e50914;">Rp <?php echo number_format($harga_hari, 0, ',', '.'); ?> <span style="font-size: 14px; color: #888;">/ Hari</span></h3>
            </div>
          </div>
          <div class="col-md-4 text-center">
            <div class="p-4 rounded shadow-sm border" style="background-color: #1a1a1a; border-color: #333 !important;">
              <h5 class="text-muted">Sewa Per Minggu</h5>
              <h3 class="font-weight-bold" style="color: #e50914;">Rp <?php echo number_format($harga_minggu, 0, ',', '.'); ?> <span style="font-size: 14px; color: #888;">/ Minggu</span></h3>
            </div>
          </div>
        </div>

        <!-- Spesifikasi Mobil Dinamis -->
      	<div class="row my-4">
      		<div class="col-md d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services p-3 rounded shadow-sm w-100" style="background-color: #1a1a1a; border: 1px solid #333;">
              <div class="media-body py-md-4">
              	<div class="d-flex align-items-center">
	              	<div class="icon d-flex align-items-center justify-content-center" style="background-color: #ffcc00 !important; color: #000 !important; width: 60px; height: 60px; border-radius: 50%;"><span class="flaticon-dashboard"></span></div>
	              	<div class="text pl-3">
		                <h3 class="heading mb-0 text-white">Jarak Tempuh<span class="d-block text-muted" style="font-size: 14px;"><?php echo $jarak_tempuh; ?></span></h3>
	                </div>
                </div>
              </div>
            </div>      
          </div>
          <div class="col-md d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services p-3 rounded shadow-sm w-100" style="background-color: #1a1a1a; border: 1px solid #333;">
              <div class="media-body py-md-4">
              	<div class="d-flex align-items-center">
	              	<div class="icon d-flex align-items-center justify-content-center" style="background-color: #ffcc00 !important; color: #000 !important; width: 60px; height: 60px; border-radius: 50%;"><span class="flaticon-pistons"></span></div>
	              	<div class="text pl-3">
		                <h3 class="heading mb-0 text-white">Transmisi<span class="d-block text-muted" style="font-size: 14px;"><?php echo $transmisi; ?></span></h3>
	                </div>
                </div>
              </div>
            </div>      
          </div>
          <div class="col-md d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services p-3 rounded shadow-sm w-100" style="background-color: #1a1a1a; border: 1px solid #333;">
              <div class="media-body py-md-4">
              	<div class="d-flex align-items-center">
	              	<div class="icon d-flex align-items-center justify-content-center" style="background-color: #ffcc00 !important; color: #000 !important; width: 60px; height: 60px; border-radius: 50%;"><span class="flaticon-car-seat"></span></div>
	              	<div class="text pl-3">
		                <h3 class="heading mb-0 text-white">Kapasitas<span class="d-block text-muted" style="font-size: 14px;"><?php echo $kursi; ?></span></h3>
	                </div>
                </div>
              </div>
            </div>      
          </div>
          <div class="col-md d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services p-3 rounded shadow-sm w-100" style="background-color: #1a1a1a; border: 1px solid #333;">
              <div class="media-body py-md-4">
              	<div class="d-flex align-items-center">
	              	<div class="icon d-flex align-items-center justify-content-center" style="background-color: #ffcc00 !important; color: #000 !important; width: 60px; height: 60px; border-radius: 50%;"><span class="flaticon-diesel"></span></div>
	              	<div class="text pl-3">
		                <h3 class="heading mb-0 text-white">Bahan Bakar<span class="d-block text-muted" style="font-size: 14px;"><?php echo $bbm; ?></span></h3>
	                </div>
                </div>
              </div>
            </div>      
          </div>
      	</div>

        <!-- Tombol Aksi Sewa -->
        <div class="row my-4 justify-content-center">
          <div class="col-md-6 text-center">
            <button class="btn btn-primary btn-lg btn-block py-3 font-weight-bold btn-book-now" data-nama="<?php echo htmlspecialchars($mobil['nama_mobil']); ?>" data-harga="Rp <?php echo number_format($harga_hari, 0, ',', '.'); ?> / Hari">Sewa Sekarang (Book Now)</button>
            <a href="car.php" class="btn btn-secondary btn-block mt-2 py-2">Kembali ke Katalog</a>
          </div>
        </div>

      </div>
    </section>

    <!-- Modal Form Booking Interaktif -->
    <div class="modal fade" id="modalBooking" tabindex="-1" role="dialog" aria-labelledby="modalBookingLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title font-weight-bold" id="modalBookingLabel">Formulir Sewa Mobil</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="#" method="POST" onsubmit="alert('Terima kasih! Pemesanan Anda berhasil diproses.'); $('#modalBooking').modal('hide'); return false;">
            <div class="modal-body">
              <div class="form-group text-left">
                <label class="font-weight-bold">Mobil Yang Dipilih</label>
                <input type="text" id="bookingNamaMobil" class="form-control" readonly>
              </div>
              <div class="form-group text-left">
                <label class="font-weight-bold">Tarif Sewa</label>
                <input type="text" id="bookingHargaMobil" class="form-control" readonly>
              </div>
              <div class="form-group text-left">
                <label class="font-weight-bold">Nama Lengkap Pemesan</label>
                <input type="text" class="form-control" placeholder="Masukkan nama Anda" required>
              </div>
              <div class="form-group text-left">
                <label class="font-weight-bold">Nomor WhatsApp / HP</label>
                <input type="tel" class="form-control" placeholder="08xxxxxxxxxx" required>
              </div>
              <div class="form-row text-left">
                <div class="form-group col-md-6">
                  <label class="font-weight-bold">Tanggal Sewa</label>
                  <input type="date" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                  <label class="font-weight-bold">Lama Sewa (Hari)</label>
                  <input type="number" class="form-control" min="1" value="1" required>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary font-weight-bold">Konfirmasi Pemesanan</button>
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
        $('.btn-book-now').on('click', function() {
          var nama = $(this).data('nama');
          var harga = $(this).data('harga');
          $('#bookingNamaMobil').val(nama);
          $('#bookingHargaMobil').val(harga);
          $('#modalBooking').modal('show');
        });
      });
    </script>
  </body>
</html>