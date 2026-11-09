<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_rental_mobil");

mysqli_report(MYSQLI_REPORT_OFF);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>