-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2020 at 06:31 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecomm2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `username`, `password`, `email`) VALUES
(1, 'LacaraZette', 'evilinside', '$2y$10$RbS2Ck8z69uYcl9NhZq73.OEd1eTPoWzhGnyLpWzo1qu9QsTr8VOK', 'evilinside@guner.com');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `prodID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cartID`, `userID`, `prodID`, `name`, `price`, `qty`, `note`) VALUES
(1, 1, 1, 'AMD Ryzen 9 3900X 3.8Ghz Up To 4.6Ghz Cache 64MB 105W AM4 [Box]', 7779000, 4, 'langsung kirim'),
(2, 1, 2, 'Intel Pentium G4560 3.5Ghz - Cache 3MB [Tray] Socket LGA 1151 - Kabylake Series', 810000, 3, '');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `namaktg` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `namaktg`) VALUES
(4, 'prosesor');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `poto` text NOT NULL DEFAULT 'default.jpg',
  `namaprod` varchar(255) NOT NULL,
  `deskprod` text NOT NULL,
  `hargabrg` int(11) NOT NULL,
  `jumlahbrg` int(11) NOT NULL,
  `kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `poto`, `namaprod`, `deskprod`, `hargabrg`, `jumlahbrg`, `kategori`) VALUES
(1, '10AMD Ryzen 9 3900X 3.8Ghz Up To 4.6Ghz Cache 64MB 105W AM4 [Box].png', 'AMD Ryzen 9 3900X 3.8Ghz Up To 4.6Ghz Cache 64MB 105W AM4 [Box]', 'Ryzen 9 3900X is a 64-bit dodeca-core high-end performance x86 desktop microprocessor introduced by AMD in mid-2019. Fabricated on TSMC&#39;s 7 nm process based on the Zen 2 microarchitecture, this processor operates at 3.8 GHz with a TDP of 105 W and a Boost frequency of up to 4.6 GHz. The 3900X supports up to 128 GiB of dual-channel DDR4-3200 memory.', 7779000, 200, 4),
(2, '15Intel Pentium G4560 3.5Ghz - Cache 3MB [Tray] Socket LGA 1151 - Kabylake Series.jpg', 'Intel Pentium G4560 3.5Ghz - Cache 3MB [Tray] Socket LGA 1151 - Kabylake Series', 'Nama Pentium adalah nama yang sangat lekat dengan brand Intel. Mulai sebagai penamaan prosesor flagship dari Intel, hingga tergusur sebagai prosesor “kelas dua” ketika diperkenalkannya Core dan Core i series, Pentium tetap identik dengan perusahaan prosesor asal Santa Clara ini.', 810000, 100, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telp` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `profil` text NOT NULL DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `email`, `telp`, `address`, `password`, `profil`) VALUES
(1, 'Athharkautsar', 'senatroxx', 'athharkautsar14@gmail.com', '081385155383', 'Cibinong', '$2y$10$..e5esZh8vV77ihosoG3iuxArPRxUa3INtqcg2Tka62au9Iv8eAW6', '43senatroxx.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartID`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategori` (`kategori`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`kategori`) REFERENCES `kategori` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
