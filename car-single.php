<?php
// Data 12 mobil yang disesuaikan persis dengan foto car-1.jpg s/d car-12.jpg (Harga Rupiah)
$cars = [
    1 => [
        'nama' => 'Mercedes SLK Roadster',
        'merek' => 'Mercedes-Benz',
        'gambar' => 'images/car-1.jpg',
        'jam' => 750000,
        'hari' => 7500000,
        'minggu' => 45000000,
        'kecepatan' => '40,000 KM',
        'transmisi' => 'Automatic',
        'kursi' => '2 Kursi',
        'bbm' => 'Bensin'
    ],
    2 => [
        'nama' => 'Range Rover Sport SUV',
        'merek' => 'Land Rover',
        'gambar' => 'images/car-2.jpg',
        'jam' => 1050000,
        'hari' => 10500000,
        'minggu' => 63000000,
        'kecepatan' => '25,000 KM',
        'transmisi' => 'Automatic',
        'kursi' => '7 Kursi',
        'bbm' => 'Diesel'
    ],
    3 => [
        'nama' => 'McLaren 720S Supercar',
        'merek' => 'McLaren',
        'gambar' => 'images/car-3.jpg',
        'jam' => 2700000,
        'hari' => 22500000,
        'minggu' => 135000000,
        'kecepatan' => '8,000 KM',
        'transmisi' => 'Automatic Dual-Clutch',
        'kursi' => '2 Kursi',
        'bbm' => 'Pertamax Turbo'
    ],
    4 => [
        'nama' => 'Ford Mustang GT Coupe',
        'merek' => 'Ford',
        'gambar' => 'images/car-4.jpg',
        'jam' => 900000,
        'hari' => 9000000,
        'minggu' => 54000000,
        'kecepatan' => '20,000 KM',
        'transmisi' => 'Manual',
        'kursi' => '4 Kursi',
        'bbm' => 'Bensin'
    ],
    5 => [
        'nama' => 'BMW 3 Series Gran',
        'merek' => 'BMW',
        'gambar' => 'images/car-5.jpg',
        'jam' => 975000,
        'hari' => 9750000,
        'minggu' => 58500000,
        'kecepatan' => '15,000 KM',
        'transmisi' => 'Automatic',
        'kursi' => '5 Kursi',
        'bbm' => 'Bensin'
    ],
    6 => [
        'nama' => 'Alfa Romeo 4C Sport',
        'merek' => 'Alfa Romeo',
        'gambar' => 'images/car-6.jpg',
        'jam' => 1200000,
        'hari' => 12000000,
        'minggu' => 72000000,
        'kecepatan' => '12,000 KM',
        'transmisi' => 'Automatic TCT',
        'kursi' => '2 Kursi',
        'bbm' => 'Pertamax Turbo'
    ],
    7 => [
        'nama' => 'Mercedes-Benz Luxury',
        'merek' => 'Mercedes-Benz',
        'gambar' => 'images/car-7.jpg',
        'jam' => 1125000,
        'hari' => 11250000,
        'minggu' => 67500000,
        'kecepatan' => '18,000 KM',
        'transmisi' => 'Automatic',
        'kursi' => '4 Kursi Convertible',
        'bbm' => 'Bensin'
    ],
    8 => [
        'nama' => 'Jeep Wrangler Unlimited',
        'merek' => 'Jeep',
        'gambar' => 'images/car-8.jpg',
        'jam' => 825000,
        'hari' => 8250000,
        'minggu' => 49500000,
        'kecepatan' => '30,000 KM',
        'transmisi' => 'Automatic 4x4',
        'kursi' => '5 Kursi',
        'bbm' => 'Bensin'
    ],
    9 => [
        'nama' => 'Mercedes-AMG GT S',
        'merek' => 'Mercedes-AMG',
        'gambar' => 'images/car-9.jpg',
        'jam' => 1050000,
        'hari' => 10500000,
        'minggu' => 63000000,
        'kecepatan' => '22,000 KM',
        'transmisi' => 'Automatic S-Tronic',
        'kursi' => '5 Kursi',
        'bbm' => 'Bensin'
    ],
    10 => [
        'nama' => 'Mercedes-AMG GT R',
        'merek' => 'Mercedes-AMG',
        'gambar' => 'images/car-10.jpg',
        'jam' => 1425000,
        'hari' => 14250000,
        'minggu' => 85500000,
        'kecepatan' => '14,000 KM',
        'transmisi' => 'Automatic Tiptronic',
        'kursi' => '5 Kursi SUV',
        'bbm' => 'Pertamax Turbo'
    ],
    11 => [
        'nama' => 'Chevrolet Corvette Stingray',
        'merek' => 'Chevrolet',
        'gambar' => 'images/car-11.jpg',
        'jam' => 1275000,
        'hari' => 12750000,
        'minggu' => 76500000,
        'kecepatan' => '10,000 KM',
        'transmisi' => 'Automatic',
        'kursi' => '2 Kursi',
        'bbm' => 'Bensin'
    ],
    12 => [
        'nama' => 'Audi A1 Hatchback',
        'merek' => 'Audi',
        'gambar' => 'images/car-12.jpg',
        'jam' => 2400000,
        'hari' => 21000000,
        'minggu' => 126000000,
        'kecepatan' => '7,000 KM',
        'transmisi' => 'Automatic F1 Dual-Clutch',
        'kursi' => '2 Kursi',
        'bbm' => 'Pertamax Turbo'
    ]
];

