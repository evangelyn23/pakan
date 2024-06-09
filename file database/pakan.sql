-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Jan 2023 pada 10.39
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pakan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `ID` int(4) NOT NULL,
  `Role` varchar(30) NOT NULL,
  `Username` varchar(60) NOT NULL,
  `Password` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`ID`, `Role`, `Username`, `Password`) VALUES
(1, 'Admin', 'Admin', 'Admin'),
(2, 'Owner', 'Owner', 'Owner'),
(4, 'Spv', 'Spv', 'Spv'),
(5, 'Owner', 'Ownerbaru', 'Ownerbaru'),
(6, 'Owner', 'Ownerbaru', 'Ownerbaru');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kandang`
--

CREATE TABLE `kandang` (
  `KodeKandang` char(5) NOT NULL,
  `NamaKandang` varchar(30) NOT NULL,
  `Keterangan` varchar(100) NOT NULL,
  `KapasitasKandang` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kandang`
--

INSERT INTO `kandang` (`KodeKandang`, `NamaKandang`, `Keterangan`, `KapasitasKandang`) VALUES
('KD001', 'Kandang 1', 'kandang 1', 2000),
('KD002', 'Kandang 2', 'kandang 2', 2000),
('KD003', 'Kandang 3', 'kandang 3', 2000),
('KD004', 'Kandang 4', 'kandang 4', 5000),
('KD005', 'Kandang 5', 'kandang 5', 5000),
('KD006', 'Kandang 6', 'kandang 6', 1000),
('KD007', 'Kandang 7', 'kandang 7', 3000),
('KD008', 'Kandang 8', 'kandang 8', 3000),
('KD009', 'kandang 9', 'kandang 9', 2000),
('KD010', 'Kandang 10', 'kandang 10', 5000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelianbahan`
--

CREATE TABLE `pembelianbahan` (
  `KodePembelianBahan` char(5) NOT NULL,
  `Tanggal` date NOT NULL,
  `KodePersediaan` char(5) NOT NULL,
  `Jumlah` int(10) NOT NULL,
  `Harga` int(10) NOT NULL,
  `TotalHarga` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembelianbahan`
--

INSERT INTO `pembelianbahan` (`KodePembelianBahan`, `Tanggal`, `KodePersediaan`, `Jumlah`, `Harga`, `TotalHarga`) VALUES
('PB003', '2022-08-05', 'PD002', 30, 90000, 2700000),
('PB004', '2022-09-09', 'PD003', 40, 100000, 4000000),
('PB005', '2022-12-02', 'PD003', 50, 90000, 4500000),
('PB006', '2022-12-23', 'PD006', 40, 90000, 3600000),
('PB007', '2022-12-15', 'PD002', 20, 10000, 200000),
('PB008', '2022-12-23', 'PD002', 50, 10000, 500000),
('PB009', '2022-12-15', 'PD007', 10, 1000000, 10000000),
('PB010', '2022-12-22', 'PD001', 30, 87857, 2635710),
('PB011', '2022-12-23', 'PD006', 30, 10000, 300000),
('PB015', '2022-12-24', 'PD002', 10, 90000, 900000),
('PB016', '2023-01-13', 'PD008', 10, 90000, 900000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengelolaanpakand`
--

CREATE TABLE `pengelolaanpakand` (
  `Nomor` int(10) NOT NULL,
  `KodePengelolaan` char(5) NOT NULL,
  `KodePersediaan` char(5) NOT NULL,
  `TotalPenggunaan` int(10) NOT NULL,
  `SubTotalProtein` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengelolaanpakand`
--

INSERT INTO `pengelolaanpakand` (`Nomor`, `KodePengelolaan`, `KodePersediaan`, `TotalPenggunaan`, `SubTotalProtein`) VALUES
(69, 'PP001', 'PD001', 10, 90),
(70, 'PP001', 'PD002', 30, 1500),
(71, 'PP001', 'PD003', 20, 400),
(72, 'PP002', 'PD001', 20, 180),
(73, 'PP002', 'PD002', 30, 1500),
(74, 'PP003', 'PD001', 12, 108),
(75, 'PP003', 'PD003', 22, 440),
(76, 'PP003', 'PD002', 10, 500),
(77, 'PP004', 'PD005', 20, 600),
(78, 'PP004', 'PD007', 10, 200),
(79, 'PP005', 'PD004', 9, 360),
(80, 'PP006', 'PD002', 5, 250),
(81, 'PP006', 'PD001', 10, 90),
(82, 'PP007', 'PD006', 10, 200),
(83, 'PP008', 'PD002', 10, 500),
(84, 'PP008', 'PD001', 35, 315),
(89, 'PP009', 'PD001', 20, 180),
(90, 'PP009', 'PD003', 40, 800),
(92, 'PP010', 'PD007', 10, 200),
(93, 'PP011', 'PD001', 25, 225),
(96, 'PP012', 'PD008', 50, 1000),
(97, 'PP013', 'PD009', 5, 100),
(98, 'PP013', 'PD010', 3, 36);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengelolaanpakandtemp`
--

CREATE TABLE `pengelolaanpakandtemp` (
  `Nomor` int(10) NOT NULL,
  `KodePengelolaan` char(5) NOT NULL,
  `KodePersediaan` char(5) NOT NULL,
  `TotalPenggunaan` int(10) NOT NULL,
  `SubTotalProtein` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengelolaanpakandtemp`
--

INSERT INTO `pengelolaanpakandtemp` (`Nomor`, `KodePengelolaan`, `KodePersediaan`, `TotalPenggunaan`, `SubTotalProtein`) VALUES
(99, '', 'PD008', 50, 100),
(100, '', 'PD009', 30, 60),
(101, '', 'PD010', 20, 24),
(123, 'PP014', 'PD008', 50, 100),
(124, 'PP014', 'PD009', 30, 60),
(125, 'PP014', 'PD010', 20, 24);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengelolaanpakanh`
--

CREATE TABLE `pengelolaanpakanh` (
  `KodePengelolaan` char(5) NOT NULL,
  `KodePersediaanPakan` char(5) NOT NULL,
  `Tanggal` date NOT NULL,
  `TotalProtein` int(10) NOT NULL,
  `TotalPakan` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengelolaanpakanh`
--

INSERT INTO `pengelolaanpakanh` (`KodePengelolaan`, `KodePersediaanPakan`, `Tanggal`, `TotalProtein`, `TotalPakan`) VALUES
('PP001', 'SP001', '2022-11-30', 1990, 60),
('PP002', 'SP001', '2022-11-30', 1680, 50),
('PP003', 'SP001', '2022-12-02', 1048, 44),
('PP004', 'SP001', '2022-12-23', 800, 30),
('PP005', 'SP002', '2022-12-23', 360, 9),
('PP006', 'SP003', '2022-12-23', 340, 15),
('PP007', 'SP001', '2022-12-23', 200, 10),
('PP008', 'SP001', '2022-12-23', 815, 45),
('PP009', 'SP001', '2022-12-23', 980, 60),
('PP010', 'SP001', '2023-01-12', 200, 10),
('PP011', 'SP003', '2023-01-12', 225, 25),
('PP012', 'SP001', '2023-01-12', 1000, 50),
('PP013', 'SP001', '2023-01-12', 136, 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penggunaanpakan`
--

CREATE TABLE `penggunaanpakan` (
  `KodePenggunaanPakan` char(5) NOT NULL,
  `TotalPenggunaan` int(10) NOT NULL,
  `Tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penggunaanpakan`
--

INSERT INTO `penggunaanpakan` (`KodePenggunaanPakan`, `TotalPenggunaan`, `Tanggal`) VALUES
('PG001', 350, '2022-11-30'),
('PG002', 178, '2022-12-04'),
('PG003', 10, '2022-12-10'),
('PG004', 110, '2022-12-23'),
('PG005', 10, '2022-12-23'),
('PG006', 50, '2022-12-23'),
('PG007', 1, '2022-12-23'),
('PG008', 10, '2022-12-23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penggunaanpakand`
--

CREATE TABLE `penggunaanpakand` (
  `Nomor` int(10) NOT NULL,
  `KodePenggunaanPakan` char(5) NOT NULL,
  `KodeKandang` char(5) NOT NULL,
  `KodePersediaanPakan` char(5) NOT NULL,
  `TotalPenggunaan` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penggunaanpakand`
--

INSERT INTO `penggunaanpakand` (`Nomor`, `KodePenggunaanPakan`, `KodeKandang`, `KodePersediaanPakan`, `TotalPenggunaan`) VALUES
(21, 'PG001', 'KD001', 'SP001', 250),
(22, 'PG001', 'KD001', 'SP002', 100),
(23, 'PG002', 'KD001', 'SP001', 78),
(24, 'PG002', 'KD002', 'SP002', 100),
(25, 'PG003', 'KD001', 'SP001', 10),
(26, 'PG004', 'KD005', 'SP003', 10),
(27, 'PG004', 'KD003', 'SP001', 100),
(28, 'PG005', 'KD005', 'SP002', 10),
(29, 'PG006', 'KD001', 'SP001', 50),
(31, 'PG007', 'KD001', 'SP001', 1),
(32, 'PG008', 'KD001', 'SP001', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penggunaanpakandtemp`
--

CREATE TABLE `penggunaanpakandtemp` (
  `Nomor` int(10) NOT NULL,
  `KodePenggunaanPakan` char(5) NOT NULL,
  `KodeKandang` char(5) NOT NULL,
  `KodePersediaanPakan` char(5) NOT NULL,
  `TotalPenggunaan` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `persediaan`
--

CREATE TABLE `persediaan` (
  `KodePersediaan` char(5) NOT NULL,
  `NamaPersediaan` varchar(50) NOT NULL,
  `StandarProtein` int(4) NOT NULL,
  `Satuan` varchar(10) NOT NULL,
  `Stok` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `persediaan`
--

INSERT INTO `persediaan` (`KodePersediaan`, `NamaPersediaan`, `StandarProtein`, `Satuan`, `Stok`) VALUES
('PD001', 'persediaan 1', 9, 'KG', 3848),
('PD002', 'persediaan 2', 50, 'KG', 10),
('PD003', 'persediaan 3', 20, 'KG', 4462),
('PD004', 'persediaan 4', 40, 'KG', 26),
('PD005', 'persediaan 5', 30, 'KG', 10),
('PD006', 'persediaan 6', 20, 'KG', 920),
('PD007', 'persediaan 7', 20, 'KG', 290),
('PD008', 'Jagung', 20, 'KG', 330),
('PD009', 'Dedak', 20, 'KG', 235),
('PD010', 'tepung batu', 12, 'KG', 167),
('PD011', 'tepung susu', 10, 'KG', 30);

-- --------------------------------------------------------

--
-- Struktur dari tabel `persediaanpakan`
--

CREATE TABLE `persediaanpakan` (
  `KodePersediaanPakan` char(5) NOT NULL,
  `NamaPersediaanPakan` varchar(50) NOT NULL,
  `Satuan` varchar(10) NOT NULL,
  `Stok` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `persediaanpakan`
--

INSERT INTO `persediaanpakan` (`KodePersediaanPakan`, `NamaPersediaanPakan`, `Satuan`, `Stok`) VALUES
('SP001', 'pakan 1', 'KG', 218),
('SP002', 'pakan 2', 'KG', 699),
('SP003', 'pakan 3', 'KG', 60),
('SP004', 'pakan 4', 'KG', 50);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indeks untuk tabel `kandang`
--
ALTER TABLE `kandang`
  ADD PRIMARY KEY (`KodeKandang`);

--
-- Indeks untuk tabel `pembelianbahan`
--
ALTER TABLE `pembelianbahan`
  ADD PRIMARY KEY (`KodePembelianBahan`),
  ADD KEY `KodePersediaan` (`KodePersediaan`);

--
-- Indeks untuk tabel `pengelolaanpakand`
--
ALTER TABLE `pengelolaanpakand`
  ADD PRIMARY KEY (`Nomor`),
  ADD KEY `KodePengelolaan` (`KodePengelolaan`),
  ADD KEY `KodePersediaan` (`KodePersediaan`);

--
-- Indeks untuk tabel `pengelolaanpakandtemp`
--
ALTER TABLE `pengelolaanpakandtemp`
  ADD PRIMARY KEY (`Nomor`);

--
-- Indeks untuk tabel `pengelolaanpakanh`
--
ALTER TABLE `pengelolaanpakanh`
  ADD PRIMARY KEY (`KodePengelolaan`),
  ADD KEY `KodePersediaanPakan` (`KodePersediaanPakan`);

--
-- Indeks untuk tabel `penggunaanpakan`
--
ALTER TABLE `penggunaanpakan`
  ADD PRIMARY KEY (`KodePenggunaanPakan`);

--
-- Indeks untuk tabel `penggunaanpakand`
--
ALTER TABLE `penggunaanpakand`
  ADD PRIMARY KEY (`Nomor`),
  ADD KEY `KodePersediaanPakan` (`KodePersediaanPakan`),
  ADD KEY `KodeKandang` (`KodeKandang`),
  ADD KEY `penggunaanpakand_ibfk_3` (`KodePenggunaanPakan`);

--
-- Indeks untuk tabel `penggunaanpakandtemp`
--
ALTER TABLE `penggunaanpakandtemp`
  ADD PRIMARY KEY (`Nomor`);

--
-- Indeks untuk tabel `persediaan`
--
ALTER TABLE `persediaan`
  ADD PRIMARY KEY (`KodePersediaan`);

--
-- Indeks untuk tabel `persediaanpakan`
--
ALTER TABLE `persediaanpakan`
  ADD PRIMARY KEY (`KodePersediaanPakan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pengelolaanpakandtemp`
--
ALTER TABLE `pengelolaanpakandtemp`
  MODIFY `Nomor` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT untuk tabel `penggunaanpakandtemp`
--
ALTER TABLE `penggunaanpakandtemp`
  MODIFY `Nomor` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pembelianbahan`
--
ALTER TABLE `pembelianbahan`
  ADD CONSTRAINT `pembelianbahan_ibfk_1` FOREIGN KEY (`KodePersediaan`) REFERENCES `persediaan` (`KodePersediaan`);

--
-- Ketidakleluasaan untuk tabel `pengelolaanpakand`
--
ALTER TABLE `pengelolaanpakand`
  ADD CONSTRAINT `pengelolaanpakand_ibfk_1` FOREIGN KEY (`KodePengelolaan`) REFERENCES `pengelolaanpakanh` (`KodePengelolaan`),
  ADD CONSTRAINT `pengelolaanpakand_ibfk_2` FOREIGN KEY (`KodePersediaan`) REFERENCES `persediaan` (`KodePersediaan`);

--
-- Ketidakleluasaan untuk tabel `pengelolaanpakanh`
--
ALTER TABLE `pengelolaanpakanh`
  ADD CONSTRAINT `pengelolaanpakanh_ibfk_1` FOREIGN KEY (`KodePersediaanPakan`) REFERENCES `persediaanpakan` (`KodePersediaanPakan`);

--
-- Ketidakleluasaan untuk tabel `penggunaanpakand`
--
ALTER TABLE `penggunaanpakand`
  ADD CONSTRAINT `penggunaanpakand_ibfk_1` FOREIGN KEY (`KodePersediaanPakan`) REFERENCES `persediaanpakan` (`KodePersediaanPakan`),
  ADD CONSTRAINT `penggunaanpakand_ibfk_2` FOREIGN KEY (`KodeKandang`) REFERENCES `kandang` (`KodeKandang`),
  ADD CONSTRAINT `penggunaanpakand_ibfk_3` FOREIGN KEY (`KodePenggunaanPakan`) REFERENCES `penggunaanpakan` (`KodePenggunaanPakan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
