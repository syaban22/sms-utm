-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2020 at 06:49 PM
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(256) NOT NULL,
  `gambar` varchar(256) NOT NULL,
  `username` int(11) NOT NULL,
  `prodi` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `gambar`, `username`, `prodi`) VALUES
(5, 'Admin TIF', 'default.jpg', 5, '4111');

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `nip` varchar(18) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `gambar` varchar(256) NOT NULL,
  `username` int(11) DEFAULT NULL,
  `prodi` varchar(4) NOT NULL,
  `email` varchar(256) NOT NULL,
  `tgl_buat` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`nip`, `nama`, `gambar`, `username`, `prodi`, `email`, `tgl_buat`) VALUES
('196911182001121004', 'Dr. Arif Muntasa, S.SI., M.T.', 'default.jpg', 45, '4111', '', ''),
('197101092006021012', 'Muhammad Kautsar Sophan, S.T., M.T.', 'default.jpg', 10, '4111', '', ''),
('19740102017021002', 'Ir. Soekarno, Alm.', 'default.jpg', 22, '1112', '', ''),
('197402212008011006', 'Dwi Kuswanto, S.Pd., M.T.', 'default.jpg', 38, '4111', '', '1587307634'),
('197803092003122009', 'Arik Kurniawati, S.Kom., M.T.', 'default.jpg', 36, '4111', '', '1587294193'),
('197901092006021011', 'Sigit Susanto Putro, S.Kom., M.Kom', 'default.jpg', 23, '4111', 'Sigit.Susanto.P@trunojoyo.ac.id', ''),
('197902222005012003', 'Ari Kusumaningsih, S.T., M.T.', 'default.jpg', 35, '4111', '', ''),
('198101092006041003', 'Achmad Jauhari, S.T., M.Kom.', 'default.jpg', 14, '4111', '', '');

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
-- Table structure for table `jadwal_sempro`
--