// Tangkap ID dari URL, jika tidak ada default ke 1
$id = isset($_GET['id']) ? (int)$_GET['id'] : 1;
$mobil = isset($cars[$id]) ? $cars[$id] : $cars[1];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Detail Mobil - <?php echo $mobil['nama']; ?></title>
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
              <li class="nav-item"><a href="login.php" class="nav-link">Login</a></li>
              <li class="nav-item"><a href="admin.php" class="nav-link">Login Admin</a></li>
            </ul>
	      </div>
	    </div>
	  </nav>

    <section class="ftco-section ftco-car-details bg-light pt-5">
      <div class="container">
      	<div class="row justify-content-center">
      		<div class="col-md-12">
      			<div class="car-details">
      				<div class="img rounded" style="background-image: url(<?php echo $mobil['gambar']; ?>); height: 400px; background-size: cover; background-position: center;"></div>
      				<div class="text text-center mt-4">
      					<span class="subheading"><?php echo $mobil['merek']; ?></span>
      					<h2><?php echo $mobil['nama']; ?></h2>
      				</div>
      			</div>
      		</div>
      	</div>

        <!-- Rincian Harga Sewa Dinamis (Rupiah) -->
        <div class="row my-4">
          <div class="col-md-4 text-center">
            <div class="bg-white p-4 rounded shadow-sm">
              <h5 class="text-muted">Sewa Per Jam</h5>
              <h3 class="text-primary font-weight-bold">Rp <?php echo number_format($mobil['jam'], 0, ',', '.'); ?> / Jam</h3>
            </div>
          </div>
          <div class="col-md-4 text-center">
            <div class="bg-white p-4 rounded shadow-sm border border-primary">
              <h5 class="text-muted">Sewa Per Hari</h5>
              <h3 class="text-primary font-weight-bold">Rp <?php echo number_format($mobil['hari'], 0, ',', '.'); ?> / Hari</h3>
            </div>
          </div>
          <div class="col-md-4 text-center">
            <div class="bg-white p-4 rounded shadow-sm">
              <h5 class="text-muted">Sewa Per Minggu</h5>
              <h3 class="text-primary font-weight-bold">Rp <?php echo number_format($mobil['minggu'], 0, ',', '.'); ?> / Minggu</h3>
            </div>
          </div>
        </div>

        <!-- Fitur & Spesifikasi Mobil Dinamis -->
      	<div class="row my-4">
      		<div class="col-md d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services bg-white p-3 rounded shadow-sm">
              <div class="media-body py-md-4">
              	<div class="d-flex align-items-center">
	              	<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-dashboard"></span></div>
	              	<div class="text pl-3">
		                <h3 class="heading mb-0">Jarak Tempuh<span><?php echo $mobil['kecepatan']; ?></span></h3>
	                </div>
                </div>
              </div>
            </div>      
          </div>
          <div class="col-md d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services bg-white p-3 rounded shadow-sm">
              <div class="media-body py-md-4">
              	<div class="d-flex align-items-center">
	              	<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-pistons"></span></div>
	              	<div class="text pl-3">
		                <h3 class="heading mb-0">Transmisi<span><?php echo $mobil['transmisi']; ?></span></h3>
	                </div>
                </div>
              </div>
            </div>      
          </div>
          <div class="col-md d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services bg-white p-3 rounded shadow-sm">
              <div class="media-body py-md-4">
              	<div class="d-flex align-items-center">
	              	<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-car-seat"></span></div>
	              	<div class="text pl-3">
		                <h3 class="heading mb-0">Kapasitas<span><?php echo $mobil['kursi']; ?></span></h3>
	                </div>
                </div>
              </div>
            </div>      
          </div>
          <div class="col-md d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services bg-white p-3 rounded shadow-sm">
              <div class="media-body py-md-4">
              	<div class="d-flex align-items-center">
	              	<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-diesel"></span></div>
	              	<div class="text pl-3">
		                <h3 class="heading mb-0">Bahan Bakar<span><?php echo $mobil['bbm']; ?></span></h3>
	                </div>
                </div>
              </div>
            </div>      
          </div>
      	</div>

        <!-- Tombol Aksi Sewa -->
        <div class="row my-4 justify-content-center">
          <div class="col-md-6 text-center">
            <a href="index.php" class="btn btn-primary btn-lg btn-block py-3">Sewa Sekarang (Book Now)</a>
            <a href="car.php" class="btn btn-outline-secondary btn-block mt-2">Kembali ke Katalog</a>
          </div>
        </div>

      </div>
    </section>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>