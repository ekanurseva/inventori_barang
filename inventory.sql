-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 02 Mar 2024 pada 15.57
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `idbarang` int(11) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `merk` varchar(45) NOT NULL,
  `gudang` varchar(45) NOT NULL,
  `rak` varchar(45) NOT NULL,
  `stok` int(11) NOT NULL,
  `satuan` varchar(45) NOT NULL,
  `harga` int(20) NOT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`idbarang`, `nama_barang`, `kategori`, `merk`, `gudang`, `rak`, `stok`, `satuan`, `harga`, `foto`, `keterangan`) VALUES
(1, 'Kue Cubit', 'Makanan', 'SIIB', '2', '1', 10, 'Pack', 10000, 'default.png', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `iduser` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telepon` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `instansi` varchar(50) DEFAULT NULL,
  `level` varchar(10) NOT NULL,
  `foto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`iduser`, `username`, `password`, `nama`, `email`, `telepon`, `alamat`, `instansi`, `level`, `foto`) VALUES
(1, 'fillah21', '$2y$10$gIyTir4/73VDmboLG02F/ea0n4EcdCvTzszXc/D5vbjXdCEpQIkfu', 'Fillah Zaki Alhaqi', 'fillah.alhaqi11@gmail.com', '085826389656', 'Kuningan', '', 'Admin', 'default.png'),
(2, 'user', '$2y$10$zksGefeCoHWYyDZTv7S.SOuo77OAw.ZX/SHZxnQVLelp8B9v3I8I6', 'User', 'user@gmail.com', '12121', 'Cirebon', '', 'User', 'default.png'),
(3, 'pemasok', '$2y$10$dE9Z2rhFrPE6VWqRy7iQZ.E.oPqeb328LJ.b9q2/iWxFO30CK.MHq', 'Pemasok', 'pemasok@gmail.com', '902701233', 'Indramayu', 'PT Alhamdulillah Sejahtera', 'Pemasok', 'default.png'),
(4, 'manajer', '$2y$10$meCUatRgtFB//ks5qO6a1ewnXiIuYW14GNnD4huzB.j1RaukLtuDK', 'Manajer', 'manager@gmail.com', '04839024', 'Kuningan', '', 'Manajer', 'default.png'),
(5, 'admin', '$2y$10$EUaQw.1zLaMLAf3Td3BFMu3FHZrHiXhuT4gGTX7nrw6LWd//GxlGq', 'Admininstrator', 'admin@example.com', '082392038', 'Kuningan', '', 'Admin', 'default.png'),
(6, 'eka', '$2y$10$vVOh1EtK6HolgopiTaeptuuDrErCrZ0Y9zNK.FbrgOil5MnSPL7OW', 'Eka Nurseva Saniyah', 'ekanursevas@gmail.com', '38423842343', 'Plumbon', '', 'Admin', '65e297c555edf.png'),
(7, 'halo', '$2y$10$JIv1ZGHOVVquCw/Hp4yJ7epmG1V2r9Ovae8u0MOFq2JXHlfSfRiQa', 'Hallo', 'hallo@gmail.com', '4279483943', 'Hallo', '', 'User', 'default.png');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`idbarang`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `idbarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
