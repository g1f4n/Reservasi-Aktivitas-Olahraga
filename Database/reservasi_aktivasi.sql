-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Waktu pembuatan: 18. Oktober 2017 jam 16:35
-- Versi Server: 5.5.16
-- Versi PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `reservasi_aktivasi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `kodeuser` char(3) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(40) NOT NULL,
  `level` enum('administrator','kasir') NOT NULL,
  PRIMARY KEY (`kodeuser`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`kodeuser`, `nama`, `username`, `password`, `level`) VALUES
('A01', 'Muhammad Husain Giffary Alsaera', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'administrator'),
('K01', 'Rahmad Bani', 'kasir', 'c7911af3adbd12a035b289556d96470a', 'kasir'),
('K02', 'Arif Trian Nugroho', 'kasir2', 'c7911af3adbd12a035b289556d96470a', 'kasir');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
  `kodegallery` char(4) NOT NULL,
  `slide` text NOT NULL,
  PRIMARY KEY (`kodegallery`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `gallery`
--

INSERT INTO `gallery` (`kodegallery`, `slide`) VALUES
('G001', 'scott-webb-22437.jpg'),
('G002', 'yoga.jpg'),
('G003', 'matrialart.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `instruktur`
--

CREATE TABLE IF NOT EXISTS `instruktur` (
  `kodeinstruktur` varchar(3) NOT NULL,
  `namalengkap` varchar(40) NOT NULL,
  `jeniskelamin` enum('Laki-Laki','Perempuan') NOT NULL,
  `telp` bigint(12) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `gambar1` text NOT NULL,
  PRIMARY KEY (`kodeinstruktur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `instruktur`
--

