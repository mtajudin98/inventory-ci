-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2019 at 01:57 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_produk`
--

CREATE TABLE `t_produk` (
  `id` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `jenis_produk` enum('makanan','minuman','','') NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `stock` int(3) NOT NULL,
  `user_id` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_produk`
--

INSERT INTO `t_produk` (`id`, `nama_produk`, `jenis_produk`, `harga_produk`, `stock`, `user_id`) VALUES
(1, 'Jus Jeruk', 'minuman', 10000, 5, 1),
(2, 'Snack Opesw', 'makanan', 1000, 1, 1),
(3, 'Mie Kremes', 'makanan', 1500, 2, 1),
(4, 'Jus Anggur', 'minuman', 2000, 5, 1),
(5, 'asdasd', 'makanan', 3434, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_purchase`
--

CREATE TABLE `t_purchase` (
  `id` int(11) NOT NULL,
  `supplier_id` int(2) NOT NULL,
  `produk_id` int(3) NOT NULL,
  `qty` int(11) NOT NULL,
  `tanggal_purchase` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_purchase`
--

INSERT INTO `t_purchase` (`id`, `supplier_id`, `produk_id`, `qty`, `tanggal_purchase`) VALUES
(1, 1, 2, 50, '2019-12-20 00:26:32'),
(2, 2, 1, 20, '2019-12-20 00:26:32');

-- --------------------------------------------------------

--
-- Table structure for table `t_supplier`
--

CREATE TABLE `t_supplier` (
  `id` int(11) NOT NULL,
  `nama_supplier` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `user_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_supplier`
--

INSERT INTO `t_supplier` (`id`, `nama_supplier`, `alamat`, `user_id`) VALUES
(1, 'PT Makmur3', 'Jl. ada saja', 1),
(2, 'PT Garuda', 'Taman Melata', 1),
(3, 'PT Eis', 'susei ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_user`
--

CREATE TABLE `t_user` (
  `id` int(11) NOT NULL,
  `username` varchar(150) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `access` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `t_user`
--

INSERT INTO `t_user` (`id`, `username`, `password`, `access`) VALUES
(1, 'admin', 'admin', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_produk`
--
ALTER TABLE `t_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_purchase`
--
ALTER TABLE `t_purchase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_supplier`
--
ALTER TABLE `t_supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_produk`
--
ALTER TABLE `t_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `t_purchase`
--
ALTER TABLE `t_purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_supplier`
--
ALTER TABLE `t_supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
