-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 13 Des 2020 pada 07.23
-- Versi Server: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kominfo`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bimbingan`
--

CREATE TABLE `bimbingan` (
  `id_bimbingan` int(10) NOT NULL,
  `id_magang` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `materi` text NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `magang`
--

CREATE TABLE `magang` (
  `id_magang` varchar(20) NOT NULL,
  `username` varchar(10) NOT NULL,
  `institusi` varchar(100) NOT NULL,
  `jurusan` varchar(30) NOT NULL,
  `tujuan` text NOT NULL,
  `proposal` varchar(10) NOT NULL,
  `surat_rekom` varchar(10) NOT NULL,
  `status` int(2) NOT NULL,
  `bidang` varchar(10) DEFAULT NULL,
  `tgl_daftar` date NOT NULL,
  `tgl_acc` date DEFAULT NULL,
  `tgl_mulai` date DEFAULT NULL,
  `tgl_selesai` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `magang`
--

INSERT INTO `magang` (`id_magang`, `username`, `institusi`, `jurusan`, `tujuan`, `proposal`, `surat_rekom`, `status`, `bidang`, `tgl_daftar`, `tgl_acc`, `tgl_mulai`, `tgl_selesai`) VALUES
('MK202012130001', 'oktaniap', 'Universitas Pembangunan Nasional \"Veteran\" Jawa Timur', 'Sistem Informasi', 'Untuk melakukan praktek pembelajaran yang selama ini diberikan selama perkuliahan di studi kasus nyata, dengan membuat website untuk pendaftaran PKL', 'D0001', 'D0002', 2, 'ai', '2020-12-13', NULL, '2021-01-10', '2021-03-10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemagang`
--

CREATE TABLE `pemagang` (
  `id_pemagang` varchar(10) NOT NULL,
  `id_magang` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kartu` varchar(10000) NOT NULL,
  `file` varchar(10000) NOT NULL,
  `nilai` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pemagang`
--

INSERT INTO `pemagang` (`id_pemagang`, `id_magang`, `nama`, `kartu`, `file`, `nilai`) VALUES
('P0001', 'MK202012130001', 'Oktania Purwaningrum', 'Kartu-MK202012130001-Oktania Purwaningrum', '../dokumen/kartu/Kartu-MK202012130001-Oktania Purwaningrum.pdf', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `username` varchar(10) NOT NULL,
  `nama_depan` varchar(100) NOT NULL,
  `nama_belakang` varchar(100) NOT NULL,
  `password` varchar(10) NOT NULL,
  `akses` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`username`, `nama_depan`, `nama_belakang`, `password`, `akses`) VALUES
('anggyo', 'Anggi', 'Oktaviana', 'anggyo', 'user'),
('hanum', 'Apriliana', 'Hanum', 'hanum', 'user'),
('oktaniap', 'Oktania', 'Purwaningrum', 'oktaniap', 'user'),
('pds', 'Bidang', 'Pengelolaan Data Statis', 'pds', 'pds'),
('sekre', 'Bidang', 'Sekretariat', 'sekre', 'sekre');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bimbingan`
--
ALTER TABLE `bimbingan`
  ADD PRIMARY KEY (`id_bimbingan`);

--
-- Indexes for table `magang`
--
ALTER TABLE `magang`
  ADD PRIMARY KEY (`id_magang`);

--
-- Indexes for table `pemagang`
--
ALTER TABLE `pemagang`
  ADD PRIMARY KEY (`id_pemagang`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bimbingan`
--
ALTER TABLE `bimbingan`
  MODIFY `id_bimbingan` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