INSERT INTO `instruktur` (`kodeinstruktur`, `namalengkap`, `jeniskelamin`, `telp`, `alamat`, `email`, `gambar1`) VALUES
('AGS', 'Agus Surahman', 'Laki-Laki', 8996665237, 'Jakarta', 'agus_surahman@gmail.com', 'alexander-redl-185764.jpg'),
('ARZ', 'Arirama Zakaria', 'Laki-Laki', 8996665237, 'Jakarta', 'arirama@gmail.com', 'adech.jpg'),
('FIT', 'Fitriani', 'Perempuan', 8996665237, 'Jakarta', 'fitriani@gmail.com', 'gym 2.jpg'),
('RYN', 'Rena Yunita', 'Perempuan', 8996665237, 'Jakarta', 'rena@gmail.com', 'FB_IMG_1469698101788.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenisolahraga`
--

CREATE TABLE IF NOT EXISTS `jenisolahraga` (
  `kodeolahraga` char(4) NOT NULL,
  `namaolahraga` varchar(20) NOT NULL,
  `harga` double NOT NULL,
  `waktu` time NOT NULL,
  `waktu2` time NOT NULL,
  `gambar` text NOT NULL,
  `kodeinstruktur` varchar(3) NOT NULL,
  `fasilitas` text NOT NULL,
  PRIMARY KEY (`kodeolahraga`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jenisolahraga`
--

INSERT INTO `jenisolahraga` (`kodeolahraga`, `namaolahraga`, `harga`, `waktu`, `waktu2`, `gambar`, `kodeinstruktur`, `fasilitas`) VALUES
('AFIT', 'Aerobik', 70000, '09:00:00', '10:00:00', 'aerobik1.jpg', 'FIT', 'senam, instruktur'),
('BARZ', 'Boxing', 80000, '15:00:00', '16:00:00', 'boxing1 (Copy).jpg', 'ARZ', 'peralatan boxing, instruktur'),
('GAGS', 'Gym', 60000, '16:00:00', '17:00:00', 'gym 2.jpg', 'AGS', 'Instruktur, Bebas Pilih ALat'),
('YRNY', 'Yoga', 80000, '08:00:00', '09:00:00', 'yoga (Copy).jpg', 'RYN', 'Instruktur, Tempat, Peralatan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `konfirmasi`
--

CREATE TABLE IF NOT EXISTS `konfirmasi` (
  `kodekonfirmasi` varchar(16) NOT NULL,
  `kodebooking` varchar(16) NOT NULL,
  `kodemember` char(4) NOT NULL,
  `banksumber` varchar(20) NOT NULL,
  `norek` varchar(16) NOT NULL,
  `banktujuan` varchar(7) NOT NULL,
  `buktibayar` text NOT NULL,
  PRIMARY KEY (`kodekonfirmasi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `konfirmasi`
--

INSERT INTO `konfirmasi` (`kodekonfirmasi`, `kodebooking`, `kodemember`, `banksumber`, `norek`, `banktujuan`, `buktibayar`) VALUES
('20170807AFIT0002', '201708030011', '0001', 'BCA', '1670100060577254', 'Mandiri', 'P_20170201_091608.jpg'),
('20170807BARZ0001', '201708070002', '0001', 'Mandiri', '1234567890123456', 'Mandiri', 'P_20170201_091601.jpg'),
('20171013AFIT0002', '201710130002', '0001', 'erwer', '332332', 'Mandiri', 'Untitled-12.png'),
('20171013BARZ0001', '201710130001', '0001', 'mandiri', '233334344', 'Mandiri', 'Untitled-12.png'),
('20171015AFIT0001', '201710150001', '0001', 'Mandiri', '918278273', 'Mandiri', 'Untitled-12.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `kodemember` char(4) NOT NULL,
  `namalengkap` varchar(40) NOT NULL,
  `jeniskelamin` enum('Laki-Laki','Perempuan') NOT NULL,
  `telp` bigint(12) NOT NULL,
  `alamat` text NOT NULL,
  `gambar` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  PRIMARY KEY (`kodemember`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `member`
--

INSERT INTO `member` (`kodemember`, `namalengkap`, `jeniskelamin`, `telp`, `alamat`, `gambar`, `email`, `password`) VALUES
('0001', 'Muhammad Husain Giffary Alsaera', 'Laki-Laki', 81317758308, 'Bekasi', 'P_20161108_102432.jpg', 'muhammadhusain1996@gmail.com', 'f842e72fc2ba8910eae1c637646a62eb'),
('0002', 'Adech Bagoes Dwi Alsaera', 'Laki-Laki', 8996665237, 'Bekasi', 'adech.jpg', 'adech@gmail.com', 'f842e72fc2ba8910eae1c637646a62eb'),
('0003', 'Ririn Fitria', 'Perempuan', 8996665237, 'Jakarta', 'FB_IMG_1469698101788.jpg', 'ririnfitria@gmail.com', 'f842e72fc2ba8910eae1c637646a62eb');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE IF NOT EXISTS `transaksi` (
  `kodebooking` varchar(16) NOT NULL,
  `kodemember` char(4) NOT NULL,
  `kodeolahraga` char(4) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `status` enum('Proses','Booking','Aktif') NOT NULL,
  `totalharga` double NOT NULL,
  PRIMARY KEY (`kodebooking`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`kodebooking`, `kodemember`, `kodeolahraga`, `tanggal`, `jumlah`, `status`, `totalharga`) VALUES
('201708020001', '0001', 'YRNY', '2017-08-10', 1, 'Proses', 80000),
('201708020002', '0001', 'AFIT', '2017-08-12', 1, 'Proses', 70000),
('201708020003', '0001', 'BARZ', '2017-08-09', 1, 'Proses', 80000),
('201708020004', '0001', 'GAGS', '2017-08-17', 1, 'Proses', 60000),
('201708030001', '0001', 'BARZ', '2017-08-03', 1, 'Proses', 80000),
('201708030002', '0001', 'BARZ', '2017-08-10', 1, 'Proses', 80000),
('201708030003', '0002', 'AFIT', '2017-08-09', 1, 'Proses', 70000),
('201708030004', '0002', 'BARZ', '2017-08-08', 1, 'Proses', 80000),
('201708030005', '0002', 'GAGS', '2017-08-10', 1, 'Proses', 60000),
('201708030006', '0002', 'YRNY', '2017-08-04', 1, 'Proses', 80000),
('201708030007', '0003', 'AFIT', '2017-08-09', 1, 'Proses', 70000),
('201708030008', '0003', 'BARZ', '2017-08-03', 1, 'Proses', 80000),
('201708030009', '0003', 'GAGS', '2017-08-05', 1, 'Proses', 60000),
('201708030010', '0003', 'YRNY', '2017-08-05', 1, 'Proses', 80000),
('201708030011', '0001', 'AFIT', '2017-08-10', 1, 'Booking', 70000),
('201708070001', '0001', 'BARZ', '2017-08-12', 1, 'Proses', 80000),
('201708070002', '0001', 'BARZ', '2017-08-14', 1, 'Aktif', 80000),
('201710130001', '0001', 'BARZ', '2017-10-17', 1, 'Booking', 80000),
('201710130002', '0001', 'AFIT', '2017-10-27', 1, 'Booking', 70000),
('201710150001', '0001', 'AFIT', '2017-10-17', 1, 'Booking', 70000),
('201710150002', '0001', 'AFIT', '2017-10-18', 1, 'Proses', 70000);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