CREATE TABLE `jadwal_sempro` (
  `id` int(11) NOT NULL,
  `id_skripsi` int(11) NOT NULL,
  `tanggal` varchar(256) DEFAULT NULL,
  `waktu` varchar(256) DEFAULT NULL,
  `periode` varchar(256) NOT NULL,
  `penguji_1` int(18) DEFAULT NULL,
  `penguji_2` int(18) DEFAULT NULL,
  `penguji_3` int(18) DEFAULT NULL,
  `ruangan` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_sidang`
--

CREATE TABLE `jadwal_sidang` (
  `id` int(11) NOT NULL,
  `id_skripsi` int(11) NOT NULL,
  `tanggal` varchar(256) DEFAULT NULL,
  `waktu` varchar(256) DEFAULT NULL,
  `periode` varchar(256) NOT NULL,
  `penguji_1` int(18) DEFAULT NULL,
  `penguji_2` int(18) DEFAULT NULL,
  `penguji_3` int(18) DEFAULT NULL,
  `ruangan` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'Laki - Laki'),
(2, 'Perempuan');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` char(12) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `gambar` varchar(256) NOT NULL,
  `prodi` varchar(4) NOT NULL,
  `email` varchar(256) NOT NULL,
  `tgl_buat` varchar(256) NOT NULL,
  `username` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama`, `gambar`, `prodi`, `email`, `tgl_buat`, `username`) VALUES
('1701111', 'anak ilmu perikanan', 'default.jpg', '1111', '', '1587363651', 46),
('170411100007', 'Anas Tri Krisna', 'default.jpg', '4111', '', '', 31),
('170411100015', 'Abd. Ghofar Suwarno', 'default.jpg', '4111', '', '', 33),
('170411100024', 'Moh. Irsad', 'default.jpg', '4111', '', '', 32),
('170411100042', 'Ria Rostiani', 'default.jpg', '4111', '', '', 34),
('170411100099', 'Ahmad Khairi Ramadan', 'default.jpg', '4111', '', '', 30),
('170411100119', 'Sya\'ban', 'sbn_sma.jpg', '4111', '', '0000-00-00', 8);

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
('01', '1111', 'Ilmu Kelautan'),
('01', '1112', 'Agribisnis'),
('02', '2111', 'Ilmu Hukum'),
('03', '3111', 'Akuntansi'),
('03', '3112', 'Manajemen'),
('03', '3113', 'Ekonomi Pembangunan'),
('01', '3311', 'TIP'),
('04', '4111', 'Teknik Informatika'),
('04', '4112', 'Teknik Industri');

-- --------------------------------------------------------

--
-- Table structure for table `skripsi`
--

CREATE TABLE `skripsi` (
  `id` int(11) NOT NULL,
  `judul` varchar(128) NOT NULL,
  `abstract` varchar(256) NOT NULL,
  `nim` char(12) NOT NULL,
  `dosbing_1` varchar(18) DEFAULT NULL,
  `dosbing_2` varchar(18) DEFAULT NULL,
  `prodi` varchar(4) NOT NULL,
  `nilai` float DEFAULT 0,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `skripsi`
--

INSERT INTO `skripsi` (`id`, `judul`, `abstract`, `nim`, `dosbing_1`, `dosbing_2`, `prodi`, `nilai`, `status`) VALUES
(20, 'tes1', 'tes1', '170411100007', '19740102017021002', '196911182001121004', '4111', 0, 1),
(21, 'tes2', 'tes2', '170411100015', '197101092006021012', '197901092006021011', '4111', 0, 0),
(22, 'tes3', 'tes3', '170411100015', '197101092006021012', '197901092006021011', '4111', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `ket` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `ket`) VALUES
(0, 'gagal'),
(1, 'mendaftarkan Skripsi'),
(2, 'peserta seminar proposal'),
(3, 'proses bimbingan skripsi'),
(4, 'mengajukan sidang skripsi'),
(5, 'peserta ujian sidang skripsi'),
(6, 'skripsi lulus'),
(7, 'upload laporan skripsi'),
(21, 'peserta seminar ulang proposal'),
(51, 'peserta sidang ulang skripsi	');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `level_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `level_id`) VALUES
(4, 'administrator', '$2y$10$lOjQD3YKnG1TAqyF1k9JeOIkTRzk8inf8n/CosseJRukE/CaKD.5m', 1),
(5, 'Teknik Informatika', '$2y$10$STanvCWBStCmfEtR3WWph.hRlIfbAEogr7DY33G9.bR0Sp8Pu4fSW', 2),
(6, 'test', '$2y$10$RikrwAlp.b6tM1Sx6ibCpulC.YwCx4H5z474qJgA9Bclpbwye65nu', 3),
(8, '170411100119', '$2y$10$rx93xysDjs4GOjSvuCspMeyrwtUr4XYbndGvntTyuvvJJHPAunZta', 4),
(10, '197101092006021012', '$2y$10$U2xaaVKXgX.zmrzG/mg33.cJi0M3cmKY3ynyJ9P3gTZ1ZUuNwL90S', 3),
(13, '197406102008121002', '$2y$10$PXXoHHU1VXw93gFMv2FL4OoCG2cfiTqbyCeU9LwJPGyZwUIcsomMO', 3),
(14, '198101092006041003', '$2y$10$WrSKILFnm4JuDBv8HYh1vuGPtfmRNMSuZHTsw92LupsQhhxvTPj5G', 3),
(22, '19740102017021002', '$2y$10$kc7dim4u.xC8kqxecg3iAuJReYtufzshyrXFgs2qIee/toBuNhBBK', 3),
(23, '197901092006021011', '$2y$10$i9ruKQBqa25Cq0w0LxQXReG3V9mHVEqEuNQvGH1s2sWXUzkJdFIxe', 3),
(29, '170411100091', '$2y$10$AlUw26.IrvKBckGfjn.Qe.E4pja4XvoXolJux5iijh6rJJQnVxfba', 4),
(30, '170411100099', '$2y$10$GN/lYl30HtZdznulOVy7wOYw3j5Rn/UBceuwJ4Jp9LwoTVu3QVEfi', 4),
(31, '170411100007', '$2y$10$saDeaWuB3gE27WSA5S35YOBTXS2RrGTdUW9DEN/a7dJGxzcbq7vXG', 4),
(32, '170411100024', '$2y$10$5Ln5prYBf8Upw7Vb3sdI9u7dbLSzbGna.RT7zTgLjtlXE9ZHmx0s6', 4),
(33, '170411100015', '$2y$10$4ohDN/873RJVawPs0VxYCOOF6JHSaoC4nbdo51U.SHhhCCM3zzasO', 4),
(34, '170411100042', '$2y$10$Js.4ZQnEBPEcwVT2GW7Rh.gEodGGklt5iyPRPDVCLLRDKyRerHQa2', 4),
(35, '197902222005012003', '$2y$10$dYffDJCiMupJQNYwnYS51ODMj.AQV2s9usw25WDhZZ4iqLLDlX2cW', 3),
(36, '197803092003122009', '$2y$10$4CWWnBgQVX0NFFZ4pg9FxexYulDFrrOhXR7RNNXTQtjmKdHCK1riC', 3),
(38, '197402212008011006', '$2y$10$TPE8J2fZH.uqNZSovATRd.8CTgQ5CG70PECueMwaP1J.mC6fUF43G', 3),
(39, 'asd', '$2y$10$obW9ti0EacQzZS2SHJNwV.Yy4/sqHES7rvi84JuIW1VqIYQP/9jny', 3),
(41, '086', '$2y$10$FY3Rtg1xaHI5g/qwo4/8eu3.6sTxkVMnZPNUAcFa5s5xq9dSh1dcO', 3),
(42, '11', '$2y$10$S7bMkHyUqWH/DY0H1yuAEeR5yvtOcnJXBQ21QOOCLTXnJjFSwCs5u', 4),
(44, '130111100', '$2y$10$nuBalhaCx3fSfqw0M5Iosewk3iXeS2ToZ.VHKpmvRhfsK1EW7mQCW', 4),
(45, '196911182001121004', '$2y$10$BK7taTawIVwfBsYlHo9Vj.sGjMNumWlT/Xv4bk1RCHY6EF6awxAVe', 3),
(46, '1701111', '$2y$10$wITa5vyDX8VApEdorS7YpecNW/R4MqaSk7FT2CNDzB8OHaDF.pV8u', 4);

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
(10, 2, 10),
(11, 3, 11),
(12, 4, 12),
(15, 1, 2),
(17, 1, 9);

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
(25, 10, 'Daftar Skripsi', 'admin/daftarSkripsi', 'fa fa-fw fa-home', 1),
(26, 1, 'Daftar Jenis Kelamin', 'administrator/getJenKel', 'fas fa-fw fa-user', 1),
(27, 1, 'Daftar Status', 'administrator/getStatus', 'fas fa-fw fa-clipboard-list', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usr_admin` (`username`),
  ADD KEY `usr_prodi` (`prodi`);

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
-- Indexes for table `jadwal_sempro`
--
ALTER TABLE `jadwal_sempro`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal_sidang`
--
ALTER TABLE `jadwal_sidang`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `prodi` (`prodi`),
  ADD KEY `nim` (`nim`),
  ADD KEY `skripsi_ibfk_8` (`status`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jadwal_sempro`
--
ALTER TABLE `jadwal_sempro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwal_sidang`
--
ALTER TABLE `jadwal_sidang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenkel`
--
ALTER TABLE `jenkel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `skripsi`
--
ALTER TABLE `skripsi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `usr_admin` FOREIGN KEY (`username`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `usr_prodi` FOREIGN KEY (`prodi`) REFERENCES `prodi` (`kode_prodi`) ON UPDATE CASCADE;

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
  ADD CONSTRAINT `skripsi_ibfk_6` FOREIGN KEY (`prodi`) REFERENCES `prodi` (`kode_prodi`) ON UPDATE CASCADE,
  ADD CONSTRAINT `skripsi_ibfk_7` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`) ON UPDATE CASCADE,
  ADD CONSTRAINT `skripsi_ibfk_8` FOREIGN KEY (`status`) REFERENCES `status` (`id`);

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
