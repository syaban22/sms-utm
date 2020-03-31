-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2020 at 07:40 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sms_utm`
--

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `nip` varchar(18) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` int(11) DEFAULT NULL,
  `prodi` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`nip`, `nama`, `username`, `prodi`) VALUES
('197101092006021012', 'Muhammad Kautsar Sophan, S.T., M.T.	', 10, '0401'),
('197406102008121002', 'Dr. Arif Muntasa, S.SI., M.T.', 13, '0401'),
('198101092006041003', 'Achmad Jauhari, S.T., M.Kom.', 14, '0401');

-- --------------------------------------------------------

--
-- Table structure for table `fakultas`
--

CREATE TABLE `fakultas` (
  `kode_fak` varchar(2) NOT NULL,
  `fakultas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fakultas`
--

INSERT INTO `fakultas` (`kode_fak`, `fakultas`) VALUES
('01', 'Fakultas Pertanian'),
('02', 'Fakultas Hukum'),
('03', 'Fakultas Ekonomi'),
('04', 'Fakultas Teknik'),
('05', 'Fakultas Ilmu-Ilmu Keislaman'),
('06', 'Fakultas Ilmu Sosial dan Budaya');

-- --------------------------------------------------------

--
-- Table structure for table `jenkel`
--

CREATE TABLE `jenkel` (
  `id` int(11) NOT NULL,
  `jenis` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenkel`
--

INSERT INTO `jenkel` (`id`, `jenis`) VALUES
(1, 'Laki - laki'),
(2, 'Perempuan');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` char(12) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `prodi` varchar(4) NOT NULL,
  `username` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama`, `prodi`, `username`) VALUES
('170411100119', 'Sya\'ban', '0401', 8);

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `kode_fak` varchar(2) NOT NULL,
  `kode_prodi` varchar(4) NOT NULL,
  `prodi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`kode_fak`, `kode_prodi`, `prodi`) VALUES
('01', '0101', 'Ilmu Kelautan'),
('01', '0102', 'Agribisnis'),
('01', '0103', 'TIP'),
('02', '0201', 'Ilmu Hukum'),
('03', '0301', 'Akuntansi'),
('03', '0302', 'Manajemen'),
('03', '0303', 'Ekonomi Pembangunan'),
('04', '0401', 'Teknik Informatika'),
('04', '0402', 'Teknik Industri');

-- --------------------------------------------------------

--
-- Table structure for table `skripsi`
--

CREATE TABLE `skripsi` (
  `id` int(11) NOT NULL,
  `judul` varchar(128) NOT NULL,
  `nim` char(12) NOT NULL,
  `dosbing_1` varchar(18) DEFAULT NULL,
  `dosbing_2` varchar(18) DEFAULT NULL,
  `dosen_uji1` varchar(18) DEFAULT NULL,
  `dosen_uji2` varchar(18) DEFAULT NULL,
  `dosen_uji3` varchar(18) DEFAULT NULL,
  `prodi` varchar(4) NOT NULL,
  `nilai` float DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `skripsi`
--

INSERT INTO `skripsi` (`id`, `judul`, `nim`, `dosbing_1`, `dosbing_2`, `dosen_uji1`, `dosen_uji2`, `dosen_uji3`, `prodi`, `nilai`) VALUES
(5, 'Deteksi buah dengan metode Haar Cascade', '170411100119', '197101092006021012', '197406102008121002', NULL, NULL, NULL, '0401', 0),
(6, 'skripsi kedua tentang apa aja', '170411100119', '198101092006041003', '197406102008121002', NULL, NULL, NULL, '0401', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `gambar` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `level_id` int(11) NOT NULL,
  `aktif` int(1) NOT NULL,
  `tgl_buat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `email`, `gambar`, `username`, `password`, `level_id`, `aktif`, `tgl_buat`) VALUES
(4, 'administrator', 'syabansim@ymail.com', '', 'administrator', '$2y$10$lOjQD3YKnG1TAqyF1k9JeOIkTRzk8inf8n/CosseJRukE/CaKD.5m', 1, 1, 0),
(5, 'Admin Teknik Informatika', 'syaban_22._-@ymail.com', '', 'AdminTI', '$2y$10$2uPPC9EUKzhVWtHHH1efHeV.aCNKWfYYLNwsRmLE6UNjGXawcSAt6', 2, 1, 0),
(6, 'Dosen', 'syaban_22-@ymail.com', '', 'dosen', '$2y$10$G7HSSHiHISvvHv14jcISSu00/5fXvn2/vMgcFMVEP5r4jWI9NEKEW', 3, 1, 0),
(8, 'syaban', '170411100119@student.trunojoyo.ac.id', 'sbn_sma.jpg', '170411100119', '$2y$10$rx93xysDjs4GOjSvuCspMeyrwtUr4XYbndGvntTyuvvJJHPAunZta', 4, 1, 1583670224),
(10, 'Muhammad Kautsar Sophan, S.T., M.T.', 'dummy@gmail.com', 'default.jpg', '197101092006021012', '$2y$10$U2xaaVKXgX.zmrzG/mg33.cJi0M3cmKY3ynyJ9P3gTZ1ZUuNwL90S', 3, 1, 1583732627),
(13, 'Dr. Arif Muntasa, S.SI., M.T.', 'NULL', 'default.jpg', '197406102008121002', '$2y$10$PXXoHHU1VXw93gFMv2FL4OoCG2cfiTqbyCeU9LwJPGyZwUIcsomMO', 3, 0, 1583749796),
(14, 'Achmad Jauhari, S.T., M.Kom.', 'NULL', 'default.jpg', '198101092006041003', '$2y$10$WrSKILFnm4JuDBv8HYh1vuGPtfmRNMSuZHTsw92LupsQhhxvTPj5G', 3, 0, 1584191662);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(4, 1, 9),
(10, 2, 10),
(11, 3, 11),
(12, 4, 12),
(13, 1, 12),
(14, 1, 11),
(15, 1, 2),
(16, 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `user_level`
--

CREATE TABLE `user_level` (
  `id` int(11) NOT NULL,
  `level` varchar(128) NOT NULL,
  `ket` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_level`
--

INSERT INTO `user_level` (`id`, `level`, `ket`) VALUES
(1, 'Administrator', 'Akses level tertinggi'),
(2, 'adminprodi', 'Akses level admin prodi'),
(3, 'Dosen', 'Akses level dosen'),
(4, 'Mahasiswa', 'Akses level mahasiswa');

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'administrator'),
(2, 'menu'),
(9, 'User'),
(10, 'Admin'),
(11, 'Dosen'),
(12, 'Mahasiswa');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'administrator', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'Manajemen Menu', 'menu', 'fas fa-fw fa-folder', 1),
(3, 2, 'Manajemen Submenu', 'menu/submenu', '	\r\nfas fa-fw fa-folder-open', 1),
(7, 9, 'Level Akses', 'administrator/level', 'fas fa-fw fa-user-tie', 1),
(10, 9, 'Manajemen User', 'administrator/getUserlist', 'fas fa-fw fa-user', 1),
(11, 10, 'Dashboard', 'admin', 'fas fa-fw fa-clipboard-list', 1),
(13, 12, 'My Profile', 'mahasiswa/profile', 'fas fa-fw fa-user', 1),
(14, 12, 'Daftarkan Skripsi', 'mahasiswa/DaftarkanSkripsi', 'fas fa-fw fa-clipboard-list', 1),
(15, 12, 'Status Skripsi', 'mahasiswa/StatusSkripsi', 'fas fa-fw fa-user-tie', 1),
(16, 12, 'Bimbingan Skripsi', 'mahasiswa/Bimbingan', 'fas fa-fw fa-user', 1),
(17, 1, 'Daftar Fakultas', 'administrator/Fakultas', 'fas fa-fw fa-user-tie', 1),
(18, 1, 'Daftar Program Studi', 'administrator/ProgramStudi', 'fas fa-fw fa-user-tie', 1),
(19, 1, 'Daftar Dosen', 'administrator/daftarDosen', 'fas fa-fw fa-user-tie', 1),
(20, 11, 'My Profile', 'dosen', 'fas fa-fw fa-user-tie', 1),
(21, 11, 'Mahasiswa', 'dosen/getMahasiswa', 'fas fa-fw fa-user', 1),
(22, 10, 'Daftar Dosen', 'admin/daftarDosen', 'fa fa-user fa-fw', 1),
(23, 10, 'Daftar Mahasiswa', 'admin/daftarMahasiswa', 'fa fa-user fa-fw', 1),
(24, 1, 'Daftar Mahasiswa', 'administrator/daftarMahasiswa', 'fa fa-user fa-fw', 1),
(25, 10, 'Daftar Skripsi', 'admin/daftarSkripsi', 'fa fa-fw fa-home', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`nip`),
  ADD KEY `prodi` (`prodi`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`kode_fak`);

--
-- Indexes for table `jenkel`
--
ALTER TABLE `jenkel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`),
  ADD KEY `prodi` (`prodi`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`kode_prodi`),
  ADD KEY `kode_fak` (`kode_fak`);

