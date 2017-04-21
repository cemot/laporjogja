-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 21 Apr 2017 pada 10.01
-- Versi Server: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `importdata_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `temp_main`
--

CREATE TABLE IF NOT EXISTS `temp_main` (
`id` int(11) NOT NULL,
  `no_reg` varchar(50) NOT NULL,
  `asal_upt` varchar(50) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `nama_alias` varchar(50) DEFAULT NULL,
  `pasal_kejahatan` text,
  `tgl_masuk` date NOT NULL,
  `hukuman` varchar(200) DEFAULT NULL,
  `tgl_ekspirasi` date NOT NULL,
  `status` varchar(20) NOT NULL,
  `verifikasi` varchar(20) NOT NULL,
  `id_user` varchar(100) NOT NULL,
  `jenis_perubahan` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `temp_main`
--
ALTER TABLE `temp_main`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `temp_main`
--
ALTER TABLE `temp_main`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
