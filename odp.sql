-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2021 at 07:06 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `odp`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `User_ID` int(100) NOT NULL,
  `Username` varchar(50) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `Nama_Pegawai` varchar(100) DEFAULT NULL,
  `Kode_Pegawai` varchar(100) DEFAULT NULL,
  `verifikasi` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`User_ID`, `Username`, `Password`, `Nama_Pegawai`, `Kode_Pegawai`, `verifikasi`) VALUES
(1, 'Opt', '32250170a0dca92d53ec9624f336ca24', 'Dimmer ', 'F0001', 1),
(2, 'Adm', '32250170a0dca92d53ec9624f336ca24', 'Polymer', 'A0001', 0),
(3, 'Sls', 'pass123', 'Guide', 'S0001', 0);

-- --------------------------------------------------------

--
-- Table structure for table `klasifikasiodp`
--

CREATE TABLE `klasifikasiodp` (
  `KlasifikasiODP_ID` int(10) NOT NULL,
  `Klasifikasi_Nama` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `klasifikasiodp`
--

INSERT INTO `klasifikasiodp` (`KlasifikasiODP_ID`, `Klasifikasi_Nama`) VALUES
(1, 'Full Port'),
(2, 'Medium Port'),
(3, 'Low Port'),
(4, 'Empty Port');

-- --------------------------------------------------------

--
-- Table structure for table `odp`
--

CREATE TABLE `odp` (
  `ODP_ID` varchar(50) NOT NULL,
  `ODP_Name` varchar(200) DEFAULT NULL,
  `ODC_Name` varchar(200) DEFAULT NULL,
  `CO_Name` varchar(200) DEFAULT NULL,
  `Power_Signal` int(100) DEFAULT NULL,
  `Kapasitas` int(100) DEFAULT NULL,
  `GIS_href` varchar(255) DEFAULT NULL,
  `Latitude` varchar(50) DEFAULT NULL,
  `Longitude` varchar(50) DEFAULT NULL,
  `Tanggal_Instalasi` date DEFAULT NULL,
  `Optical_Power` int(100) DEFAULT NULL,
  `KlasifikasiODP_ID` int(10) DEFAULT NULL,
  `Kapasitas_After` int(100) DEFAULT NULL,
  `User_ID` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `odp`
--

INSERT INTO `odp` (`ODP_ID`, `ODP_Name`, `ODC_Name`, `CO_Name`, `Power_Signal`, `Kapasitas`, `GIS_href`, `Latitude`, `Longitude`, `Tanggal_Instalasi`, `Optical_Power`, `KlasifikasiODP_ID`, `Kapasitas_After`, `User_ID`) VALUES
('02656E506C61696E74657874', NULL, NULL, NULL, NULL, 8, NULL, NULL, NULL, NULL, -19, NULL, NULL, NULL),
('02656E6D65', NULL, NULL, NULL, NULL, 16, 'https://www.google.com/maps/?q=-2.918918918918919,104.78459649004877', '-2.918918918918919', '104.78459649004877', '2021-01-29', -19, 2, 13, 'c4ca4238a0b923820dcc509a6f75849b'),
('040FD4F2F66C81', NULL, NULL, NULL, NULL, 8, NULL, NULL, NULL, '2021-02-18', 0, NULL, 8, NULL),
('0417D4F2F66C81', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL),
('041BD4F2F66C81', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL),
('0423D4F2F66C81', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL),
('04609EA2CF5B80', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL),
('046F9DA2CF5B80', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL),
('047F9DA2CF5B80', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL),
('04A4EFF2F66C80', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL),
('04D4BC82A75A80', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL),
('83B62E24', 'jsk', 'eie', 'ek', 2, 16, 'https://www.google.com/maps/?q=-6.2772657,107.1280711', '-6.2772657', '107.1280711', '2021-02-25', -19, 3, 13, 'c4ca4238a0b923820dcc509a6f75849b'),
('afr098', NULL, NULL, NULL, NULL, 16, 'https://www.google.com/maps/?q=-2.933780,104.785828', '-2.933780', '104.785828', '2021-01-13', -19, NULL, NULL, NULL),
('E2000020271202362150D356', NULL, NULL, NULL, NULL, 8, 'https://www.google.com/maps/?q=-6.2773911,107.12830389999999', '-6.2773911', '107.12830389999999', '2020-11-04', -19, 3, 5, NULL),
('E2000020271202472150DF7A', NULL, NULL, NULL, NULL, 16, 'https://www.google.com/maps/?q=-2.918918918918919,104.78459649004877', '-2.918918918918919', '104.78459649004877', '2021-01-22', -19, NULL, 14, 'a'),
('E2000020271202472150DF7B', NULL, NULL, NULL, NULL, 16, 'https://www.google.com/maps/?q=-6.917464,107.619125', '-6.917464', '107.619125', '2020-11-07', -19, 2, 8, NULL),
('gty34', 'df', 'cs', 'os', 3, 16, 'https://www.google.com/maps/?q=-2.9775096,104.8018487', '-2.9775096', '104.8018487', '2021-02-25', -19, 0, -1, 'asdd');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `Pegawai_ID` int(100) NOT NULL,
  `Nama_Pegawai` varchar(100) DEFAULT NULL,
  `Kode_Pegawai` varchar(100) DEFAULT NULL,
  `User_ID` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `port`
--

CREATE TABLE `port` (
  `Port_ID` int(100) NOT NULL,
  `ID_Pelanggan` varchar(50) DEFAULT NULL,
  `Alamat` varchar(100) DEFAULT NULL,
  `Tanggal_Instalasi` date DEFAULT NULL,
  `Layanan` varchar(100) DEFAULT NULL,
  `Power_Signal` int(100) DEFAULT NULL,
  `SN_Modem` varchar(200) DEFAULT NULL,
  `ODP_ID` varchar(50) DEFAULT NULL,
  `User_ID` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `port`
--

INSERT INTO `port` (`Port_ID`, `ID_Pelanggan`, `Alamat`, `Tanggal_Instalasi`, `Layanan`, `Power_Signal`, `SN_Modem`, `ODP_ID`, `User_ID`) VALUES
(1, 'Cust1-1', 'Jababeka XIV', '2020-11-06', 'Single Play', NULL, NULL, 'E2000020271202362150D356', NULL),
(2, 'Cust2-1', 'Harja Mekar', '2020-11-20', 'Triple Play', NULL, NULL, 'E2000020271202362150D356', NULL),
(3, 'idPost', 'altPost', '2020-11-05', 'Triple Play', NULL, NULL, 'E2000020271202472150DF7B', NULL),
(6, 'Pelanggan_ID', 'AlamatPelanggan', '2021-01-05', 'LayananPelanggan', NULL, NULL, 'E2000020271202472150DF7A', 'c4ca4238a0b923820dcc509a6f75849b'),
(7, 'Pel1', 'Sako', '2021-01-04', 'Simple', NULL, NULL, 'E2000020271202472150DF7A', 'c4ca4238a0b923820dcc509a6f75849b'),
(57, 'IdPelanggan', 'Alamat', '2021-01-27', 'Single Play', NULL, NULL, '02656E6D65', 'c4ca4238a0b923820dcc509a6f75849b'),
(58, 'Opt', 'add', '2021-01-22', 'Double Play', NULL, NULL, '02656E6D65', NULL),
(59, 'IPel', 'House', '2021-01-22', 'Triple Play', NULL, NULL, '02656E6D65', NULL),
(65, 'Id 1', 'Rumah', '2021-02-09', 'Single Play', NULL, NULL, '83B62E24', 'c4ca4238a0b923820dcc509a6f75849b'),
(68, 'Id 2', 'Kos', '2021-02-09', 'Triple Play', NULL, NULL, '83B62E24', 'c4ca4238a0b923820dcc509a6f75849b'),
(70, 'Id 3', 'Warehouse', '2021-02-10', 'Triple Play', NULL, NULL, '83B62E24', 'c4ca4238a0b923820dcc509a6f75849b'),
(78, 'gty34', 'aLamat', '2021-02-25', 'Play', 345, 'asf4f', 'gty34', 'vbde');

-- --------------------------------------------------------

--
-- Table structure for table `verifikasi`
--

CREATE TABLE `verifikasi` (
  `id` int(200) NOT NULL,
  `namaVerifikasi` varchar(200) DEFAULT NULL,
  `tanggalVerifikasi` datetime DEFAULT NULL,
  `verifikasi` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`User_ID`);

--
-- Indexes for table `klasifikasiodp`
--
ALTER TABLE `klasifikasiodp`
  ADD PRIMARY KEY (`KlasifikasiODP_ID`);

--
-- Indexes for table `odp`
--
ALTER TABLE `odp`
  ADD PRIMARY KEY (`ODP_ID`),
  ADD KEY `KlasifikasiODP_ID` (`KlasifikasiODP_ID`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`Pegawai_ID`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `port`
--
ALTER TABLE `port`
  ADD PRIMARY KEY (`Port_ID`),
  ADD KEY `ODP_ID` (`ODP_ID`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `verifikasi`
--
ALTER TABLE `verifikasi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `User_ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `Pegawai_ID` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `port`
--
ALTER TABLE `port`
  MODIFY `Port_ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `verifikasi`
--
ALTER TABLE `verifikasi`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
