-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2013 at 06:47 AM
-- Server version: 5.6.11
-- PHP Version: 5.5.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jerseydw`
--
CREATE DATABASE IF NOT EXISTS `jerseydw` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `jerseydw`;

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE IF NOT EXISTS `barang` (
  `idbarang` int(11) NOT NULL AUTO_INCREMENT,
  `namabarang` varchar(200) NOT NULL,
  `kategori` varchar(200) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `totalbeli` int(11) NOT NULL,
  `gambar` varchar(200) NOT NULL,
  PRIMARY KEY (`idbarang`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`idbarang`, `namabarang`, `kategori`, `harga`, `stok`, `totalbeli`, `gambar`) VALUES
(1, 'Arsenal', 'klub', 150000, 100, 0, 'images/jersey/klub/arsenal1.png'),
(2, 'Atletico Madrid', 'klub', 130000, 100, 0, 'images/jersey/klub/atm.jpg'),
(3, 'Barcelona', 'klub', 150000, 100, 0, 'images/jersey/klub/barca2.jpg'),
(4, 'Bayer Munchen', 'klub', 150000, 100, 0, 'images/jersey/klub/bayer1.jpg'),
(5, 'Chelsea', 'klub', 150000, 100, 0, 'images/jersey/klub/chelsea1.png'),
(6, 'Dortmund', 'klub', 150000, 95, 5, 'images/jersey/klub/dortmund.png'),
(7, 'Everton', 'klub', 130000, 100, 0, 'images/jersey/klub/everton1.png'),
(8, 'Fulham', 'Klub', 130000, 100, 0, 'images/jersey/klub/Fulham.png'),
(9, 'Hull', 'Klub', 130000, 100, 0, 'images/jersey/klub/Hull.png'),
(10, 'Intermilan', 'Klub', 150000, 100, 0, 'images/jersey/klub/interMilan.png'),
(11, 'Juventus', 'Klub', 150000, 100, 0, 'images/jersey/klub/juventus.png'),
(12, 'Liverpool', 'Klub', 150000, 100, 0, 'images/jersey/klub/liverpool1.png'),
(13, 'Manchester City', 'Klub', 150000, 100, 0, 'images/jersey/klub/MC1.png'),
(14, 'Manchester United', 'Klub', 150000, 100, 0, 'images/jersey/klub/MU1.png'),
(15, 'AC Milan', 'Klub', 150000, 100, 0, 'images/jersey/klub/milan1.jpg'),
(16, 'New Castle', 'Klub', 130000, 100, 0, 'images/jersey/klub/new castle.png'),
(17, 'Sunderland', 'Klub', 130000, 100, 0, 'images/jersey/klub/sunderland.png'),
(18, 'Totenham', 'Klub', 130000, 100, 0, 'images/jersey/klub/totenham.png'),
(19, 'Argentina ', 'Negara', 150000, 100, 0, 'images/jersey/negara/argentina.jpg'),
(20, 'Brasil', 'Negara', 150000, 100, 0, 'images/jersey/negara/brasil.jpg'),
(21, 'Kroasia', 'Negara', 120000, 100, 0, 'images/jersey/negara/croatia.jpg'),
(22, 'Republik Ceko', 'Negara', 120000, 100, 0, 'images/jersey/negara/Czech.jpg'),
(23, 'Denmark', 'Negara', 120000, 100, 0, 'images/jersey/negara/Denmark.jpg'),
(24, 'Inggris', 'Negara', 150000, 100, 0, 'images/jersey/negara/england.jpg'),
(25, 'Perancis', 'Negara', 150000, 100, 0, 'images/jersey/negara/france.jpg'),
(26, 'Jerman', 'Negara', 150000, 100, 0, 'images/jersey/negara/german.jpg'),
(27, 'Belanda', 'Negara', 150000, 100, 0, 'images/jersey/negara/holland.jpg'),
(28, 'Indonesia', 'Negara', 100000, 100, 0, 'images/jersey/negara/indonesia.jpeg'),
(29, 'Italia', 'Negara', 150000, 100, 0, 'images/jersey/negara/italy.jpg'),
(30, 'Pantai Gading', 'Negara', 120000, 100, 0, 'images/jersey/negara/ivory-coast.jpg'),
(31, 'Jepang', 'Negara', 120000, 100, 0, 'images/jersey/negara/japan.jpg'),
(32, 'Portugal', 'Negara', 120000, 100, 0, 'images/jersey/negara/portugal.jpg'),
(35, 'Spanyol', 'Negara', 150000, 100, 0, 'images/jersey/negara/spain.jpg'),
(36, 'Swedia', 'Negara', 120000, 100, 0, 'images/jersey/negara/sweden.jpg'),
(37, 'Uruguay', 'Negara', 120000, 100, 0, 'images/jersey/negara/uruguay.jpg'),
(38, 'Arema', 'Lokal', 100000, 100, 0, 'images/jersey/lokal/arema.jpg'),
(39, 'Persebaya', 'Lokal', 90000, 100, 0, 'images/jersey/lokal/persebaya.jpg'),
(40, 'Persib', 'Lokal', 100000, 100, 0, 'images/jersey/lokal/persib.jpg'),
(41, 'Persipura', 'Lokal', 100000, 100, 0, 'images/jersey/lokal/persipura.jpg'),
(42, 'Semen Padang', 'Lokal', 90000, 100, 0, 'images/jersey/lokal/semen padang.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE IF NOT EXISTS `keranjang` (
  `idnota` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `jumlahbeli` int(11) NOT NULL DEFAULT '0',
  `subtotal` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idnota`,`idbarang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`idnota`, `idbarang`, `jumlahbeli`, `subtotal`) VALUES
(19, 4, 3, 450000),
(19, 6, 1, 150000);

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE IF NOT EXISTS `komentar` (
  `idkomentar` int(11) NOT NULL AUTO_INCREMENT,
  `idbarang` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `isi` text NOT NULL,
  PRIMARY KEY (`idkomentar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `kontakkami`
