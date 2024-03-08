-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Mar 2024 pada 17.33
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
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bahan_pemasok`
--

CREATE TABLE `bahan_pemasok` (
  `idbahan` int(11) NOT NULL,
  `idpemasok` int(11) NOT NULL,
  `nama_bahan` varchar(100) NOT NULL,
  `stok` int(11) NOT NULL,
  `satuan` varchar(45) NOT NULL,
  `harga` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bahan_pemasok`
--

INSERT INTO `bahan_pemasok` (`idbahan`, `idpemasok`, `nama_bahan`, `stok`, `satuan`, `harga`) VALUES
(1, 3, 'Bakso Tanpa Tepung', 22, 'Pack', 8000),
(2, 3, 'Gula Pasir', 398, 'Kg', 5000),
(3, 3, 'Biji Selasih', 421, 'Pack', 1500);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`idbarang`, `nama_barang`, `kategori`, `merk`, `gudang`, `rak`, `stok`, `satuan`, `harga`, `foto`, `keterangan`) VALUES
(1, 'Kue Cubit', 'Makanan', 'SIIB', '2', '1', 7, 'Pack', 10000, '65eb2c5660ac4.jpg', ''),
(4, 'Semvronk', 'Makanan', 'SIIB', '01', '1', 48, 'Pack', 10000, '65eb2c94ecaa0.jpg', 'Semvronk mantap cihuy'),
(5, 'Khue Pashong', 'Makanan', 'SIIB', '1029', '2', 59, 'Buah', 6000, 'default.png', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `idkeluar` int(11) NOT NULL,
  `tgl_keluar` timestamp NULL DEFAULT current_timestamp(),
  `keterangan` text DEFAULT NULL,
  `qty` int(20) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `idtransaksi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang_keluar`
--

INSERT INTO `barang_keluar` (`idkeluar`, `tgl_keluar`, `keterangan`, `qty`, `idbarang`, `idtransaksi`) VALUES
(1, NULL, NULL, 3, 1, 1),
(2, NULL, NULL, 2, 4, 1),
(3, NULL, NULL, 1, 5, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `idmasuk` int(11) NOT NULL,
  `no_bukti` varchar(50) DEFAULT NULL,
  `tgl_masuk` timestamp NULL DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `qty` int(20) NOT NULL,
  `idtransaksi` int(11) NOT NULL,
  `idbahan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang_masuk`
--

INSERT INTO `barang_masuk` (`idmasuk`, `no_bukti`, `tgl_masuk`, `keterangan`, `qty`, `idtransaksi`, `idbahan`) VALUES
(1, 'SIIB-1709561457', '2024-03-06 18:10:22', NULL, 2, 1, 1),
(2, 'SIIB-1709561457', '2024-03-06 18:10:22', NULL, 2, 1, 2),
(3, 'SIIB-1709561457', '2024-03-06 18:10:22', NULL, 1, 1, 3),
(4, NULL, NULL, NULL, 2, 2, 1),
(5, NULL, NULL, NULL, 6, 3, 1),
(6, NULL, NULL, NULL, 1, 4, 1),
(12, NULL, NULL, NULL, 2, 5, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_pembelian`
--

CREATE TABLE `transaksi_pembelian` (
  `idtransaksi` int(11) NOT NULL,
  `tgl_transaksi` timestamp NOT NULL DEFAULT current_timestamp(),
  `kode_transaksi` varchar(50) NOT NULL,
  `status` varchar(45) NOT NULL,
  `idpemasok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi_pembelian`
--

INSERT INTO `transaksi_pembelian` (`idtransaksi`, `tgl_transaksi`, `kode_transaksi`, `status`, `idpemasok`) VALUES
(1, '2024-03-04 14:11:12', 'SIIB-1709561457', 'Selesai', 3),
(2, '2024-03-04 14:28:06', 'SIIB-1709562475', 'Diproses', 3),
(3, '2024-03-06 17:18:55', 'SIIB-1709745464', 'Belum Diproses', 3),
(4, '2024-03-06 18:17:16', 'SIIB-1709749023', 'Belum Diproses', 3),
(5, '2024-03-06 18:45:33', 'SIIB-1709750730', 'Diproses', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_penjualan`
--

CREATE TABLE `transaksi_penjualan` (
  `idtransaksi` int(11) NOT NULL,
  `tgl_transaksi` timestamp NOT NULL DEFAULT current_timestamp(),
  `kode_transaksi` varchar(50) NOT NULL,
  `status` varchar(45) NOT NULL,
  `idpelanggan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi_penjualan`
--

INSERT INTO `transaksi_penjualan` (`idtransaksi`, `tgl_transaksi`, `kode_transaksi`, `status`, `idpelanggan`) VALUES
(1, '2024-03-08 16:31:21', 'SIIB-1709915474', 'Belum Diproses', 2);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`iduser`, `username`, `password`, `nama`, `email`, `telepon`, `alamat`, `instansi`, `level`, `foto`) VALUES
(1, 'fillah21', '$2y$10$gIyTir4/73VDmboLG02F/ea0n4EcdCvTzszXc/D5vbjXdCEpQIkfu', 'Fillah Zaki Alhaqi', 'fillah.alhaqi11@gmail.com', '085826389656', 'Kuningan', '', 'Admin', 'default.png'),
(2, 'user', '$2y$10$zksGefeCoHWYyDZTv7S.SOuo77OAw.ZX/SHZxnQVLelp8B9v3I8I6', 'User', 'user@gmail.com', '12121', 'Cirebon', '', 'User', 'default.png'),
(3, 'pemasok', '$2y$10$VP02PZamEDPOxPRdckWo6eETT3/ceSc.WasY.3FXRCaBo2NJQ.hlq', 'Pemasok', 'pemasok@gmail.com', '9027012334', 'Indramayu', 'PT Alhamdulillah Sejahtera', 'Pemasok', 'default.png'),
(4, 'manajer', '$2y$10$meCUatRgtFB//ks5qO6a1ewnXiIuYW14GNnD4huzB.j1RaukLtuDK', 'Manajer', 'manager@gmail.com', '04839024', 'Kuningan', '', 'Manajer', 'default.png'),
(5, 'admin', '$2y$10$EUaQw.1zLaMLAf3Td3BFMu3FHZrHiXhuT4gGTX7nrw6LWd//GxlGq', 'Admininstrator', 'admin@example.com', '0823920389', 'Kuningan', '', 'Admin', 'default.png'),
(6, 'eka', '$2y$10$vVOh1EtK6HolgopiTaeptuuDrErCrZ0Y9zNK.FbrgOil5MnSPL7OW', 'Eka Nurseva Saniyah', 'ekanursevas@gmail.com', '38423842343', 'Plumbon', '', 'Admin', '65e297c555edf.png'),
(7, 'halo', '$2y$10$JIv1ZGHOVVquCw/Hp4yJ7epmG1V2r9Ovae8u0MOFq2JXHlfSfRiQa', 'Hallo', 'hallo@gmail.com', '4279483943', 'Hallo', '', 'User', 'default.png');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bahan_pemasok`
--
ALTER TABLE `bahan_pemasok`
  ADD PRIMARY KEY (`idbahan`),
  ADD KEY `idpemasok` (`idpemasok`);

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`idbarang`);

--
-- Indeks untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`idkeluar`),
  ADD KEY `idbarang` (`idbarang`),
  ADD KEY `idtransaksi` (`idtransaksi`);

--
-- Indeks untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`idmasuk`),
  ADD KEY `idbahan` (`idbahan`),
  ADD KEY `idtransaksi` (`idtransaksi`);

--
-- Indeks untuk tabel `transaksi_pembelian`
--
ALTER TABLE `transaksi_pembelian`
  ADD PRIMARY KEY (`idtransaksi`),
  ADD KEY `idpemasok` (`idpemasok`);

--
-- Indeks untuk tabel `transaksi_penjualan`
--
ALTER TABLE `transaksi_penjualan`
  ADD PRIMARY KEY (`idtransaksi`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bahan_pemasok`
--
ALTER TABLE `bahan_pemasok`
  MODIFY `idbahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `idbarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `idkeluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `idmasuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `transaksi_pembelian`
--
ALTER TABLE `transaksi_pembelian`
  MODIFY `idtransaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `transaksi_penjualan`
--
ALTER TABLE `transaksi_penjualan`
  MODIFY `idtransaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `bahan_pemasok`
--
ALTER TABLE `bahan_pemasok`
  ADD CONSTRAINT `bahan_pemasok_ibfk_1` FOREIGN KEY (`idpemasok`) REFERENCES `user` (`iduser`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD CONSTRAINT `barang_keluar_ibfk_1` FOREIGN KEY (`idbarang`) REFERENCES `barang` (`idbarang`) ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_keluar_ibfk_2` FOREIGN KEY (`idtransaksi`) REFERENCES `transaksi_penjualan` (`idtransaksi`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD CONSTRAINT `barang_masuk_ibfk_1` FOREIGN KEY (`idbahan`) REFERENCES `bahan_pemasok` (`idbahan`) ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_masuk_ibfk_2` FOREIGN KEY (`idtransaksi`) REFERENCES `transaksi_pembelian` (`idtransaksi`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi_pembelian`
--
ALTER TABLE `transaksi_pembelian`
  ADD CONSTRAINT `transaksi_pembelian_ibfk_1` FOREIGN KEY (`idpemasok`) REFERENCES `user` (`iduser`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
