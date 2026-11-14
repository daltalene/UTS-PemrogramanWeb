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

$harga_hari   = (int)$mobil['harga_sewa'];
$harga_jam    = (int)($harga_hari * 0.10);
$harga_minggu = (int)($harga_hari * 6);

// Deteksi spesifikasi realistis berdasarkan Nama & Merek Mobil
$nama_lower = strtolower($mobil['nama_mobil'] . ' ' . $mobil['merk']);

if (strpos($nama_lower, 'enzo') !== false) {
    $def_mesin     = "6.000 cc V12 Naturally Aspirated";
    $def_tenaga    = "660 HP @ 7.800 rpm";
    $def_transmisi = "Automatic 6-Speed F1";
    $def_kursi     = "2 Kursi";
    $def_bbm       = "Pertamax Turbo (RON 98)";
    $def_tahun     = "2004";
    $def_warna     = "Rosso Corsa (Merah)";
    $def_km        = "4.200 KM";
} elseif (strpos($nama_lower, 'ferrari') !== false) {
    $def_mesin     = "3.900 cc V8 Twin-Turbo";
    $def_tenaga    = "710 HP @ 8.000 rpm";
    $def_transmisi = "Automatic 7-Speed DCT";
    $def_kursi     = "2 Kursi";
    $def_bbm       = "Pertamax Turbo (RON 98)";
    $def_tahun     = "2022";
    $def_warna     = "Rosso Corsa";
    $def_km        = "8.500 KM";
} elseif (strpos($nama_lower, 'gt3') !== false || strpos($nama_lower, 'porsche') !== false) {
    $def_mesin     = "4.000 cc Flat-6 Naturally Aspirated";
    $def_tenaga    = "502 HP @ 8.400 rpm";
    $def_transmisi = "Automatic 7-Speed PDK";
    $def_kursi     = "2 Kursi";
    $def_bbm       = "Pertamax Turbo (RON 98)";
    $def_tahun     = "2023";
    $def_warna     = "Shark Blue / Silver";
    $def_km        = "6.100 KM";
} elseif (strpos($nama_lower, 'lamborghini') !== false || strpos($nama_lower, 'aventador') !== false || strpos($nama_lower, 'huracan') !== false) {
    $def_mesin     = "5.200 cc V10 Naturally Aspirated";
    $def_tenaga    = "631 HP @ 8.000 rpm";
    $def_transmisi = "Automatic 7-Speed LDF";
    $def_kursi     = "2 Kursi";
    $def_bbm       = "Pertamax Turbo (RON 98)";
    $def_tahun     = "2022";
    $def_warna     = "Giallo Orion (Kuning)";
    $def_km        = "7.300 KM";
} elseif (strpos($nama_lower, 'gtr') !== false || strpos($nama_lower, 'gt-r') !== false || strpos($nama_lower, 'nissan') !== false) {
    $def_mesin     = "3.800 cc V6 Twin-Turbo";
    $def_tenaga    = "565 HP @ 6.800 rpm";
    $def_transmisi = "Automatic 6-Speed DCT";
    $def_kursi     = "4 Kursi";
    $def_bbm       = "Pertamax Turbo (RON 98)";
    $def_tahun     = "2021";
    $def_warna     = "Bayside Blue";
    $def_km        = "14.200 KM";
} elseif (strpos($nama_lower, 'supra') !== false || strpos($nama_lower, 'toyota') !== false) {
    $def_mesin     = "3.000 cc Inline-6 Turbo";
    $def_tenaga    = "382 HP @ 5.800 rpm";
    $def_transmisi = "Automatic 8-Speed Sport";
    $def_kursi     = "2 Kursi";
    $def_bbm       = "Pertamax Turbo (RON 98)";
    $def_tahun     = "2022";
    $def_warna     = "Prominence Red";
    $def_km        = "11.400 KM";
} elseif (strpos($nama_lower, 'bmw') !== false || strpos($nama_lower, 'm4') !== false || strpos($nama_lower, 'm3') !== false) {
    $def_mesin     = "3.000 cc M TwinPower Turbo";
    $def_tenaga    = "503 HP @ 6.250 rpm";
    $def_transmisi = "Automatic 8-Speed M Steptronic";
    $def_kursi     = "4 Kursi";
    $def_bbm       = "Pertamax Turbo (RON 98)";
    $def_tahun     = "2023";
    $def_warna     = "Isle of Man Green";
    $def_km        = "9.800 KM";
} elseif (strpos($nama_lower, 'mercedes') !== false || strpos($nama_lower, 'amg') !== false) {
    $def_mesin     = "4.000 cc V8 Biturbo AMG";
    $def_tenaga    = "577 HP @ 6.250 rpm";
    $def_transmisi = "Automatic 7-Speed AMG";
    $def_kursi     = "2 Kursi";
    $def_bbm       = "Pertamax Turbo (RON 98)";
    $def_tahun     = "2022";
    $def_warna     = "Obsidian Black";
    $def_km        = "10.500 KM";
} elseif (strpos($nama_lower, 'mustang') !== false || strpos($nama_lower, 'ford') !== false || strpos($nama_lower, 'camaro') !== false) {
    $def_mesin     = "5.000 cc Coyote V8";
    $def_tenaga    = "450 HP @ 7.000 rpm";
    $def_transmisi = "Automatic 10-Speed";
    $def_kursi     = "4 Kursi";
    $def_bbm       = "Pertamax Turbo";
    $def_tahun     = "2021";
    $def_warna     = "Shadow Black";
    $def_km        = "16.800 KM";
} elseif (strpos($nama_lower, 'civic') !== false || strpos($nama_lower, 'honda') !== false) {
    $def_mesin     = "2.000 cc VTEC Turbo";
    $def_tenaga    = "315 HP @ 6.500 rpm";
    $def_transmisi = "Manual 6-Speed";
    $def_kursi     = "4 Kursi";
    $def_bbm       = "Pertamax Turbo";
    $def_tahun     = "2023";
    $def_warna     = "Championship White";
    $def_km        = "7.900 KM";
} elseif (strpos($nama_lower, 'mclaren') !== false) {
    $def_mesin     = "4.000 cc V8 Twin-Turbo";
    $def_tenaga    = "710 HP @ 7.500 rpm";
    $def_transmisi = "Automatic 7-Speed SSG";
    $def_kursi     = "2 Kursi";
    $def_bbm       = "Pertamax Turbo (RON 98)";
    $def_tahun     = "2022";
    $def_warna     = "Papaya Spark";
    $def_km        = "5.400 KM";
} elseif (strpos($nama_lower, 'audi') !== false || strpos($nama_lower, 'r8') !== false) {
    $def_mesin     = "5.200 cc V10 FSI Quattro";
    $def_tenaga    = "602 HP @ 8.100 rpm";
    $def_transmisi = "Automatic 7-Speed S tronic";
    $def_kursi     = "2 Kursi";
    $def_bbm       = "Pertamax Turbo (RON 98)";
    $def_tahun     = "2022";
    $def_warna     = "Daytona Gray";
    $def_km        = "8.900 KM";
} elseif (strpos($nama_lower, 'corvette') !== false || strpos($nama_lower, 'chevrolet') !== false) {
    $def_mesin     = "6.200 cc LT2 V8";
    $def_tenaga    = "495 HP @ 6.450 rpm";
    $def_transmisi = "Automatic 8-Speed DCT";
    $def_kursi     = "2 Kursi";
    $def_bbm       = "Pertamax Turbo (RON 98)";
    $def_tahun     = "2023";
    $def_warna     = "Rapid Blue";
    $def_km        = "6.800 KM";
} else {
    $mesin_list  = array("2.500 cc Turbo", "3.000 cc V6 Twin-Turbo", "3.500 cc V6", "4.000 cc V8");
    $tenaga_list = array("340 HP", "410 HP", "475 HP", "520 HP");
    $kursi_list  = array("2 Kursi", "4 Kursi", "5 Kursi");
    $warna_list  = array("Hitam Metalik", "Putih Mutiara", "Abu-Abu Graphite", "Merah Crimson");
    $idx = $mobil['id_mobil'] % 4;

    $def_mesin     = $mesin_list[$idx];
    $def_tenaga    = $tenaga_list[$idx];
    $def_transmisi = ($mobil['id_mobil'] % 2 == 0) ? "Automatic 8-Speed" : "Manual 6-Speed";
    $def_kursi     = $kursi_list[$mobil['id_mobil'] % 3];
    $def_bbm       = "Pertamax Turbo";
    $def_tahun     = (string)(2020 + ($mobil['id_mobil'] % 5));
    $def_warna     = $warna_list[$idx];
    $def_km        = number_format(8000 + ($mobil['id_mobil'] * 1750), 0, ',', '.') . " KM";
}