--

CREATE TABLE IF NOT EXISTS `kontakkami` (
  `idkontak` int(11) NOT NULL AUTO_INCREMENT,
  `namakontak` varchar(200) NOT NULL,
  `emailkontak` varchar(200) NOT NULL,
  `teleponkontak` int(11) NOT NULL,
  `kotakontak` varchar(200) NOT NULL,
  `pesankontak` varchar(200) NOT NULL,
  `alamatkontak` varchar(200) NOT NULL,
  PRIMARY KEY (`idkontak`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `kontakkami`
--

INSERT INTO `kontakkami` (`idkontak`, `namakontak`, `emailkontak`, `teleponkontak`, `kotakontak`, `pesankontak`, `alamatkontak`) VALUES
(6, 'wibowo', 'wibowo@gmail.com', 2345, 'solo', 'ini kualitasnya bagus ga ya?', 'Solo'),
(7, 'Michael', 'michael@gmail.com', 23456, 'Yogya', 'Bisa nego ga ya?', 'Yogya');

-- --------------------------------------------------------

--
-- Table structure for table `nota`
--

CREATE TABLE IF NOT EXISTS `nota` (
  `idnota` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL,
  `total` int(11) NOT NULL DEFAULT '0',
  `tanggalbeli` date DEFAULT NULL,
  `norek` int(11) DEFAULT NULL,
  `transfer` varchar(100) DEFAULT NULL,
  `tanggalbayar` date DEFAULT NULL,
  `terkirim` tinyint(1) NOT NULL DEFAULT '0',
  `pesan` text,
  `metode` varchar(200) NOT NULL DEFAULT 'TIKI',
  PRIMARY KEY (`idnota`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `nota`
--

INSERT INTO `nota` (`idnota`, `id`, `total`, `tanggalbeli`, `norek`, `transfer`, `tanggalbayar`, `terkirim`, `pesan`, `metode`) VALUES
(19, 25, 600000, '2013-12-02', 123456, 'BCA', '2013-12-02', 0, 'Ga pake lama...', 'JNE');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `kodepos` int(10) NOT NULL,
  `telepon` int(20) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `email` varchar(200) NOT NULL,
  `profpic` varchar(200) NOT NULL DEFAULT 'images/profpic/default.png',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nama`, `alamat`, `kodepos`, `telepon`, `admin`, `email`, `profpic`) VALUES
(21, 'DavidVilla', 'davidvilla', 'David Villa Sanchez', 'Yogyakarta', 12345, 123456789, 0, 'david.villa@gmail.com', 'images/profpic/Capture.JPG'),
(22, 'UKDW', 'ukdw', 'UKDW', 'Yogyakarta', 12345, 12345, 1, 'students@ukdw.ac,id', 'images/profpic/Logo UKDW berwarna-720x720.jpg'),
(25, 'Herlius', 'caraka', 'Herlius Caraka', 'Yogyakarta', 12345, 12345, 0, 'raka@gmail.com', 'images/profpic/default.png'),
(26, 'Martin', 'martin', 'Martin Lidau', 'Yogyakarta', 12345, 12345, 0, 'martin@gmail.com', 'images/profpic/default.png');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
