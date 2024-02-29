-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 29 Feb 2024 pada 15.30
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
(1, 'fillah21', '$2y$10$gIyTir4/73VDmboLG02F/ea0n4EcdCvTzszXc/D5vbjXdCEpQIkfu', 'Fillah Zaki Alhaqi', 'fillah.alhaqi11@gmail.com', '085826389656', 'Kuningan', '', 'Admin', '65e08f1501675.png'),
(2, 'user', '$2y$10$zksGefeCoHWYyDZTv7S.SOuo77OAw.ZX/SHZxnQVLelp8B9v3I8I6', 'User', 'user@gmail.com', '12121', 'Cirebon', '', 'User', 'default.png'),
(3, 'pemasok', '$2y$10$dE9Z2rhFrPE6VWqRy7iQZ.E.oPqeb328LJ.b9q2/iWxFO30CK.MHq', 'Pemasok', 'pemasok@gmail.com', '902701233', 'Indramayu', 'PT Alhamdulillah Sejahtera', 'Pemasok', 'default.png'),
(4, 'manajer', '$2y$10$meCUatRgtFB//ks5qO6a1ewnXiIuYW14GNnD4huzB.j1RaukLtuDK', 'Manajer', 'manager@gmail.com', '04839024', 'Kuningan', '', 'Manajer', 'default.png'),
(5, 'admin', '$2y$10$EUaQw.1zLaMLAf3Td3BFMu3FHZrHiXhuT4gGTX7nrw6LWd//GxlGq', 'Admininstrator', 'admin@example.com', '082392038', 'Kuningan', '', 'Admin', 'default.png');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