$jarak_tempuh    = (isset($mobil['jarak_tempuh']) && !empty($mobil['jarak_tempuh']) && $mobil['jarak_tempuh'] != '12.000 KM') ? $mobil['jarak_tempuh'] : $def_km;
$transmisi       = (isset($mobil['transmisi']) && !empty($mobil['transmisi']) && $mobil['transmisi'] != 'Automatic') ? $mobil['transmisi'] : $def_transmisi;
$kursi           = (isset($mobil['kapasitas']) && !empty($mobil['kapasitas']) && $mobil['kapasitas'] != '2 Kursi') ? $mobil['kapasitas'] : $def_kursi;
$bbm             = (isset($mobil['bahan_bakar']) && !empty($mobil['bahan_bakar']) && $mobil['bahan_bakar'] != 'Pertamax Turbo') ? $mobil['bahan_bakar'] : $def_bbm;
$kapasitas_mesin = (isset($mobil['kapasitas_mesin']) && !empty($mobil['kapasitas_mesin']) && $mobil['kapasitas_mesin'] != '3.800 cc Twin-Turbo') ? $mobil['kapasitas_mesin'] : $def_mesin;
$tenaga_maksimal = (isset($mobil['tenaga_maksimal']) && !empty($mobil['tenaga_maksimal']) && $mobil['tenaga_maksimal'] != '580 HP') ? $mobil['tenaga_maksimal'] : $def_tenaga;
$tahun_produksi  = (isset($mobil['tahun_produksi']) && !empty($mobil['tahun_produksi']) && $mobil['tahun_produksi'] != '2023') ? $mobil['tahun_produksi'] : $def_tahun;
$warna           = (isset($mobil['warna']) && !empty($mobil['warna']) && $mobil['warna'] != 'Hitam Metalik') ? $mobil['warna'] : $def_warna;
$deskripsi       = (isset($mobil['deskripsi']) && !empty($mobil['deskripsi'])) ? $mobil['deskripsi'] : "Unit " . $mobil['nama_mobil'] . " (" . $mobil['merk'] . ") tahun " . $tahun_produksi . " dibekali mesin " . $kapasitas_mesin . " bertenaga " . $tenaga_maksimal . ". Kondisi unit sangat terawat, servis rutin bengkel resmi, dan siap memberikan pengalaman berkendara terbaik.";
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

    <style>
      .spec-card {
        background-color: #1a1a1a !important;
        border: 1px solid #333 !important;
        border-radius: 10px;
      }
      .rate-card {
        background-color: #1a1a1a !important;
        border: 1px solid #333 !important;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.25s ease;
        position: relative;
      }
      .rate-card:hover {
        border-color: #777 !important;
        transform: translateY(-2px);
      }
      .rate-card.active-rate {
        border: 2px solid #e50914 !important;
        background-color: #221617 !important;
        box-shadow: 0 4px 15px rgba(229, 9, 20, 0.25) !important;
      }
      .rate-badge {
        font-size: 11px;
        padding: 3px 10px;
        border-radius: 20px;
        background-color: #2b2b2b;
        color: #aaa;
        display: inline-block;
        margin-top: 6px;
      }
      .rate-card.active-rate .rate-badge {
        background-color: #e50914;
        color: #fff;
        font-weight: 600;
      }
      .rental-config-box {
        background-color: #1a1a1a !important;
        border: 1px solid #333 !important;
        border-radius: 12px;
      }
      .rental-config-box .form-control {
        background-color: #262626 !important;
        color: #ffffff !important;
        border: 1px solid #444 !important;
        height: 46px !important;
      }
      .rental-config-box .form-control:focus {
        border-color: #e50914 !important;
        box-shadow: none !important;
      }
      .rental-config-box label {
        color: #cccccc;
        font-size: 13px;
        font-weight: 600;
      }
      .total-summary-box {
        background-color: #121212;
        border: 1px dashed #444;
        border-radius: 10px;
        padding: 18px 22px;
      }
      .spec-table {
        width: 100% !important;
        min-width: 0 !important;
        table-layout: fixed !important;
        border-collapse: collapse !important;
      }
      .spec-table td {
        min-width: 0 !important;
        border-top: none !important;
        border-bottom: 1px solid #2b2b2b !important;
        padding: 13px 10px !important;
        text-align: left !important;
        vertical-align: middle !important;
        word-wrap: break-word !important;
        overflow-wrap: break-word !important;
        white-space: normal !important;
      }
      .spec-table tr:last-child td {
        border-bottom: none !important;
      }
      .spec-table td.spec-label {
        color: #999999 !important;
        width: 45% !important;
        font-weight: 500 !important;
        font-size: 14px !important;
      }
      .spec-table td.spec-value {
        color: #ffffff !important;
        width: 55% !important;
        font-weight: 600 !important;
        font-size: 14px !important;
        text-align: right !important;
      }
      .feature-list {
        list-style: none;
        padding-left: 0;
        margin-bottom: 0;
      }
      .feature-list li {
        padding: 9px 0;
        color: #e0e0e0;
        border-bottom: 1px solid #262626;
        display: flex;
        align-items: center;
        font-size: 14px;
      }
      .feature-list li:last-child {
        border-bottom: none;
      }
      .feature-check {
        color: #01d28e;
        font-weight: bold;
        margin-right: 10px;
        font-size: 16px;
      }
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
              <li class="nav-item"><a href="#" class="nav-link">Halo, <?php echo $_SESSION['admin']; ?></a></li>
              <li class="nav-item"><a href="logout.php" class="nav-link font-weight-bold" onclick="return confirm('Yakin ingin logout?')">Logout</a></li>

            <?php } elseif (isset($_SESSION['user'])) { ?>
              <li class="nav-item"><a href="riwayat.php" class="nav-link">Riwayat Sewa</a></li>
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
              <div class="img rounded" style="background-image: url(images/<?php echo $mobil['gambar']; ?>); height: 420px; background-size: cover; background-position: center;"></div>
              <div class="text text-center mt-4">
                <span class="subheading" style="color: #e50914 !important; font-weight: 700; text-transform: uppercase; letter-spacing: 2px;"><?php echo $mobil['merk']; ?></span>
                <h2 class="text-white font-weight-bold"><?php echo $mobil['nama_mobil']; ?></h2>
              </div>
            </div>
          </div>
        </div>

        <div class="row my-4">
          <div class="col-md-4 text-center mb-3 mb-md-0">
            <div class="p-4 rounded shadow-sm rate-card" data-paket="jam">
              <h5 class="text-muted mb-2">Sewa Per Jam</h5>
              <h3 class="font-weight-bold mb-1" style="color: #e50914;">Rp <?php echo number_format($harga_jam, 0, ',', '.'); ?> <span style="font-size: 14px; color: #888;">/ Jam</span></h3>
              <span class="rate-badge">Klik untuk pilih paket Jam</span>
            </div>
          </div>
          <div class="col-md-4 text-center mb-3 mb-md-0">
            <div class="p-4 rounded shadow-sm rate-card active-rate" data-paket="hari">
              <h5 class="text-muted mb-2">Sewa Per Hari</h5>
              <h3 class="font-weight-bold mb-1" style="color: #e50914;">Rp <?php echo number_format($harga_hari, 0, ',', '.'); ?> <span style="font-size: 14px; color: #888;">/ Hari</span></h3>
              <span class="rate-badge">Paket Terpilih (Harian)</span>
            </div>
          </div>
          <div class="col-md-4 text-center">
            <div class="p-4 rounded shadow-sm rate-card" data-paket="minggu">
              <h5 class="text-muted mb-2">Sewa Per Minggu</h5>
              <h3 class="font-weight-bold mb-1" style="color: #e50914;">Rp <?php echo number_format($harga_minggu, 0, ',', '.'); ?> <span style="font-size: 14px; color: #888;">/ Minggu</span></h3>
              <span class="rate-badge">Klik untuk pilih paket Minggu</span>
            </div>
          </div>
        </div>

        <div class="row my-4">
          <div class="col-md-12">
            <div class="p-4 rental-config-box shadow-sm">
              <div class="d-flex justify-content-between align-items-center mb-3 pb-2" style="border-bottom: 1px solid #333;">
                <h4 class="font-weight-bold text-white mb-0">Atur Detail & Durasi Penyewaan</h4>
                <span class="text-muted" style="font-size: 13px;">Sesuaikan durasi untuk menghitung total biaya otomatis</span>
              </div>

              <div class="row align-items-end">
                <div class="col-md-3 mb-3 mb-md-0">
                  <label for="selectPaket">Jenis Paket Sewa</label>
                  <select id="selectPaket" class="form-control">
                    <option value="jam">Per Jam (Rp <?php echo number_format($harga_jam, 0, ',', '.'); ?> / jam)</option>
                    <option value="hari" selected>Per Hari (Rp <?php echo number_format($harga_hari, 0, ',', '.'); ?> / hari)</option>
                    <option value="minggu">Per Minggu (Rp <?php echo number_format($harga_minggu, 0, ',', '.'); ?> / minggu)</option>
                  </select>
                </div>

                <div class="col-md-2 mb-3 mb-md-0">
                  <label for="inputDurasi" id="labelDurasi">Jumlah Hari</label>
                  <input type="number" id="inputDurasi" class="form-control text-center font-weight-bold" min="1" max="60" value="1">
                </div>

                <div class="col-md-4 mb-3 mb-md-0">
                  <label for="selectLayanan">Opsi Layanan Pengemudi</label>
                  <select id="selectLayanan" class="form-control">
                    <option value="0" selected>Lepas Kunci (Self-Drive) - Gratis</option>
                    <option value="150000">Dengan Sopir (+ Rp 150.000 / hari)</option>
                  </select>
                </div>

                <div class="col-md-3">
                  <label for="inputTanggalMulai">Tanggal Mulai Sewa</label>
                  <input type="date" id="inputTanggalMulai" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                </div>
              </div>

              <div class="total-summary-box mt-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                <div class="mb-3 mb-md-0">
                  <div class="text-muted" style="font-size: 13px;">Rincian Pilihan Sewa Anda:</div>
                  <div class="text-white font-weight-bold" id="textRincianSewa" style="font-size: 15px;">
                    1 Hari (Lepas Kunci)
                  </div>
                  <div class="text-muted mt-1" id="textRincianTambahan" style="font-size: 12px;">
                    Tarif dasar: Rp <?php echo number_format($harga_hari, 0, ',', '.'); ?> x 1 Hari
                  </div>
                </div>

                <div class="text-md-right d-flex flex-column flex-sm-row align-items-sm-center" style="gap: 15px;">
                  <div>
                    <span class="d-block text-muted" style="font-size: 12px;">Total Biaya Sewa</span>
                    <span class="font-weight-bold" id="textTotalHarga" style="font-size: 26px; color: #ffcc00;">
                      Rp <?php echo number_format($harga_hari, 0, ',', '.'); ?>
                    </span>
                  </div>
                  <button type="button" class="btn btn-primary py-3 px-4 font-weight-bold btn-book-now">
                    Sewa Sekarang →
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row my-4">
          <div class="col-md-3 d-flex align-self-stretch mb-3 mb-md-0">
            <div class="media block-6 services p-3 rounded shadow-sm w-100 spec-card">
              <div class="media-body py-md-3">
                <div class="d-flex align-items-center">
                  <div class="icon d-flex align-items-center justify-content-center" style="background-color: #ffcc00 !important; color: #000 !important; min-width: 55px; height: 55px; border-radius: 50%;"><span class="flaticon-dashboard"></span></div>
                  <div class="text pl-3">
                    <h3 class="heading mb-0 text-white" style="font-size: 15px;">Jarak Tempuh<span class="d-block text-muted mt-1" style="font-size: 13px;"><?php echo $jarak_tempuh; ?></span></h3>
                  </div>
                </div>
              </div>
            </div>      
          </div>
          <div class="col-md-3 d-flex align-self-stretch mb-3 mb-md-0">
            <div class="media block-6 services p-3 rounded shadow-sm w-100 spec-card">
              <div class="media-body py-md-3">
                <div class="d-flex align-items-center">
                  <div class="icon d-flex align-items-center justify-content-center" style="background-color: #ffcc00 !important; color: #000 !important; min-width: 55px; height: 55px; border-radius: 50%;"><span class="flaticon-pistons"></span></div>
                  <div class="text pl-3">
                    <h3 class="heading mb-0 text-white" style="font-size: 15px;">Transmisi<span class="d-block text-muted mt-1" style="font-size: 13px;"><?php echo $transmisi; ?></span></h3>
                  </div>
                </div>
              </div>
            </div>      
          </div>
          <div class="col-md-3 d-flex align-self-stretch mb-3 mb-md-0">
            <div class="media block-6 services p-3 rounded shadow-sm w-100 spec-card">
              <div class="media-body py-md-3">
                <div class="d-flex align-items-center">
                  <div class="icon d-flex align-items-center justify-content-center" style="background-color: #ffcc00 !important; color: #000 !important; min-width: 55px; height: 55px; border-radius: 50%;"><span class="flaticon-car-seat"></span></div>
                  <div class="text pl-3">
                    <h3 class="heading mb-0 text-white" style="font-size: 15px;">Kapasitas<span class="d-block text-muted mt-1" style="font-size: 13px;"><?php echo $kursi; ?></span></h3>
                  </div>
                </div>
              </div>
            </div>      
          </div>
          <div class="col-md-3 d-flex align-self-stretch">
            <div class="media block-6 services p-3 rounded shadow-sm w-100 spec-card">
              <div class="media-body py-md-3">
                <div class="d-flex align-items-center">
                  <div class="icon d-flex align-items-center justify-content-center" style="background-color: #ffcc00 !important; color: #000 !important; min-width: 55px; height: 55px; border-radius: 50%;"><span class="flaticon-diesel"></span></div>
                  <div class="text pl-3">
                    <h3 class="heading mb-0 text-white" style="font-size: 15px;">Bahan Bakar<span class="d-block text-muted mt-1" style="font-size: 13px;"><?php echo $bbm; ?></span></h3>
                  </div>
                </div>
              </div>
            </div>      
          </div>
        </div>

        <div class="row my-4">
          <div class="col-md-6 mb-4 mb-md-0">
            <div class="p-4 spec-card h-100">
              <h4 class="font-weight-bold text-white mb-3 pb-3" style="border-bottom: 1px solid #333;">
                Spesifikasi Teknis Lengkap
              </h4>
              <table class="table spec-table mb-0">
                <tbody>
                  <tr>
                    <td class="spec-label">Merek / Pabrikan</td>
                    <td class="spec-value"><?php echo $mobil['merk']; ?></td>
                  </tr>
                  <tr>
                    <td class="spec-label">Model Kendaraan</td>
                    <td class="spec-value"><?php echo $mobil['nama_mobil']; ?></td>
                  </tr>
                  <tr>
                    <td class="spec-label">Tahun Produksi</td>
                    <td class="spec-value"><?php echo $tahun_produksi; ?></td>
                  </tr>
                  <tr>
                    <td class="spec-label">Kapasitas Mesin</td>
                    <td class="spec-value"><?php echo $kapasitas_mesin; ?></td>
                  </tr>
                  <tr>
                    <td class="spec-label">Tenaga Maksimal</td>
                    <td class="spec-value"><?php echo $tenaga_maksimal; ?></td>
                  </tr>
                  <tr>
                    <td class="spec-label">Sistem Transmisi</td>
                    <td class="spec-value"><?php echo $transmisi; ?></td>
                  </tr>
                  <tr>
                    <td class="spec-label">Kapasitas Penumpang</td>
                    <td class="spec-value"><?php echo $kursi; ?></td>
                  </tr>
                  <tr>
                    <td class="spec-label">Jenis Bahan Bakar</td>
                    <td class="spec-value"><?php echo $bbm; ?></td>
                  </tr>
                  <tr>
                    <td class="spec-label">Warna Eksterior</td>
                    <td class="spec-value"><?php echo $warna; ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <div class="col-md-6">
            <div class="p-4 spec-card h-100 d-flex flex-column justify-content-between">
              <div>
                <h4 class="font-weight-bold text-white mb-3 pb-3" style="border-bottom: 1px solid #333;">
                  Deskripsi & Kelengkapan
                </h4>
                <p class="text-muted mb-4" style="font-size: 14px; line-height: 1.7;">
                  <?php echo $deskripsi; ?>
                </p>

                <h5 class="font-weight-bold text-white mb-2" style="font-size: 16px;">Fitur & Fasilitas Termasuk:</h5>
                <ul class="feature-list">
                  <li><span class="feature-check">✓</span> AC Dual-Zone Climate Control</li>
                  <li><span class="feature-check">✓</span> Sistem Audio Premium & Apple CarPlay</li>
                  <li><span class="feature-check">✓</span> Sensor Parkir & Kamera 360°</li>
                  <li><span class="feature-check">✓</span> Airbags & Sistem Pengereman ABS</li>
                  <li><span class="feature-check">✓</span> GPS Tracker & Toolkit Darurat</li>
                  <li><span class="feature-check">✓</span> Asuransi Kendaraan All-Risk</li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <div class="row my-4 justify-content-center">
          <div class="col-md-6 text-center">
            <a href="car.php" class="btn btn-batal-dark btn-block py-2 font-weight-bold">← Kembali ke Katalog Mobil</a>
          </div>
        </div>

      </div>
    </section>

    <!-- Modal Form Booking Konfirmasi (Terhubung ke proses_sewa.php) -->
    <div class="modal fade" id="modalBooking" tabindex="-1" role="dialog" aria-labelledby="modalBookingLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title font-weight-bold" id="modalBookingLabel">Konfirmasi Penyewaan Mobil</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="proses_sewa.php" method="POST">
            <div class="modal-body">
              <input type="hidden" name="id_mobil" value="<?php echo $mobil['id_mobil']; ?>">
              <input type="hidden" name="merk" value="<?php echo htmlspecialchars($mobil['merk']); ?>">
              <input type="hidden" name="gambar" value="<?php echo htmlspecialchars($mobil['gambar']); ?>">
              <input type="hidden" name="total_harga" id="bookingTotalHargaAngka" value="<?php echo $harga_hari; ?>">

              <div class="form-group text-left">
                <label class="font-weight-bold">Mobil Yang Dipilih</label>
                <input type="text" name="nama_mobil" id="bookingNamaMobil" class="form-control" value="<?php echo htmlspecialchars($mobil['nama_mobil']); ?>" readonly>
              </div>
              <div class="form-group text-left">
                <label class="font-weight-bold">Detail Paket & Layanan</label>
                <input type="text" name="paket_sewa" id="bookingDetailPaket" class="form-control" readonly>
              </div>
              <div class="form-row text-left">
                <div class="form-group col-md-6">
                  <label class="font-weight-bold">Tanggal Mulai Sewa</label>
                  <input type="date" name="tanggal_mulai" id="bookingTanggal" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                  <label class="font-weight-bold">Total Pembayaran</label>
                  <input type="text" id="bookingTotalHarga" class="form-control font-weight-bold" style="color: #ffcc00 !important;" readonly>
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
        var tarifJam    = <?php echo $harga_jam; ?>;
        var tarifHari   = <?php echo $harga_hari; ?>;
        var tarifMinggu = <?php echo $harga_minggu; ?>;

        function formatRupiah(angka) {
          return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function hitungTotalSewa() {
          var paket   = $('#selectPaket').val();
          var durasi  = parseInt($('#inputDurasi').val());
          var sopir   = parseInt($('#selectLayanan').val());

          if (isNaN(durasi) || durasi < 1) {
            durasi = 1;
          }

          var hargaDasar = 0;
          var satuanTeks = '';
          var pengaliHariSopir = 1;

          if (paket === 'jam') {
            hargaDasar = tarifJam;
            satuanTeks = 'Jam';
            pengaliHariSopir = Math.ceil(durasi / 24);
            $('#labelDurasi').text('Jumlah Jam');
          } else if (paket === 'minggu') {
            hargaDasar = tarifMinggu;
            satuanTeks = 'Minggu';
            pengaliHariSopir = durasi * 7;
            $('#labelDurasi').text('Jumlah Minggu');
          } else {
            hargaDasar = tarifHari;
            satuanTeks = 'Hari';
            pengaliHariSopir = durasi;
            $('#labelDurasi').text('Jumlah Hari');
          }

          var subtotalMobil = hargaDasar * durasi;
          var biayaSopir    = sopir * pengaliHariSopir;
          var totalAkhir    = subtotalMobil + biayaSopir;

          var teksLayanan = (sopir > 0) ? 'Dengan Sopir' : 'Lepas Kunci';
          var teksRincian = durasi + ' ' + satuanTeks + ' (' + teksLayanan + ')';
          var teksDetail  = 'Tarif: ' + formatRupiah(hargaDasar) + ' x ' + durasi + ' ' + satuanTeks;
          if (biayaSopir > 0) {
            teksDetail += ' + Jasa Sopir (' + formatRupiah(biayaSopir) + ')';
          }

          $('#textRincianSewa').text(teksRincian);
          $('#textRincianTambahan').text(teksDetail);
          $('#textTotalHarga').text(formatRupiah(totalAkhir));

          $('.rate-card').removeClass('active-rate');
          $('.rate-card[data-paket="jam"] .rate-badge').text('Klik untuk pilih paket Jam');
          $('.rate-card[data-paket="hari"] .rate-badge').text('Klik untuk pilih paket Hari');
          $('.rate-card[data-paket="minggu"] .rate-badge').text('Klik untuk pilih paket Minggu');

          var activeCard = $('.rate-card[data-paket="' + paket + '"]');
          activeCard.addClass('active-rate');
          activeCard.find('.rate-badge').text('Paket Terpilih');

          $('#bookingDetailPaket').val(teksRincian);
          $('#bookingTotalHarga').val(formatRupiah(totalAkhir));
          $('#bookingTotalHargaAngka').val(totalAkhir);
          $('#bookingTanggal').val($('#inputTanggalMulai').val());
        }

        $('.rate-card').on('click', function() {
          var paketDipilih = $(this).data('paket');
          $('#selectPaket').val(paketDipilih);
          hitungTotalSewa();
        });

        $('#selectPaket, #selectLayanan, #inputTanggalMulai').on('change', hitungTotalSewa);
        $('#inputDurasi').on('input change', hitungTotalSewa);

        $('.btn-book-now').on('click', function() {
          hitungTotalSewa();
          $('#modalBooking').modal('show');
        });

        hitungTotalSewa();
      });
    </script>
  </body>
</html>