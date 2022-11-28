-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2022 at 09:21 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi`
--

-- --------------------------------------------------------

--
-- Table structure for table `absen`
--

CREATE TABLE `absen` (
  `id_absen` int(11) NOT NULL,
  `id_murid` int(11) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `absen`
--

INSERT INTO `absen` (`id_absen`, `id_murid`, `keterangan`, `tanggal`) VALUES
(63, 20, 'Sakit', '2022-10-27'),
(64, 1, 'Sakit', '2022-11-27'),
(66, 1, 'Izin', '2022-11-26'),
(69, 19, 'Izin', '2022-11-27'),
(71, 18, 'Alpa', '2022-11-27'),
(74, 17, 'Alpa', '2022-11-27'),
(75, 7, 'Izin', '2022-11-27'),
(76, 6, 'Sakit', '2022-11-27'),
(77, 10, 'Alpa', '2022-11-27'),
(78, 9, 'Sakit', '2022-11-27'),
(79, 22, 'Alpa', '2022-11-27'),
(80, 5, 'Sakit', '2022-11-28'),
(81, 1, 'Sakit', '2022-11-28'),
(82, 4, 'Izin', '2022-11-28'),
(83, 16, 'Alpa', '2022-11-28'),
(84, 17, 'Alpa', '2022-11-28'),
(85, 7, 'Izin', '2022-11-28'),
(86, 6, 'Sakit', '2022-11-28'),
(87, 20, 'Izin', '2022-11-28');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id_guru` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id_guru`, `id_kelas`, `id_jurusan`, `nama`, `email`, `password`) VALUES
(1, 3, 1, 'Bryant Sulthan S.Crud', 'guru1@gmail.com', '202cb962ac59075b964b07152d234b70'),
(2, 3, 2, 'Aufa Ramadhan S.Crud', 'guru2@gmail.com', '202cb962ac59075b964b07152d234b70'),
(3, 3, 3, 'Adi Saputra S.Crud', 'guru3@gmail.com', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `jurusan` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `jurusan`) VALUES
(1, 'Rekayasa Perangkat Lunak'),
(2, 'Multimedia'),
(3, 'Teknik Komputer dan Jaringan');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `kelas` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `kelas`) VALUES
(1, 'X'),
(2, 'XI'),
(3, 'XII');

-- --------------------------------------------------------

--
-- Table structure for table `murid`
--

CREATE TABLE `murid` (
  `id_murid` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `no_tlp` varchar(50) NOT NULL,
  `jk` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `murid`
--

INSERT INTO `murid` (`id_murid`, `id_kelas`, `id_jurusan`, `nama`, `email`, `alamat`, `no_tlp`, `jk`) VALUES
(1, 3, 1, 'Bryant', 'bryant@gmail.com', 'situ sari', '08872634176', 'L'),
(2, 3, 1, 'Higa', 'higa@gmail.com', 'Venez', '09819636781', 'L'),
(3, 3, 1, 'Farid', 'farid@gmail.com', 'Grand kahuripan', '098438712', 'L'),
(4, 3, 1, 'Fardan', 'fardan@gmail.com', 'Mekarsari', '089129762121', 'L'),
(5, 3, 1, 'Doni', 'doni@gmail.com', 'Gandoang', '087823467189', 'L'),
(6, 3, 2, 'Albert', 'albert@gmail.com', 'GBJ', '0812735711', 'L'),
(7, 3, 2, 'Adi Saputra', 'adi@gmail.com', 'GBJ', '081927371621', 'L'),
(8, 3, 2, 'Aufa', 'aufa@gmail.com', 'GBJ', '08761526515', 'L'),
(9, 3, 2, 'Aninda', 'anin@gmail.com', 'Cileungsi', '08912937912', 'P'),
(10, 3, 2, 'Andini', 'andini@gmail.com', 'Permata Cibubur', '0896132781', 'P'),
(11, 3, 3, 'Alvin', 'alvin@gmail.com', 'Cileungsi', '087198273198', 'L'),
(12, 3, 3, 'Meida', 'mei@gmail.com', 'Harvest', '08236127853', 'P'),
(13, 3, 3, 'Amel', 'ameng@gmail.com', 'Permata Cibubur', '08172693712', 'P'),
(14, 3, 3, 'Rahmawati', 'rahma@gmail.com', 'Cileungsi', '081298312978', 'P'),
(15, 3, 3, 'Rehan', 'rehan@gmail.com', 'Cileungsi Indah', '082361267172', 'L'),
(16, 3, 1, 'Fina', 'fina@gmail.com', 'Permata Cibubur', '08217398012', 'P'),
(17, 3, 1, 'Sila', 'sila@gmail.com', 'Deket BM3', '08237685176', 'P'),
(18, 3, 1, 'Leny', 'len@gmail.com', 'Klapanunggal', '082981387912', 'P'),
(19, 3, 1, 'Jani', 'jani@gmail.com', 'Klapanunggal', '08198237918', 'P'),
(20, 3, 1, 'Farel', 'farel@gmail.com', 'Permata Cibubur', '08127397812', 'L'),
(21, 3, 2, 'Angger', 'angger@gmail.com', 'Klapanunggal', '087617326155', 'L'),
(22, 3, 2, 'Jonathan', 'pandu@gmail.com', 'Gandoang', '082987319787', 'L'),
(23, 3, 2, 'Nabil', 'nabil@gmail.com', 'Klapanunggal', '08316298361', 'P'),
(24, 3, 2, 'Putri', 'putri@gmail.com', 'Kahuripan Mas', '083716218761', 'P'),
(25, 3, 2, 'Nisa', 'nisa@gmail.com', 'GNI', '09821387213', 'P'),
(26, 3, 3, 'Daffa', 'dapa@gmail.com', 'Kota Wisata', '088867812531', 'L'),
(27, 3, 3, 'Dimas', 'dims@gmail.com', 'Klapanunggal', '098237198271', 'L'),
(28, 3, 3, 'Fathan', 'patan@gmail.com', 'Citra Indah', '0821387129837', 'L'),
(29, 3, 3, 'Rutsiana', 'rut@gmail.com', 'Kota Wisata', '0897498127288', 'P'),
(30, 3, 3, 'Intan', 'intan@gmail.com', 'Cileungsi', '089271398271', 'P');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absen`
--
ALTER TABLE `absen`
  ADD PRIMARY KEY (`id_absen`),
  ADD KEY `id_murid` (`id_murid`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_guru`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_kelas` (`id_kelas`,`id_jurusan`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `murid`
--
ALTER TABLE `murid`
  ADD PRIMARY KEY (`id_murid`),
  ADD UNIQUE KEY `email` (`email`,`no_tlp`),
  ADD KEY `id_kelas` (`id_kelas`,`id_jurusan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absen`
--
ALTER TABLE `absen`
  MODIFY `id_absen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `murid`
--
ALTER TABLE `murid`
  MODIFY `id_murid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
