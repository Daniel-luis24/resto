-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Des 2024 pada 17.59
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dewi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bukti_pembayaran`
--

CREATE TABLE `bukti_pembayaran` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `payment_method` enum('cash','transfer') NOT NULL,
  `grand_total` decimal(10,2) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bukti_pembayaran`
--

INSERT INTO `bukti_pembayaran` (`id`, `order_id`, `file_path`, `name`, `number`, `email`, `payment_method`, `grand_total`, `created_at`) VALUES
(12, 35, 'uploads/MySQLWorkbench.png', 'ilham', '089605646221', 'ilham.shadiq24@gmail.com', 'transfer', 34000.00, '2024-12-26 12:12:33'),
(13, 36, 'uploads/MySQL-Logo.jpeg', 'ilham', '1234', 'if23.muhammadshadiq@mhs.ubpkarawang.ac.id', 'cash', 22000.00, '2024-12-26 12:55:32'),
(14, 37, 'uploads/Cuplikan layar 2024-12-06 191659.png', 'PT. TOYOTA MOTOR MANUFACTURING INDONESIA', '089605646221', 'toyota.indonesia@gmail.com', 'transfer', 110000.00, '2024-12-26 14:01:00'),
(15, 38, 'uploads/Cuplikan layar 2024-12-06 191659.png', 'ilham', '089605646221', 'ilham.shadiq24@gmail.com', 'transfer', 46000.00, '2024-12-27 10:10:36'),
(16, 39, 'uploads/Cuplikan layar 2024-12-03 171602.png', 'reysha', '089605646221', 'ilham.shadiq24@gmail.com', 'transfer', 46000.00, '2024-12-27 10:35:39'),
(17, 40, 'uploads/Cuplikan layar 2024-12-06 191659.png', 'ilham', '11111111', 'ilham.shadiq24@gmail.com', 'transfer', 46000.00, '2024-12-27 10:44:51'),
(18, 41, 'uploads/Cuplikan layar 2024-12-11 190957.png', 'ilham', '0111111', 'ilham.shadiq24@gmail.com', 'transfer', 46000.00, '2024-12-27 10:53:08'),
(19, 42, 'uploads/Cuplikan layar 2024-12-11 190957.png', 'ilham', '222222', 'ilham.shadiq24@gmail.com', 'transfer', 58000.00, '2024-12-27 11:08:46'),
(20, 43, 'uploads/Cuplikan layar 2024-12-03 171602.png', 'shadiq', '0999999999', 'ilham.shadiq24@gmail.com', 'transfer', 63000.00, '2024-12-27 11:20:21'),
(21, 44, 'uploads/MySQLWorkbench.png', 'azhila', '08242242424', 'ilham.shadiq24@gmail.com', 'transfer', 104000.00, '2024-12-27 13:23:40'),
(22, 50, 'uploads/MySQL-Logo.jpeg', 'agus', '0897654321', 'ilham.shadiq24@gmail.com', 'transfer', 104000.00, '2024-12-27 14:43:25'),
(23, 53, 'uploads/aqua.jpg', 'alip', '089374721', 'ilham.shadiq24@gmail.com', 'transfer', 176000.00, '2024-12-27 15:03:41'),
(24, 74, 'uploads/mie5.jpg', 'udin', '08971615243', 'ilham.shadiq24@gmail.com', 'transfer', 17000.00, '2024-12-27 16:39:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cart`
--

CREATE TABLE `cart` (
  `id_cart` int(11) NOT NULL,
  `nama_menu` varchar(300) NOT NULL,
  `harga` decimal(10,0) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `cart`
--

INSERT INTO `cart` (`id_cart`, `nama_menu`, `harga`, `jumlah`, `img`) VALUES
(136, 'IFUMIE KUAH', 12000, 2, 'ifumiekuah.jpeg'),
(137, 'Aqua', 5000, 2, 'aqua.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `id` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `nama_menu` varchar(255) NOT NULL,
  `harga` decimal(10,0) NOT NULL,
  `kategori` enum('Makanan','Minuman') NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga`, `kategori`, `img`) VALUES
(3, 'Aqua', 5000, 'Minuman', 'aqua.jpg'),
(10, 'Es Jeruk', 5000, 'Minuman', 'esjeruk.jpg'),
(19, 'IFUMIE KUAH', 12000, 'Makanan', 'ifumiekuah.jpeg'),
(20, 'MIE ACEH KUAH', 12000, 'Makanan', 'mie2.jpg'),
(23, 'ES KOPI', 8000, 'Minuman', 'es-kopi-susu.jpg'),
(24, 'MIE INDOMIE BANGLADESH', 12000, 'Makanan', 'mie4.jpg'),
(25, 'saos', 13000, '', 'Cuplikan layar 2024-12-11 232615.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `number` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `total_menu` text NOT NULL,
  `total_harga` decimal(10,2) NOT NULL,
  `tempat` varchar(255) NOT NULL,
  `order_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `order`
--

INSERT INTO `order` (`id`, `name`, `number`, `email`, `total_menu`, `total_harga`, `tempat`, `order_date`) VALUES
(28, 'ong', '09877393', 'jihanmuhammad@gmail.com', 'ayam (4) ', 80000.00, '', '2024-12-16 10:56:13'),
(29, 'ong', '09877393', 'jihanmuhammad@gmail.com', 'ayam (4) ', 80000.00, '', '2024-12-16 10:58:24'),
(30, 'ong', '09877393', 'jihanmuhammad@gmail.com', 'ayam (4) ', 80000.00, '', '2024-12-16 10:58:55'),
(31, 'ong', '09877393', 'jihanmuhammad@gmail.com', 'ayam (4) ', 80000.00, '', '2024-12-16 10:59:10'),
(32, 'ong', '09877393', 'jihanmuhammad@gmail.com', 'ayam (4) ', 80000.00, '', '2024-12-16 11:00:07'),
(33, 'ong', '09877393', 'jihanmuhammad@gmail.com', 'ayam (4) ', 80000.00, '', '2024-12-16 11:00:45'),
(34, 'ong', '09877393', 'jihanmuhammad@gmail.com', 'ayam (4) ', 80000.00, '', '2024-12-16 11:00:53'),
(35, 'sarah', '321', 'sarah@gmail.com', 'ayam (4) ', 80000.00, '', '2024-12-16 11:02:52'),
(36, 'sarah', '321', 'sarah@gmail.com', 'ayam (4) ', 80000.00, '', '2024-12-16 11:03:23'),
(37, 'Ilham', '089681111', 'ilham.shadiq24@gmail.com', 'ayam (3) , Aqua (3) , Kopi (1) ', 76000.00, '', '2024-12-16 12:53:16'),
(38, 'shadiq', '089605641212', 'if23.muhammadshadiq@mhs.ubpkarawang.ac.id', 'ayam (3) , Aqua (3) , Kopi (1) ', 76000.00, '', '2024-12-16 12:54:39'),
(39, 'ilham', '4121212', 'ilham.shadiq24@gmail.com', 'ayam (3) , Aqua (3) , Kopi (1) ', 76000.00, '', '2024-12-16 12:55:11'),
(40, 'ilham', '4121212', 'ilham.shadiq24@gmail.com', 'ayam (3) , Aqua (3) , Kopi (1) ', 76000.00, '', '2024-12-16 13:00:31'),
(41, 'ilham', '324324324', 'ilham.shadiq24@gmail.com', 'ayam (3) , Aqua (3) , Kopi (1) ', 76000.00, '', '2024-12-16 13:01:30'),
(42, 'reysha', '089274629292', 'if23.muhammadshadiq@mhs.ubpkarawang.ac.id', 'Aqua (2) , ayam (1) ', 26000.00, '', '2024-12-19 23:27:02'),
(43, 'ilham', '000999', 'ilham.shadiq24@gmail.com', 'ayam (1) , Aqua (1) , Mie Aceh (1) , Ifumie Kuah (1) ', 56000.00, '', '2024-12-19 23:31:21'),
(44, 'ilham', '000999', 'ilham.shadiq24@gmail.com', 'ayam (1) , Aqua (1) , Mie Aceh (1) , Ifumie Kuah (1) ', 56000.00, '', '2024-12-19 23:41:47'),
(45, 'ilham', '0894334627', 'if23.muhammadshadiq@mhs.ubpkarawang.ac.id', 'ayam (4) ', 80000.00, '', '2024-12-19 23:43:36'),
(46, 'ilham', '0894334627', 'if23.muhammadshadiq@mhs.ubpkarawang.ac.id', 'ayam (4) ', 80000.00, '', '2024-12-19 23:44:04'),
(47, 'ilham', '0894334627', 'if23.muhammadshadiq@mhs.ubpkarawang.ac.id', 'ayam (4) ', 80000.00, '', '2024-12-19 23:44:53'),
(48, 'ilham', '08992642213', 'if23.muhammadshadiq@mhs.ubpkarawang.ac.id', 'ayam (1) , Aqua (1) ', 23000.00, '', '2024-12-19 23:51:28'),
(49, 'hghghgk', '66966', 'if23.muhammadshadiq@mhs.ubpkarawang.ac.id', 'ayam (2) , Aqua (2) ', 46000.00, '', '2024-12-20 02:33:20'),
(50, 'MUHAMMAD ILHAM SHADIQ', '896056462211', 'if23.muhammadshadiq@mhs.ubpkarawang.ac.id', 'IFUMIE GORENG (1) , Aqua (1) ', 17000.00, '', '2024-12-23 19:10:09'),
(51, 'ilham', '08946271811', 'if23.muhammadshadiq@mhs.ubpkarawang.ac.id', 'IFUMIE GORENG (1) , Aqua (1) , Es Jeruk (1) , MIE ACEH GORENG (1) ', 34000.00, '', '2024-12-23 19:19:54'),
(52, 'MUHAMMAD ILHAM SHADIQ', '09875656576', 'if23.muhammadshadiq@mhs.ubpkarawang.ac.id', 'IFUMIE GORENG (1) ', 12000.00, '', '2024-12-23 19:27:32'),
(53, 'ilham', '089346372', 'if23.muhammadshadiq@mhs.ubpkarawang.ac.id', 'IFUMIE GORENG (10) , Aqua (10) ', 170000.00, '', '2024-12-23 19:31:19'),
(54, '121212', '1212121212', 'if23.muhammadshadiq@mhs.ubpkarawang.ac.id', '', 0.00, '', '2024-12-23 19:50:44'),
(55, '121212', '1212121212', 'if23.muhammadshadiq@mhs.ubpkarawang.ac.id', '', 0.00, '', '2024-12-23 19:52:14'),
(56, 'ilham', '089482972', 'if23.muhammadshadiq@mhs.ubpkarawang.ac.id', '', 0.00, '', '2024-12-23 19:57:12'),
(57, 'ilham', '0138923829', 'if23.muhammadshadiq@mhs.ubpkarawang.ac.id', 'IFUMIE GORENG (1) ', 12000.00, '', '2024-12-23 20:01:53'),
(58, 'ilham', '023829487', 'if23.muhammadshadiq@mhs.ubpkarawang.ac.id', 'IFUMIE GORENG (1) ', 12000.00, '', '2024-12-23 20:02:25'),
(59, 'ilham', '023829487', 'if23.muhammadshadiq@mhs.ubpkarawang.ac.id', '', 0.00, '', '2024-12-23 20:04:30'),
(60, 'ilham', '038', 'if23.muhammadshadiq@mhs.ubpkarawang.ac.id', 'IFUMIE GORENG (1) ', 12000.00, '', '2024-12-23 20:04:51'),
(61, 'ilham', '123', 'if23.muhammadshadiq@mhs.ubpkarawang.ac.id', 'IFUMIE GORENG (1) ', 12000.00, '', '2024-12-23 20:15:38'),
(62, 'ilham', '1233445', 'if23.muhammadshadiq@mhs.ubpkarawang.ac.id', 'IFUMIE GORENG (5) ', 60000.00, '', '2024-12-24 08:19:59'),
(63, 'ilham', '0193947', 'if23.muhammadshadiq@mhs.ubpkarawang.ac.id', 'IFUMIE GORENG (1) , Aqua (1) ', 17000.00, '', '2024-12-24 08:22:14'),
(64, 'esa', '089605646221', 'if23.muhammadshadiq@mhs.ubpkarawang.ac.id', 'IFUMIE GORENG (8) ', 96000.00, '', '2024-12-24 08:23:00'),
(65, 'ilham', '0999999', 'if23.muhammadshadiq@mhs.ubpkarawang.ac.id', 'IFUMIE GORENG (5) ', 60000.00, '', '2024-12-24 08:24:49'),
(66, 'ilham', '09899', 'ilham.shadiq24@gmail.com', 'IFUMIE GORENG (1) , Aqua (1) ', 17000.00, '', '2024-12-24 08:38:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `payment_method` enum('cash','transfer') NOT NULL,
  `tempat` enum('dine in','take away') NOT NULL,
  `grand_total` decimal(10,2) NOT NULL,
  `status` enum('Menunggu','Diterima') DEFAULT 'Menunggu',
  `tanggal_pemesanan` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `name`, `number`, `email`, `payment_method`, `tempat`, `grand_total`, `status`, `tanggal_pemesanan`) VALUES
(35, 'ilham', '089605646221', 'ilham.shadiq24@gmail.com', 'transfer', 'take away', 34000.00, 'Diterima', '2024-12-26 12:11:10'),
(36, 'ilham', '1234', 'if23.muhammadshadiq@mhs.ubpkarawang.ac.id', 'cash', 'take away', 22000.00, 'Diterima', '2024-12-26 12:55:19'),
(37, 'PT. TOYOTA MOTOR MANUFACTURING INDONESIA', '089605646221', 'toyota.indonesia@gmail.com', 'transfer', 'dine in', 110000.00, 'Diterima', '2024-12-26 14:00:26'),
(38, 'ilham', '089605646221', 'ilham.shadiq24@gmail.com', 'transfer', 'dine in', 46000.00, 'Diterima', '2024-12-27 10:10:21'),
(39, 'reysha', '089605646221', 'ilham.shadiq24@gmail.com', 'transfer', 'dine in', 46000.00, 'Diterima', '2024-12-27 10:34:54'),
(40, 'ilham', '11111111', 'ilham.shadiq24@gmail.com', 'transfer', 'dine in', 46000.00, 'Diterima', '2024-12-27 10:44:44'),
(41, 'ilham', '0111111', 'ilham.shadiq24@gmail.com', 'transfer', 'dine in', 46000.00, 'Diterima', '2024-12-27 10:53:00'),
(42, 'ilham', '222222', 'ilham.shadiq24@gmail.com', 'transfer', 'dine in', 58000.00, 'Diterima', '2024-12-27 11:08:36'),
(43, 'shadiq', '0999999999', 'ilham.shadiq24@gmail.com', 'transfer', 'take away', 63000.00, 'Diterima', '2024-12-27 11:19:46'),
(44, 'azhila', '08242242424', 'ilham.shadiq24@gmail.com', 'transfer', 'dine in', 104000.00, 'Diterima', '2024-12-27 13:20:47'),
(45, 'reysha', '089999999', 'if23.muhammadshadiq@mhs.ubpkarawang.ac.id', 'transfer', 'dine in', 104000.00, 'Diterima', '2024-12-27 14:10:47'),
(46, 'ilham', '089654321', 'ilham.shadiq24@gmail.com', 'transfer', 'dine in', 104000.00, 'Diterima', '2024-12-27 14:15:24'),
(47, 'ilham', '089654321', 'ilham.shadiq24@gmail.com', 'transfer', 'dine in', 104000.00, 'Diterima', '2024-12-27 14:16:57'),
(48, 'reysha', '0123456789', 'ilham.shadiq24@gmail.com', 'transfer', 'dine in', 104000.00, 'Diterima', '2024-12-27 14:20:04'),
(49, 'reysha', '0123456789', 'ilham.shadiq24@gmail.com', 'transfer', 'dine in', 104000.00, 'Diterima', '2024-12-27 14:31:13'),
(50, 'agus', '0897654321', 'ilham.shadiq24@gmail.com', 'transfer', 'dine in', 104000.00, 'Diterima', '2024-12-27 14:31:53'),
(51, 'alip', '089374721', 'ilham.shadiq24@gmail.com', 'transfer', 'dine in', 176000.00, 'Diterima', '2024-12-27 14:47:46'),
(52, 'alip', '089374721', 'ilham.shadiq24@gmail.com', 'transfer', 'dine in', 176000.00, 'Diterima', '2024-12-27 14:50:07'),
(53, 'alip', '089374721', 'ilham.shadiq24@gmail.com', 'transfer', 'dine in', 176000.00, 'Diterima', '2024-12-27 14:53:42'),
(54, 'ilham', '098776631212121', 'ilham.shadiq24@gmail.com', 'transfer', 'dine in', 56000.00, 'Diterima', '2024-12-27 16:08:00'),
(55, 'ilham', '098776631212121', 'ilham.shadiq24@gmail.com', 'transfer', 'dine in', 56000.00, 'Diterima', '2024-12-27 16:08:55'),
(56, 'azhila', '09872312345', 'id74.meidi1005@gmail.com', 'cash', 'dine in', 56000.00, 'Diterima', '2024-12-27 16:09:23'),
(57, 'azhila', '09872312345', 'id74.meidi1005@gmail.com', 'cash', 'dine in', 56000.00, 'Diterima', '2024-12-27 16:09:56'),
(58, 'ilham', '0896753121212', 'ilham.shadiq24@gmail.com', 'cash', 'dine in', 56000.00, 'Diterima', '2024-12-27 16:16:22'),
(59, 'ilham', '0896753121212', 'ilham.shadiq24@gmail.com', 'cash', 'dine in', 56000.00, 'Diterima', '2024-12-27 16:16:58'),
(60, 'ilham', '0896753121212', 'ilham.shadiq24@gmail.com', 'cash', 'dine in', 56000.00, 'Diterima', '2024-12-27 16:17:38'),
(61, 'ilham', '0896753121212', 'ilham.shadiq24@gmail.com', 'cash', 'dine in', 56000.00, 'Menunggu', '2024-12-27 16:18:22'),
(62, 'ilham', '0896753121212', 'ilham.shadiq24@gmail.com', 'cash', 'dine in', 56000.00, 'Menunggu', '2024-12-27 16:20:15'),
(63, 'ilham', '0896753121212', 'ilham.shadiq24@gmail.com', 'cash', 'dine in', 56000.00, 'Diterima', '2024-12-27 16:20:24'),
(64, 'ilham', '0896753121212', 'ilham.shadiq24@gmail.com', 'transfer', 'dine in', 56000.00, 'Diterima', '2024-12-27 16:20:31'),
(65, 'ilham', '0896753121212', 'ilham.shadiq24@gmail.com', 'transfer', 'dine in', 56000.00, 'Menunggu', '2024-12-27 16:21:09'),
(66, 'ilham', '0896753121212', 'ilham.shadiq24@gmail.com', 'transfer', 'dine in', 56000.00, 'Menunggu', '2024-12-27 16:21:28'),
(67, 'ilham', '0896753121212', 'ilham.shadiq24@gmail.com', 'transfer', 'dine in', 56000.00, 'Menunggu', '2024-12-27 16:23:58'),
(68, 'ilham', '0896753121212', 'ilham.shadiq24@gmail.com', 'cash', 'take away', 56000.00, 'Menunggu', '2024-12-27 16:24:22'),
(69, 'ilham', '089765423675', 'ilham.shadiq24@gmail.com', 'cash', 'take away', 56000.00, 'Menunggu', '2024-12-27 16:25:06'),
(70, 'ilham', '089765423675', 'ilham.shadiq24@gmail.com', 'cash', 'take away', 56000.00, 'Menunggu', '2024-12-27 16:27:39'),
(71, 'ilham', '089765423675', 'ilham.shadiq24@gmail.com', 'cash', 'take away', 56000.00, 'Menunggu', '2024-12-27 16:29:02'),
(72, 'ilham', '089765423675', 'ilham.shadiq24@gmail.com', 'cash', 'take away', 56000.00, 'Menunggu', '2024-12-27 16:32:33'),
(73, 'nusa', '08128082812', 'nusa@gmail.com', 'cash', 'take away', 42000.00, 'Menunggu', '2024-12-27 16:36:42'),
(74, 'udin', '08971615243', 'ilham.shadiq24@gmail.com', 'transfer', 'dine in', 17000.00, 'Menunggu', '2024-12-27 16:39:13'),
(75, 'nusa', '0987343412341', 'ilham.shadiq24@gmail.com', 'cash', 'dine in', 27000.00, 'Menunggu', '2024-12-27 16:42:00'),
(76, 'nusa', '0987343412341', 'ilham.shadiq24@gmail.com', 'cash', 'dine in', 27000.00, 'Menunggu', '2024-12-27 16:42:21'),
(77, 'nusa', '0987343412341', 'ilham.shadiq24@gmail.com', 'cash', 'dine in', 27000.00, 'Menunggu', '2024-12-27 16:44:40'),
(78, 'azhila', '089654321123', 'ilham.shadiq24@gmail.com', 'transfer', 'take away', 27000.00, 'Menunggu', '2024-12-27 17:37:49'),
(79, 'ilham', '1234567890', 'if23.muhammadshadiq@mhs.ubpkarawang.ac.id', 'transfer', 'dine in', 27000.00, 'Diterima', '2024-12-27 17:46:33'),
(80, 'aldi', '08976543213', 'if23.muhammadshadiq@mhs.ubpkarawang.ac.id', 'transfer', 'dine in', 27000.00, 'Diterima', '2024-12-27 17:50:40'),
(81, 'reysha', '09999999999', 'ilham.shadiq24@gmail.com', 'transfer', 'dine in', 27000.00, 'Menunggu', '2024-12-27 22:35:53'),
(82, 'abe', '089605646221', 'ilham.shadiq24@gmail.com', 'transfer', 'take away', 39000.00, 'Menunggu', '2024-12-27 23:56:59'),
(83, 'reysha', '089605646221', 'ilham.shadiq24@gmail.com', 'cash', 'take away', 32000.00, 'Menunggu', '2024-12-28 00:14:57'),
(84, 'ilham', '092824767127', 'ilham.shadiq24@gmail.com', 'transfer', 'dine in', 44000.00, 'Menunggu', '2024-12-28 00:42:25'),
(85, 'ilham', '092824767127', 'ilham.shadiq24@gmail.com', 'transfer', 'dine in', 44000.00, 'Menunggu', '2024-12-28 00:42:44'),
(86, 'abe', '089266262617', 'ilham.shadiq24@gmail.com', 'transfer', 'dine in', 76000.00, 'Menunggu', '2024-12-28 11:31:32'),
(87, 'daniel', '089763451721', 'ilham.shadiq24@gmail.com', 'cash', 'take away', 46000.00, 'Menunggu', '2024-12-28 11:47:21'),
(88, 'reysha', '12343454657632', 'ilham.shadiq24@gmail.com', 'transfer', 'dine in', 46000.00, 'Menunggu', '2024-12-28 11:48:41'),
(89, 'luis', '32278643267', 'if23.muhammadf@mhs.ubpkarawang.ac.id', 'cash', 'dine in', 22000.00, 'Menunggu', '2024-12-28 12:48:50'),
(90, 'luis', '32278643267', 'if23.muhammadf@mhs.ubpkarawang.ac.id', 'cash', 'dine in', 22000.00, 'Menunggu', '2024-12-28 12:51:38'),
(91, 'luis', '32278643267', 'if23.muhammadf@mhs.ubpkarawang.ac.id', 'cash', 'dine in', 22000.00, 'Menunggu', '2024-12-28 12:51:53'),
(92, 'luis', '32278643267', 'if23.muhammadf@mhs.ubpkarawang.ac.id', 'transfer', 'dine in', 22000.00, 'Menunggu', '2024-12-28 12:52:46'),
(93, 'luis', '32278643267', 'if23.muhammadf@mhs.ubpkarawang.ac.id', 'transfer', 'dine in', 22000.00, 'Menunggu', '2024-12-28 12:56:47'),
(94, 'luis', '32278643267', 'if23.muhammadf@mhs.ubpkarawang.ac.id', 'transfer', 'dine in', 22000.00, 'Menunggu', '2024-12-28 12:57:05'),
(95, 'luis', '32278643267', 'if23.muhammadf@mhs.ubpkarawang.ac.id', 'transfer', 'dine in', 22000.00, 'Menunggu', '2024-12-28 12:57:13'),
(96, 'luis', '32278643267', 'if23.muhammadf@mhs.ubpkarawang.ac.id', 'transfer', 'dine in', 22000.00, 'Menunggu', '2024-12-28 12:58:38'),
(97, 'luis', '32278643267', 'if23.muhammadf@mhs.ubpkarawang.ac.id', 'transfer', 'dine in', 22000.00, 'Menunggu', '2024-12-28 13:00:55'),
(98, 'luis', '32278643267', 'if23.muhammadf@mhs.ubpkarawang.ac.id', 'transfer', 'dine in', 22000.00, 'Menunggu', '2024-12-28 13:01:23'),
(99, 'luis', '32278643267', 'if23.muhammadf@mhs.ubpkarawang.ac.id', 'transfer', 'dine in', 22000.00, 'Menunggu', '2024-12-28 13:03:27'),
(100, 'luis', '32278643267', 'if23.muhammadf@mhs.ubpkarawang.ac.id', 'transfer', 'dine in', 22000.00, 'Menunggu', '2024-12-28 13:05:07'),
(101, 'luis', '32278643267', 'if23.muhammadf@mhs.ubpkarawang.ac.id', 'transfer', 'dine in', 22000.00, 'Menunggu', '2024-12-28 13:07:14'),
(102, 'luis', '32278643267', 'if23.muhammadf@mhs.ubpkarawang.ac.id', 'transfer', 'dine in', 22000.00, 'Menunggu', '2024-12-28 13:14:48'),
(103, 'luis', '32278643267', 'if23.muhammadf@mhs.ubpkarawang.ac.id', 'transfer', 'dine in', 22000.00, 'Menunggu', '2024-12-28 13:15:06'),
(104, 'luis', '32278643267', 'if23.muhammadf@mhs.ubpkarawang.ac.id', 'transfer', 'dine in', 22000.00, 'Menunggu', '2024-12-28 13:15:15'),
(105, 'luis', '32278643267', 'if23.muhammadf@mhs.ubpkarawang.ac.id', 'transfer', 'dine in', 22000.00, 'Menunggu', '2024-12-28 13:15:38'),
(106, 'luis', '32278643267', 'if23.muhammadf@mhs.ubpkarawang.ac.id', 'transfer', 'dine in', 22000.00, 'Menunggu', '2024-12-28 13:16:00'),
(107, 'luis', '32278643267', 'if23.muhammadf@mhs.ubpkarawang.ac.id', 'transfer', 'dine in', 22000.00, 'Menunggu', '2024-12-28 13:17:22'),
(108, 'luis', '32278643267', 'if23.muhammadf@mhs.ubpkarawang.ac.id', 'transfer', 'dine in', 22000.00, 'Menunggu', '2024-12-28 13:17:54'),
(109, 'luis', '32278643267', 'if23.muhammadf@mhs.ubpkarawang.ac.id', 'transfer', 'dine in', 22000.00, 'Menunggu', '2024-12-28 13:19:41'),
(110, 'luis', '085159388085', 'if23.danielpardede@mhs.ubpkarawang.ac.id', 'cash', 'take away', 22000.00, 'Menunggu', '2024-12-28 13:25:36'),
(111, 'luis', '085159388085', 'if23.danielpardede@mhs.ubpkarawang.ac.id', 'cash', 'take away', 22000.00, 'Menunggu', '2024-12-28 13:26:00'),
(112, 'luis', '085159388085', 'if23.danielpardede@mhs.ubpkarawang.ac.id', 'cash', 'take away', 22000.00, 'Menunggu', '2024-12-28 13:26:11'),
(113, 'luis', '085159388085', 'if23.danielpardede@mhs.ubpkarawang.ac.id', 'cash', 'take away', 22000.00, 'Menunggu', '2024-12-28 13:27:45'),
(114, 'luis', '085159388085', 'if23.danielpardede@mhs.ubpkarawang.ac.id', 'cash', 'take away', 22000.00, 'Menunggu', '2024-12-28 13:27:54'),
(115, 'luis', '085159388085', 'if23.danielpardede@mhs.ubpkarawang.ac.id', 'cash', 'take away', 22000.00, 'Menunggu', '2024-12-28 13:29:04'),
(116, 'luis', '085159388085', 'if23.danielpardede@mhs.ubpkarawang.ac.id', 'cash', 'take away', 22000.00, 'Menunggu', '2024-12-28 13:29:10'),
(117, 'luis', '085159388085', 'if23.danielpardede@mhs.ubpkarawang.ac.id', 'cash', 'take away', 22000.00, 'Menunggu', '2024-12-28 13:29:24'),
(118, 'luis', '085159388085', 'if23.danielpardede@mhs.ubpkarawang.ac.id', 'cash', 'take away', 22000.00, 'Menunggu', '2024-12-28 13:29:34'),
(119, 'luis', '085159388085', 'if23.danielpardede@mhs.ubpkarawang.ac.id', 'cash', 'take away', 22000.00, 'Menunggu', '2024-12-28 13:29:47'),
(120, 'luis', '085159388085', 'if23.danielpardede@mhs.ubpkarawang.ac.id', 'cash', 'take away', 22000.00, 'Menunggu', '2024-12-28 13:30:21'),
(121, 'luis', '085159388085', 'if23.danielpardede@mhs.ubpkarawang.ac.id', 'cash', 'take away', 22000.00, 'Menunggu', '2024-12-28 13:30:49'),
(122, 'luis', '085159388085', 'if23.danielpardede@mhs.ubpkarawang.ac.id', 'cash', 'take away', 22000.00, 'Menunggu', '2024-12-28 13:31:07'),
(123, 'luis', '085159388085', 'if23.danielpardede@mhs.ubpkarawang.ac.id', 'cash', 'take away', 22000.00, 'Menunggu', '2024-12-28 13:33:05'),
(124, 'luis', '085159388085', 'if23.danielpardede@mhs.ubpkarawang.ac.id', 'cash', 'take away', 22000.00, 'Menunggu', '2024-12-28 13:33:53'),
(125, 'luis', '085159388085', 'if23.danielpardede@mhs.ubpkarawang.ac.id', 'cash', 'take away', 22000.00, 'Menunggu', '2024-12-28 13:34:08'),
(126, 'luis', '085159388085', 'if23.danielpardede@mhs.ubpkarawang.ac.id', 'cash', 'take away', 22000.00, 'Menunggu', '2024-12-28 13:34:37'),
(127, 'luis', '085159388085', 'if23.danielpardede@mhs.ubpkarawang.ac.id', 'cash', 'take away', 22000.00, 'Menunggu', '2024-12-28 13:35:14'),
(128, 'luis', '085159388085', 'if23.danielpardede@mhs.ubpkarawang.ac.id', 'cash', 'take away', 22000.00, 'Menunggu', '2024-12-28 13:35:17'),
(129, 'luis', '085159388085', 'if23.danielpardede@mhs.ubpkarawang.ac.id', 'cash', 'take away', 22000.00, 'Menunggu', '2024-12-28 13:35:28'),
(130, 'luis', '085159388085', 'if23.danielpardede@mhs.ubpkarawang.ac.id', 'cash', 'take away', 22000.00, 'Menunggu', '2024-12-28 13:35:34'),
(131, 'luis', '085159388085', 'if23.danielpardede@mhs.ubpkarawang.ac.id', 'cash', 'take away', 22000.00, 'Menunggu', '2024-12-28 13:35:50'),
(132, 'luis', '085159388085', 'if23.danielpardede@mhs.ubpkarawang.ac.id', 'cash', 'take away', 22000.00, 'Menunggu', '2024-12-28 13:36:08'),
(133, 'luis', '085159388085', 'if23.danielpardede@mhs.ubpkarawang.ac.id', 'cash', 'take away', 22000.00, 'Menunggu', '2024-12-28 13:36:10'),
(134, 'luis', '085159388085', 'if23.danielpardede@mhs.ubpkarawang.ac.id', 'cash', 'take away', 22000.00, 'Menunggu', '2024-12-28 13:36:23'),
(135, 'luis', '085159388085', 'if23.danielpardede@mhs.ubpkarawang.ac.id', 'cash', 'take away', 22000.00, 'Menunggu', '2024-12-28 13:36:24'),
(136, 'luis', '085159388085', 'if23.danielpardede@mhs.ubpkarawang.ac.id', 'cash', 'take away', 22000.00, 'Menunggu', '2024-12-28 13:36:55'),
(137, 'luis', '085159388085', 'if23.danielpardede@mhs.ubpkarawang.ac.id', 'cash', 'take away', 22000.00, 'Menunggu', '2024-12-28 13:36:59'),
(138, 'luis', '085159388085', 'if23.danielpardede@mhs.ubpkarawang.ac.id', 'cash', 'take away', 22000.00, 'Menunggu', '2024-12-28 13:37:03'),
(139, 'luis', '085159388085', 'if23.danielpardede@mhs.ubpkarawang.ac.id', 'cash', 'take away', 22000.00, 'Menunggu', '2024-12-28 13:37:06'),
(140, 'luis', '085159388085', 'if23.danielpardede@mhs.ubpkarawang.ac.id', 'cash', 'take away', 22000.00, 'Menunggu', '2024-12-28 13:37:11'),
(141, 'luis', '085159388085', 'if23.danielpardede@mhs.ubpkarawang.ac.id', 'cash', 'take away', 22000.00, 'Menunggu', '2024-12-28 13:37:20'),
(142, 'luis', '085159388085', 'if23.danielpardede@mhs.ubpkarawang.ac.id', 'cash', 'take away', 22000.00, 'Menunggu', '2024-12-28 13:37:33'),
(143, 'luis', '085159388085', 'if23.muhammadf@mhs.ubpkarawang.ac.id', 'transfer', 'take away', 22000.00, 'Menunggu', '2024-12-28 13:44:08'),
(144, 'luis', '085159388085', 'if23.muhammadf@mhs.ubpkarawang.ac.id', 'transfer', 'take away', 22000.00, 'Menunggu', '2024-12-28 13:46:05'),
(145, 'luis', '085159388085', 'if23.muhammadf@mhs.ubpkarawang.ac.id', 'transfer', 'take away', 46000.00, 'Menunggu', '2024-12-29 03:15:27'),
(146, 'luis', '085159388085', 'if23.muhammadf@mhs.ubpkarawang.ac.id', 'transfer', 'take away', 46000.00, 'Menunggu', '2024-12-29 03:15:45'),
(147, 'luis', '085159388085', 'if23.muhammadf@mhs.ubpkarawang.ac.id', 'transfer', 'take away', 46000.00, 'Menunggu', '2024-12-29 03:19:59'),
(148, 'luis', '085159388085', 'if23.muhammadf@mhs.ubpkarawang.ac.id', 'transfer', 'take away', 46000.00, 'Menunggu', '2024-12-29 03:20:30'),
(149, 'luis', '085159388085', 'if23.muhammadf@mhs.ubpkarawang.ac.id', 'transfer', 'take away', 12000.00, 'Menunggu', '2024-12-29 03:22:12'),
(150, 'luis', '0851573892', 'if23.danielpardede@mhs.ubpkarawang.ac.id', 'transfer', 'dine in', 34000.00, 'Menunggu', '2024-12-29 05:08:50'),
(151, 'luis', '0851573892', 'if23.danielpardede@mhs.ubpkarawang.ac.id', 'transfer', 'dine in', 34000.00, 'Menunggu', '2024-12-29 05:20:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`) VALUES
(7, 'ilham', '$2y$10$6LpplGzeMKNEHZ0/14XW/ebx4I36tKi8HfaRqFAN6hWA51nP.QhJa', 'admin', '2024-12-19 22:55:49'),
(8, 'reysha2024@gmail.com', '$2y$10$DRb4DcLz73CEVN4OmYWon.52fQ/xivrE4fEfBtNkXg9PWSRbRwfL6', 'user', '2024-12-19 22:56:40'),
(10, 'esa', '$2y$10$jghVqVSc/7AjgXaUM4Rlm.XGJnA/Pc/9NnDfkauy4MCE3fK95LE/K', 'user', '2024-12-19 23:17:21'),
(11, 'ilham24', '$2y$10$pvqUeSDuDGp1i9vXHceLP.yAcZ0Xqz82EX8aS.2NMeMIrj/FVKtq6', 'user', '2024-12-20 02:28:26'),
(12, 'boam', '$2y$10$C9G5s.glvc9BqATr9MCMH.YPFQh1eLnHmNnyxh5t5DM39nbqRL0ES', 'admin', '2024-12-27 13:22:15');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bukti_pembayaran`
--
ALTER TABLE `bukti_pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indeks untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id_cart`);

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_menu` (`id_menu`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indeks untuk tabel `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bukti_pembayaran`
--
ALTER TABLE `bukti_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `cart`
--
ALTER TABLE `cart`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `bukti_pembayaran`
--
ALTER TABLE `bukti_pembayaran`
  ADD CONSTRAINT `bukti_pembayaran_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `pembayaran` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`) ON DELETE CASCADE,
  ADD CONSTRAINT `keranjang_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
