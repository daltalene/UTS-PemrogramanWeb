<?php
// Data 12 mobil yang disesuaikan persis dengan foto car-1.jpg s/d car-12.jpg
$cars = [
    1 => [
        'nama' => 'Mercedes SLK Roadster',
        'merek' => 'Mercedes-Benz',
        'gambar' => 'images/car-1.jpg',
        'jam' => 50,
        'hari' => 500,
        'minggu' => 3000,
        'kecepatan' => '40,000 KM',
        'transmisi' => 'Automatic',
        'kursi' => '2 Kursi',
        'bbm' => 'Bensin'
    ],
    2 => [
        'nama' => 'Range Rover Sport SUV',
        'merek' => 'Land Rover',
        'gambar' => 'images/car-2.jpg',
        'jam' => 70,
        'hari' => 700,
        'minggu' => 4200,
        'kecepatan' => '25,000 KM',
        'transmisi' => 'Automatic',
        'kursi' => '7 Kursi',
        'bbm' => 'Diesel'
    ],
    3 => [
        'nama' => 'McLaren 720S Supercar',
        'merek' => 'McLaren',
        'gambar' => 'images/car-3.jpg',
        'jam' => 180,
        'hari' => 1500,
        'minggu' => 9000,
        'kecepatan' => '8,000 KM',
        'transmisi' => 'Automatic Dual-Clutch',
        'kursi' => '2 Kursi',
        'bbm' => 'Pertamax Turbo'
    ],
    4 => [
        'nama' => 'Ford Mustang GT Coupe',
        'merek' => 'Ford',
        'gambar' => 'images/car-4.jpg',
        'jam' => 60,
        'hari' => 600,
        'minggu' => 3600,
        'kecepatan' => '20,000 KM',
        'transmisi' => 'Manual',
        'kursi' => '4 Kursi',
        'bbm' => 'Bensin'
    ],
    5 => [
        'nama' => 'BMW 3 Series Gran',
        'merek' => 'BMW',
        'gambar' => 'images/car-5.jpg',
        'jam' => 65,
        'hari' => 650,
        'minggu' => 3900,
        'kecepatan' => '15,000 KM',
        'transmisi' => 'Automatic',
        'kursi' => '5 Kursi',
        'bbm' => 'Bensin'
    ],
    6 => [
        'nama' => 'Alfa Romeo 4C Sport',
        'merek' => 'Alfa Romeo',
        'gambar' => 'images/car-6.jpg',
        'jam' => 80,
        'hari' => 800,
        'minggu' => 4800,
        'kecepatan' => '12,000 KM',
        'transmisi' => 'Automatic TCT',
        'kursi' => '2 Kursi',
        'bbm' => 'Pertamax Turbo'
    ],
    7 => [
        'nama' => 'Mercedes-Benz Luxury',
        'merek' => 'Mercedes-Benz',
        'gambar' => 'images/car-7.jpg',
        'jam' => 75,
        'hari' => 750,
        'minggu' => 4500,
        'kecepatan' => '18,000 KM',
        'transmisi' => 'Automatic',
        'kursi' => '4 Kursi Convertible',
        'bbm' => 'Bensin'
    ],
    8 => [
        'nama' => 'Jeep Wrangler Unlimited',
        'merek' => 'Jeep',
        'gambar' => 'images/car-8.jpg',
        'jam' => 55,
        'hari' => 550,
        'minggu' => 3300,
        'kecepatan' => '30,000 KM',
        'transmisi' => 'Automatic 4x4',
        'kursi' => '5 Kursi',
        'bbm' => 'Bensin'
    ],
    9 => [
        'nama' => 'Mercedes-AMG GT S',
        'merek' => 'Audi',
        'gambar' => 'images/car-9.jpg',
        'jam' => 70,
        'hari' => 700,
        'minggu' => 4200,
        'kecepatan' => '22,000 KM',
        'transmisi' => 'Automatic S-Tronic',
        'kursi' => '5 Kursi',
        'bbm' => 'Bensin'
    ],
    10 => [
        'nama' => 'Mercedes-AMG GT R',
        'merek' => 'Porsche',
        'gambar' => 'images/car-10.jpg',
        'jam' => 95,
        'hari' => 950,
        'minggu' => 5700,
        'kecepatan' => '14,000 KM',
        'transmisi' => 'Automatic Tiptronic',
        'kursi' => '5 Kursi SUV',
        'bbm' => 'Pertamax Turbo'
    ],
    11 => [
        'nama' => 'Chevrolet Corvette Stingray',
        'merek' => 'Chevrolet',
        'gambar' => 'images/car-11.jpg',
        'jam' => 85,
        'hari' => 850,
        'minggu' => 5100,
        'kecepatan' => '10,000 KM',
        'transmisi' => 'Automatic',
        'kursi' => '2 Kursi',
        'bbm' => 'Bensin'
    ],
    12 => [
        'nama' => 'Audi A1 Hatchback',
        'merek' => 'Ferrari',
        'gambar' => 'images/car-12.jpg',
        'jam' => 160,
        'hari' => 1400,
        'minggu' => 8400,
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
              <li class="nav-item"><a href="admin.php" class="nav-link">Admin</a></li>
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

        <!-- Rincian Harga Sewa Dinamis -->
        <div class="row my-4">
          <div class="col-md-4 text-center">
            <div class="bg-white p-4 rounded shadow-sm">
              <h5 class="text-muted">Sewa Per Jam</h5>
              <h3 class="text-primary font-weight-bold">$<?php echo $mobil['jam']; ?> / Jam</h3>
            </div>
          </div>
          <div class="col-md-4 text-center">
            <div class="bg-white p-4 rounded shadow-sm border border-primary">
              <h5 class="text-muted">Sewa Per Hari</h5>
              <h3 class="text-primary font-weight-bold">$<?php echo number_format($mobil['hari']); ?> / Hari</h3>
            </div>
          </div>
          <div class="col-md-4 text-center">
            <div class="bg-white p-4 rounded shadow-sm">
              <h5 class="text-muted">Sewa Per Minggu</h5>
              <h3 class="text-primary font-weight-bold">$<?php echo number_format($mobil['minggu']); ?> / Minggu</h3>
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