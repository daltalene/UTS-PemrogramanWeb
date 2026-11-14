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
              <li class="nav-item"><a href="riwayat.php" class="nav-link">Riwayat Sewa</a></li>
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
            <p class="text-muted mb-0" style="font-size: 14px;">
            </p>
            <h1 class="mb-3 bread">Pilih Mobil Impian Anda</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section">
    	<div class="container">
    		<div class="row">
          
          <?php 
          while ($baris = mysqli_fetch_assoc($hasil)) { 
            $formatted_price = "Rp " . number_format($baris['harga_sewa'], 0, ',', '.') . " /hari";
          ?>
    			<div class="col-md-4 mb-4">
    				<div class="car-wrap rounded">
    					<div class="img rounded d-flex align-items-end" style="background-image: url(images/<?php echo $baris['gambar']; ?>); height: 240px; background-size: cover; background-position: center;"></div>
    					<div class="text p-4">
    						<h2 class="mb-0"><a href="car-single.php?id=<?php echo $baris['id_mobil']; ?>"><?php echo $baris['nama_mobil']; ?></a></h2>
    						<div class="d-flex mb-3">
	    						<span class="cat"><?php echo $baris['merk']; ?></span>
	    						<p class="price ml-auto">Rp <?php echo number_format($baris['harga_sewa'], 0, ',', '.'); ?> <span>/hari</span></p>
    						</div>
    						<p class="d-flex mb-0 d-block">
                  <button class="btn btn-primary py-2 mr-1 btn-book-now" data-nama="<?php echo htmlspecialchars($baris['nama_mobil']); ?>" data-harga="<?php echo $formatted_price; ?>">Book now</button> 
                  <a href="car-single.php?id=<?php echo $baris['id_mobil']; ?>" class="btn btn-secondary py-2 ml-1">Details</a>
                </p>
    					</div>
    				</div>
    			</div>
          <?php } ?>

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
      $(document).ready(function() {$('.btn-book-now').on('click', function() {
          var nama = $(this).data('nama');
          var harga = $(this).data('harga');$('#bookingNamaMobil').val(nama);
          $('#bookingHargaMobil').val(harga);
          $('#modalBooking').modal('show');
        });
      });
    </script>
  </body>
</html>