-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2026 at 02:52 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_rental_mobil`
--

-- --------------------------------------------------------

--
-- Table structure for table `table_admin`
--

CREATE TABLE `table_admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_admin`
--

INSERT INTO `table_admin` (`id_admin`, `username`, `password`, `nama_lengkap`) VALUES
(1, 'admin', 'admin123', 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `table_mobil`
--

CREATE TABLE `table_mobil` (
  `id_mobil` int(11) NOT NULL,
  `nama_mobil` varchar(100) NOT NULL,
  `merk` varchar(50) NOT NULL,
  `harga_sewa` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Tersedia',
  `transmisi` varchar(50) DEFAULT 'Automatic',
  `kapasitas` varchar(50) DEFAULT '2 Kursi',
  `bahan_bakar` varchar(50) DEFAULT 'Pertamax Turbo',
  `jarak_tempuh` varchar(50) DEFAULT '12.000 KM',
  `kapasitas_mesin` varchar(50) DEFAULT '3.800 cc Twin-Turbo',
  `tenaga_maksimal` varchar(50) DEFAULT '580 HP',
  `tahun_produksi` varchar(10) DEFAULT '2023',
  `warna` varchar(50) DEFAULT 'Hitam Metalik',
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_mobil`
--

INSERT INTO `table_mobil` (`id_mobil`, `nama_mobil`, `merk`, `harga_sewa`, `gambar`, `status`, `transmisi`, `kapasitas`, `bahan_bakar`, `jarak_tempuh`, `kapasitas_mesin`, `tenaga_maksimal`, `tahun_produksi`, `warna`, `deskripsi`) VALUES
(1, 'Mercedes SLK Roadster', 'Mercedes-Benz', 7500000, 'car-1.jpg', 'Tersedia', 'Automatic', '2 Kursi', 'Pertamax Turbo', '12.000 KM', '3.800 cc Twin-Turbo', '580 HP', '2023', 'Hitam Metalik', NULL),
(2, 'Range Rover Sport SUV', 'Land Rover', 10500000, 'car-2.jpg', 'Tersedia', 'Automatic', '2 Kursi', 'Pertamax Turbo', '12.000 KM', '3.800 cc Twin-Turbo', '580 HP', '2023', 'Hitam Metalik', NULL),
(3, 'McLaren 720S Supercar', 'McLaren', 22500000, 'car-3.jpg', 'Tersedia', 'Automatic', '2 Kursi', 'Pertamax Turbo', '12.000 KM', '3.800 cc Twin-Turbo', '580 HP', '2023', 'Hitam Metalik', NULL),
(4, 'Ford Mustang GT Coupe', 'Ford', 9000000, 'car-4.jpg', 'Tersedia', 'Automatic', '2 Kursi', 'Pertamax Turbo', '12.000 KM', '3.800 cc Twin-Turbo', '580 HP', '2023', 'Hitam Metalik', NULL),
(5, 'BMW 3 Series Gran', 'BMW', 9750000, 'car-5.jpg', 'Tersedia', 'Automatic', '2 Kursi', 'Pertamax Turbo', '12.000 KM', '3.800 cc Twin-Turbo', '580 HP', '2023', 'Hitam Metalik', NULL),
(6, 'Alfa Romeo 4C Sport', 'Alfa Romeo', 12000000, 'car-6.jpg', 'Tersedia', 'Automatic', '2 Kursi', 'Pertamax Turbo', '12.000 KM', '3.800 cc Twin-Turbo', '580 HP', '2023', 'Hitam Metalik', NULL),
(7, 'Mercedes-Benz Luxury', 'Mercedes-Benz', 11250000, 'car-7.jpg', 'Tersedia', 'Automatic', '2 Kursi', 'Pertamax Turbo', '12.000 KM', '3.800 cc Twin-Turbo', '580 HP', '2023', 'Hitam Metalik', NULL),
(8, 'Jeep Wrangler Unlimited', 'Jeep', 8250000, 'car-8.jpg', 'Tersedia', 'Automatic', '2 Kursi', 'Pertamax Turbo', '12.000 KM', '3.800 cc Twin-Turbo', '580 HP', '2023', 'Hitam Metalik', NULL),
(9, 'Mercedes-AMG GT S', 'Mercedes-AMG', 10500000, 'car-9.jpg', 'Tersedia', 'Automatic', '2 Kursi', 'Pertamax Turbo', '12.000 KM', '3.800 cc Twin-Turbo', '580 HP', '2023', 'Hitam Metalik', NULL),
(10, 'Mercedes-AMG GT R', 'Mercedes-AMG', 14350000, 'car-10.jpg', 'Tersedia', 'Automatic', '2 Kursi', 'Pertamax Turbo', '12.000 KM', '3.800 cc Twin-Turbo', '580 HP', '2023', 'Hitam Metalik', NULL),
(11, 'Chevrolet Corvette Stingray', 'Chevrolet', 12750000, 'car-11.jpg', 'Tersedia', 'Automatic', '2 Kursi', 'Pertamax Turbo', '12.000 KM', '3.800 cc Twin-Turbo', '580 HP', '2023', 'Hitam Metalik', NULL),
(12, 'Audi A1 Hatchback', 'Audi', 21000000, 'car-12.jpg', 'Tersedia', 'Automatic', '2 Kursi', 'Pertamax Turbo', '12.000 KM', '3.800 cc Twin-Turbo', '580 HP', '2023', 'Hitam Metalik', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `table_sewa`
--

CREATE TABLE `table_sewa` (
  `id_sewa` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `id_mobil` int(11) NOT NULL,
  `nama_mobil` varchar(100) NOT NULL,
  `merk` varchar(100) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `paket_sewa` varchar(100) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `total_harga` int(11) NOT NULL,
  `nama_pemesan` varchar(100) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `status_sewa` varchar(50) DEFAULT 'Dikonfirmasi',
  `waktu_transaksi` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_sewa`
--

INSERT INTO `table_sewa` (`id_sewa`, `username`, `id_mobil`, `nama_mobil`, `merk`, `gambar`, `paket_sewa`, `tanggal_mulai`, `total_harga`, `nama_pemesan`, `no_hp`, `status_sewa`, `waktu_transaksi`) VALUES
(1, 'shkia', 5, 'BMW 3 Series Gran', 'BMW', 'car-5.jpg', '2 Jam (Lepas Kunci)', '2026-11-14', 1950000, 'shaskia', '081122334455', 'Dibatalkan', '2026-11-14 12:57:45'),
(2, 'shkia', 1, 'Mercedes SLK Roadster', 'Mercedes-Benz', 'car-1.jpg', '1 Jam (Lepas Kunci)', '2026-11-14', 750000, 'shaskia', '081122334455', 'Dikonfirmasi', '2026-11-14 12:58:40'),
(3, 'shkia', 10, 'Mercedes-AMG GT R', 'Mercedes-AMG', 'car-10.jpg', '1 Jam (Lepas Kunci)', '2026-11-14', 1435000, 'shaskia', '081122334455', 'Dibatalkan', '2026-11-14 13:26:17'),
(4, 'shkia', 11, 'Chevrolet Corvette Stingray', 'Chevrolet', 'car-11.jpg', '1 Jam (Lepas Kunci)', '2026-11-14', 1275000, 'shaskia', '081122334455', 'Dikonfirmasi', '2026-11-14 13:27:41'),
(5, 'shnez', 9, 'Mercedes-AMG GT S', 'Mercedes-AMG', 'car-9.jpg', '1 Jam (Lepas Kunci)', '2026-11-14', 1050000, 'shnez', '081122334455', 'Dikonfirmasi', '2026-11-14 13:30:19');

-- --------------------------------------------------------

--
-- Table structure for table `table_user`
--

CREATE TABLE `table_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_user`
--

INSERT INTO `table_user` (`id_user`, `username`, `password`, `nama_lengkap`, `email`) VALUES
(1, 'shnez', 'masuk123', 'Shanez Jequelline', 'shnez@gmail.com'),
(2, 'shkia', 'masuk123', 'shaskia', 'shaskia@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `table_admin`
--
ALTER TABLE `table_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `table_mobil`
--
ALTER TABLE `table_mobil`
  ADD PRIMARY KEY (`id_mobil`);

--
-- Indexes for table `table_sewa`
--
ALTER TABLE `table_sewa`
  ADD PRIMARY KEY (`id_sewa`);

--
-- Indexes for table `table_user`
--
ALTER TABLE `table_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `table_admin`
--
ALTER TABLE `table_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `table_mobil`
--
ALTER TABLE `table_mobil`
  MODIFY `id_mobil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `table_sewa`
--
ALTER TABLE `table_sewa`
  MODIFY `id_sewa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `table_user`
--
ALTER TABLE `table_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