--
-- Indexes for table `skripsi`
--
ALTER TABLE `skripsi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dosbing_1` (`dosbing_1`),
  ADD KEY `dosbing_2` (`dosbing_2`),
  ADD KEY `dosen_uji1` (`dosen_uji1`),
  ADD KEY `dosen_uji2` (`dosen_uji2`),
  ADD KEY `dosen_uji3` (`dosen_uji3`),
  ADD KEY `prodi` (`prodi`),
  ADD KEY `nim` (`nim`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `level` (`level_id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_access_menu_ibfk_2` (`menu_id`),
  ADD KEY `menu_id` (`role_id`) USING BTREE;

--
-- Indexes for table `user_level`
--
ALTER TABLE `user_level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenkel`
--
ALTER TABLE `jenkel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `skripsi`
--
ALTER TABLE `skripsi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_level`
--
ALTER TABLE `user_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dosen`
--
ALTER TABLE `dosen`
  ADD CONSTRAINT `dosen_ibfk_1` FOREIGN KEY (`prodi`) REFERENCES `prodi` (`kode_prodi`),
  ADD CONSTRAINT `dosen_ibfk_2` FOREIGN KEY (`username`) REFERENCES `user` (`id`);

--
-- Constraints for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `mahasiswa_ibfk_1` FOREIGN KEY (`prodi`) REFERENCES `prodi` (`kode_prodi`) ON UPDATE CASCADE,
  ADD CONSTRAINT `mahasiswa_ibfk_2` FOREIGN KEY (`username`) REFERENCES `user` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `prodi`
--
ALTER TABLE `prodi`
  ADD CONSTRAINT `prodi_ibfk_1` FOREIGN KEY (`kode_fak`) REFERENCES `fakultas` (`kode_fak`) ON UPDATE CASCADE;

--
-- Constraints for table `skripsi`
--
ALTER TABLE `skripsi`
  ADD CONSTRAINT `skripsi_ibfk_1` FOREIGN KEY (`dosbing_1`) REFERENCES `dosen` (`nip`) ON UPDATE CASCADE,
  ADD CONSTRAINT `skripsi_ibfk_2` FOREIGN KEY (`dosbing_2`) REFERENCES `dosen` (`nip`) ON UPDATE CASCADE,
  ADD CONSTRAINT `skripsi_ibfk_3` FOREIGN KEY (`dosen_uji1`) REFERENCES `dosen` (`nip`) ON UPDATE CASCADE,
  ADD CONSTRAINT `skripsi_ibfk_4` FOREIGN KEY (`dosen_uji2`) REFERENCES `dosen` (`nip`) ON UPDATE CASCADE,
  ADD CONSTRAINT `skripsi_ibfk_5` FOREIGN KEY (`dosen_uji3`) REFERENCES `dosen` (`nip`) ON UPDATE CASCADE,
  ADD CONSTRAINT `skripsi_ibfk_6` FOREIGN KEY (`prodi`) REFERENCES `prodi` (`kode_prodi`) ON UPDATE CASCADE,
  ADD CONSTRAINT `skripsi_ibfk_7` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`) ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`level_id`) REFERENCES `user_level` (`id`);

--
-- Constraints for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD CONSTRAINT `user_access_menu_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `user_level` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_access_menu_ibfk_2` FOREIGN KEY (`menu_id`) REFERENCES `user_menu` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD CONSTRAINT `user_sub_menu_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `user_menu` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
