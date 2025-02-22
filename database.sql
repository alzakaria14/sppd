-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2025 at 06:42 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sppd`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_anggaran`
--

CREATE TABLE `tb_anggaran` (
  `id_anggaran` char(36) NOT NULL,
  `id_sppd` char(36) NOT NULL,
  `uang_harian` float NOT NULL,
  `transportasi` float NOT NULL,
  `penginapan` float NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_anggaran`
--

INSERT INTO `tb_anggaran` (`id_anggaran`, `id_sppd`, `uang_harian`, `transportasi`, `penginapan`, `created_at`, `updated_at`) VALUES
('1a57aaf4-624b-11ef-bfc5-74563cac53f0', 'd977d73e-6213-11ef-bc9d-74563cac53f0', 50000, 25522, 1222460, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('2184f1b0-624b-11ef-bffc-74563cac53f0', 'd977d73e-6213-11ef-bc9d-74563cac53f0', 200000, 522200, 233323, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('6065058e-6398-11ef-8947-74563cac53f0', 'd977d73e-6213-11ef-bc9d-74563cac53f0', 20000, 200000, 20000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('bfbcb066-6548-11ef-8b83-74563cac53f0', 'aa74a5c8-6215-11ef-8920-74563cac53f0', 500000, 200000, 200000, '2024-08-28 22:21:00', '2024-08-28 22:21:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kegiatan`
--

CREATE TABLE `tb_kegiatan` (
  `id_kegiatan` char(36) NOT NULL,
  `id_sppd` char(36) NOT NULL,
  `kegiatan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`kegiatan`)),
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_kegiatan`
--

INSERT INTO `tb_kegiatan` (`id_kegiatan`, `id_sppd`, `kegiatan`, `created_at`, `updated_at`) VALUES
('10f1b3aa-6445-11ef-a38a-74563cac53f0', 'd977d73e-6213-11ef-bc9d-74563cac53f0', '[{\"kegiatan\":\"coba 123\",\"tanggal\":\"2024-08-28\",\"tempat\":\"ini hanya coba\"},{\"kegiatan\":\"coba kedua\",\"tanggal\":\"2024-08-28\",\"tempat\":\"coba lagi\"}]', '2024-08-27 15:22:07', '2024-08-27 15:22:07'),
('c40ebad8-6430-11ef-8615-74563cac53f0', 'd977d73e-6213-11ef-bc9d-74563cac53f0', '[{\"kegiatan\":\"asd \",\"tanggal\":\"2024-08-29\",\"tempat\":\"asdasdasd\"},{\"kegiatan\":\"asdasd\",\"tanggal\":\"2024-08-13\",\"tempat\":\"asdasdasddd\"}]', '2024-08-27 12:56:48', '2024-08-27 12:56:48'),
('f3d2cd26-654e-11ef-a7b4-74563cac53f0', 'aa74a5c8-6215-11ef-8920-74563cac53f0', '[{\"kegiatan\":\"kegiatan 1\",\"tanggal\":\"2024-08-28\",\"tempat\":\"Banjarmasin\"},{\"kegiatan\":\"Kegiatan 2\",\"tanggal\":\"2024-08-29\",\"tempat\":\"Banjarbaru\"},{\"kegiatan\":\"Kegiatan 3\",\"tanggal\":\"2024-08-30\",\"tempat\":\"Martapura\"}]', '2024-08-28 23:05:24', '2024-08-28 23:05:24');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kwitansi`
--

CREATE TABLE `tb_kwitansi` (
  `id_kwitansi` char(36) NOT NULL,
  `id_sppd` char(36) NOT NULL,
  `jumlah` float NOT NULL,
  `perihal` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_kwitansi`
--

INSERT INTO `tb_kwitansi` (`id_kwitansi`, `id_sppd`, `jumlah`, `perihal`, `created_at`, `updated_at`) VALUES
('2880b62c-62bc-11ef-865e-74563cac53f0', 'd977d73e-6213-11ef-bc9d-74563cac53f0', 50000000, 'lima puluh', '2024-08-25 16:29:34', '2024-08-25 16:29:34'),
('4357e07e-654b-11ef-88ad-74563cac53f0', 'aa74a5c8-6215-11ef-8920-74563cac53f0', 1323450000000, 'coba coba', '2024-08-28 22:38:59', '2024-08-28 22:38:59'),
('5713d7da-62bc-11ef-9eea-74563cac53f0', 'd977d73e-6213-11ef-bc9d-74563cac53f0', 79239100, 'coba coba', '2024-08-25 16:30:52', '2024-08-25 16:52:17');

-- --------------------------------------------------------

--
-- Table structure for table `tb_login`
--

CREATE TABLE `tb_login` (
  `id_login` char(36) NOT NULL,
  `id_user` char(36) NOT NULL,
  `token` char(64) NOT NULL,
  `login_at` datetime NOT NULL,
  `acces_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_login`
--

INSERT INTO `tb_login` (`id_login`, `id_user`, `token`, `login_at`, `acces_at`) VALUES
('39108df2-6094-11ef-83f1-74563cac53f0', '19c11e86-6094-11ef-a313-74563cac53f0', '2bc76b86106484d10132dc7ca6d31111e6a2289b9438467205c0d77c0be44d89', '2024-08-22 22:38:40', '2024-08-23 01:22:24'),
('3cd4bf6e-60ab-11ef-b114-74563cac53f0', '19c11e86-6094-11ef-a313-74563cac53f0', 'a58f45c0e048f1e50033e45b536cd686f96b10cab14b34a6b68f85afe3d73079', '2024-08-23 01:23:24', '2024-08-25 14:55:16'),
('5946fd32-62b4-11ef-be24-74563cac53f0', '19c11e86-6094-11ef-a313-74563cac53f0', 'e9ccdd17b6734d800db061126264f12987f0e3e2a6fbec5f4920f142ae029087', '2024-08-25 15:33:39', '2024-08-26 02:48:16'),
('5c5a9714-6452-11ef-bcf9-74563cac53f0', '19c11e86-6094-11ef-a313-74563cac53f0', '05059a66441659f2887c5054e9b7ff3c03caf66c5510c374c24d4f6dc866ee29', '2024-08-27 16:57:17', '2024-08-28 13:54:14'),
('77dea9c8-6446-11ef-b2ce-74563cac53f0', '70c92424-6446-11ef-9f47-74563cac53f0', '55988f03a62cdcd79bbe1b9eec68fc8c24e4982b10919e67bc69d03ffa14da60', '2024-08-27 15:32:09', '2024-08-27 15:32:09'),
('85829ed6-6446-11ef-bff5-74563cac53f0', '19c11e86-6094-11ef-a313-74563cac53f0', 'c7274b520183850dc6b81c2147fc983e3dde5fafc8b2fb75ce437d81b2b01219', '2024-08-27 15:32:32', '2024-08-27 15:32:32'),
('94a3f356-f0d2-11ef-bb94-00155d1a0868', '19c11e86-6094-11ef-a313-74563cac53f0', '74473d5e71cc91b39e224ec1909a858525afd6ab5f1e0178748026bbde9f91b1', '2025-02-22 12:07:49', '2025-02-22 13:27:34'),
('9de6c7ce-8708-11ef-a82e-74563cac53f0', '19c11e86-6094-11ef-a313-74563cac53f0', 'cc0782d6d4fca05ab296ffecfc07731152878ee9985595ef433989b29051adb7', '2024-10-10 21:07:34', '2024-10-10 21:09:12'),
('9e00eb1e-6312-11ef-bd12-74563cac53f0', '19c11e86-6094-11ef-a313-74563cac53f0', 'e9c7e8888786f0eef40f00dc5874bd62cdf8605f507172f283a6471de99cf533', '2024-08-26 02:48:28', '2024-08-27 15:32:00'),
('a4ceed3e-6447-11ef-9244-74563cac53f0', '19c11e86-6094-11ef-a313-74563cac53f0', 'fa70760557b1ea19af507313ea829a60dc8ab539ef4b4a32b762f2cff50f0d4b', '2024-08-27 15:40:34', '2024-08-27 15:40:45'),
('a809e2c8-f0de-11ef-b617-00155d1a0868', '19c11e86-6094-11ef-a313-74563cac53f0', '64ab633f36db4725f1f80aecbfc5abf66d65c3ee1c76547a554fa4e5d74ce965', '2025-02-22 13:34:16', '2025-02-22 13:34:51'),
('b1b897ac-6447-11ef-b9f3-74563cac53f0', '19c11e86-6094-11ef-a313-74563cac53f0', '903ed352716f87f0ab483be7ca89e1a7185a344ab1d409dd3c15a9900a9a435b', '2024-08-27 15:40:55', '2024-08-27 15:55:42'),
('c480cbe4-644b-11ef-a699-74563cac53f0', '70c92424-6446-11ef-9f47-74563cac53f0', 'e86be9aea03c57cb107c4e284ba6e8512020df24dd6d2c5a473ea2257f6386de', '2024-08-27 16:10:05', '2024-08-27 16:11:17'),
('ca8eee24-f0de-11ef-86a5-00155d1a0868', '70c92424-6446-11ef-9f47-74563cac53f0', 'cedb73d6b8ab022682d3c2820111a7563881e94ced6ce69e1fbff6aa6e1c2563', '2025-02-22 13:35:14', '2025-02-22 13:42:23'),
('cb631f5a-65b5-11ef-abb8-74563cac53f0', '19c11e86-6094-11ef-a313-74563cac53f0', '793ea11883d2930349ddcbe67cbbcbfb8424341678d6dd6d83aada97341e31d1', '2024-08-29 11:21:34', '2024-08-29 11:21:34'),
('d442fd86-6446-11ef-b4c1-74563cac53f0', '70c92424-6446-11ef-9f47-74563cac53f0', 'afc64db2c564a7abea52a63cb0abc6bfe7053a6e9860df35c54dab96de1262e8', '2024-08-27 15:34:44', '2024-08-27 15:39:38'),
('dc7ac314-8708-11ef-812c-74563cac53f0', '70c92424-6446-11ef-9f47-74563cac53f0', 'ff85859beab4574ed8c5977daf192090ebab8b855bcb57c10230d6b800fd31a4', '2024-10-10 21:09:19', '2024-10-10 21:09:20'),
('f99ab2fc-6501-11ef-8dd1-74563cac53f0', '19c11e86-6094-11ef-a313-74563cac53f0', '63ada97183b161e0e258efb62c7d3964dd69f340351516718c46bc6d2660103a', '2024-08-28 13:54:22', '2024-08-29 10:58:14');

-- --------------------------------------------------------

--
-- Table structure for table `tb_lpj`
--

CREATE TABLE `tb_lpj` (
  `id_lpj` char(36) NOT NULL,
  `id_sppd` char(36) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `bukti` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`bukti`)),
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_lpj`
--

INSERT INTO `tb_lpj` (`id_lpj`, `id_sppd`, `tanggal`, `bukti`, `created_at`, `updated_at`) VALUES
('36a26d10-6445-11ef-b445-74563cac53f0', 'd977d73e-6213-11ef-bc9d-74563cac53f0', '2024-08-27', '[{\"bukti\":\"357dc416-6445-11ef-8bb4-74563cac53f0.png\"},{\"bukti\":\"34ff1c7e-6445-11ef-a7cc-74563cac53f0.png\"}]', '2024-08-27 15:23:10', '2024-08-27 15:23:10'),
('6e016e5a-656c-11ef-b7f6-74563cac53f0', 'aa74a5c8-6215-11ef-8920-74563cac53f0', '2024-08-29', '[{\"bukti\":\"6683176e-656c-11ef-ac27-74563cac53f0.png\"},{\"bukti\":\"6928051a-656c-11ef-8bdd-74563cac53f0.png\"},{\"bukti\":\"6d351c10-656c-11ef-8de7-74563cac53f0.png\"}]', '2024-08-29 02:36:24', '2024-08-29 02:36:24');

-- --------------------------------------------------------

--
-- Table structure for table `tb_notadinas`
--

CREATE TABLE `tb_notadinas` (
  `id_notadinas` char(36) NOT NULL,
  `id_user` char(36) NOT NULL,
  `no_surat` varchar(255) NOT NULL,
  `tujuan` varchar(255) NOT NULL,
  `perihal` text NOT NULL,
  `dasar_surat` varchar(255) NOT NULL,
  `maksud_tujuan` text NOT NULL,
  `tanggal_berangkat` date DEFAULT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `is_verify` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_notadinas`
--

INSERT INTO `tb_notadinas` (`id_notadinas`, `id_user`, `no_surat`, `tujuan`, `perihal`, `dasar_surat`, `maksud_tujuan`, `tanggal_berangkat`, `tanggal_kembali`, `is_verify`, `created_at`, `updated_at`) VALUES
('094c072c-617a-11ef-8c06-74563cac53f0', '03ca5c74-60ab-11ef-bdc7-74563cac53f0', '123/asdas/123445', 'banjarmasin', 'hal', '29e34e20-617d-11ef-9b04-74563cac53f0.png', 'Maksud 123', '2024-08-24', '2024-08-31', 1, '2024-08-24 02:03:44', '2024-08-24 02:26:08'),
('943e1cdc-6182-11ef-84ef-74563cac53f0', '19c11e86-6094-11ef-a313-74563cac53f0', '123/asdas/123445', 'banjarmasin', 'hal', '0', 'asdasd', '2024-08-23', '2024-08-31', 1, '2024-08-24 03:04:53', '2024-08-24 19:48:08'),
('ccc5ad30-6156-11ef-bb5c-74563cac53f0', '03ca5c74-60ab-11ef-bdc7-74563cac53f0', '123123123', '123123', '123123', '0', '123123', '2024-08-23', '2024-08-30', 1, '2024-08-23 21:51:30', '2024-08-23 21:51:30');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengeluaran`
--

CREATE TABLE `tb_pengeluaran` (
  `id_pengeluaran` char(36) NOT NULL,
  `id_sppd` char(36) NOT NULL,
  `pengeluaran` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`pengeluaran`)),
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pengeluaran`
--

INSERT INTO `tb_pengeluaran` (`id_pengeluaran`, `id_sppd`, `pengeluaran`, `created_at`, `updated_at`) VALUES
('2b62c672-62db-11ef-9b17-74563cac53f0', 'd977d73e-6213-11ef-bc9d-74563cac53f0', '[{\"keterangan\":\"bensin tambahan\",\"jumlah\":\"45000\"}]', '2024-08-25 20:11:33', '2024-08-25 20:11:33'),
('38f2cda0-62d6-11ef-8eca-74563cac53f0', 'd977d73e-6213-11ef-bc9d-74563cac53f0', '[{\"keterangan\":\"bensin tambahan\",\"jumlah\":\"45000\"},{\"keterangan\":\"tambah baru\",\"jumlah\":\"500000\"}]', '2024-08-25 19:36:08', '2024-08-25 19:36:08'),
('5db9dbfe-62e2-11ef-80e1-74563cac53f0', 'd977d73e-6213-11ef-bc9d-74563cac53f0', '[{\"keterangan\":\"asd\",\"jumlah\":\"50000\"},{\"keterangan\":\"ssds\",\"jumlah\":\"400000\"}]', '2024-08-25 21:03:04', '2024-08-25 21:03:04'),
('cfef656a-654c-11ef-b7ad-74563cac53f0', 'aa74a5c8-6215-11ef-8920-74563cac53f0', '[{\"keterangan\":\"Coba\",\"jumlah\":\"50000\"},{\"keterangan\":\"lagi dicoba\",\"jumlah\":\"900000\"},{\"keterangan\":\"ketiga\",\"jumlah\":\"25000\"}]', '2024-08-28 22:50:05', '2024-08-28 22:50:05');

-- --------------------------------------------------------

--
-- Table structure for table `tb_slider`
--

CREATE TABLE `tb_slider` (
  `id_slider` char(36) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_slider`
--

INSERT INTO `tb_slider` (`id_slider`, `judul`, `gambar`, `deskripsi`, `created_at`) VALUES
('0e0fe645-3ee6-4184-8d07-e8b8db2084aa', 'Kabah Slider 1a', '0e0fe645-3ee6-4184-8d07-e8b8db2084aa.png', 'lorem ipsum sit dolor amet 123', '0000-00-00 00:00:00'),
('77b4dd39-c0dc-4230-9664-99ce8dc3ebe7', 'Slider 2', '77b4dd39-c0dc-4230-9664-99ce8dc3ebe7.png', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt tempore qui fuga facilis sunt ullam atque ad est aliquam beatae ipsum alias, asperiores dolorem, tenetur a, suscipit possimus minima optio?\n            Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt tempore qui fuga facilis sunt ullam atque ad est aliquam beatae ipsum alias, asperiores dolorem, tenetur a, suscipit possimus minima optio?\n', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_sppd`
--

CREATE TABLE `tb_sppd` (
  `id_sppd` char(36) NOT NULL,
  `id_user` char(36) NOT NULL,
  `no_surat` varchar(255) NOT NULL,
  `tujuan` varchar(255) NOT NULL,
  `perihal` text NOT NULL,
  `dasar_surat` varchar(255) NOT NULL,
  `maksud_tujuan` text NOT NULL,
  `tanggal_berangkat` date DEFAULT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `is_verify` tinyint(1) NOT NULL,
  `is_done` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_sppd`
--

INSERT INTO `tb_sppd` (`id_sppd`, `id_user`, `no_surat`, `tujuan`, `perihal`, `dasar_surat`, `maksud_tujuan`, `tanggal_berangkat`, `tanggal_kembali`, `is_verify`, `is_done`, `created_at`, `updated_at`) VALUES
('aa74a5c8-6215-11ef-8920-74563cac53f0', '19c11e86-6094-11ef-a313-74563cac53f0', '123/asdas/123445', 'banjarmasin', 'hal', 'a693f328-6215-11ef-8258-74563cac53f0.png', 'asd', '2024-08-23', '2024-09-07', 1, 1, '2024-08-24 20:37:46', '2024-08-24 20:41:17'),
('d7333916-6572-11ef-b787-74563cac53f0', '70c92424-6446-11ef-9f47-74563cac53f0', '123/asdas/123445', 'asdad', 'asdasd', '0', 'asdasd', '2024-08-28', '2024-08-30', 1, 0, '2024-08-29 03:22:18', '2024-08-29 03:22:18'),
('d977d73e-6213-11ef-bc9d-74563cac53f0', '03ca5c74-60ab-11ef-bdc7-74563cac53f0', '123/SPPD/asd', 'banjarmasin', 'hal', 'd4def518-6213-11ef-a46e-74563cac53f0.png', 'asd', '2024-08-22', '2024-08-26', 1, 1, '2024-08-24 20:24:46', '2024-08-24 20:24:46');

-- --------------------------------------------------------

--
-- Table structure for table `tb_spt`
--

CREATE TABLE `tb_spt` (
  `id_spt` char(36) NOT NULL,
  `id_user` char(36) NOT NULL,
  `no_surat` varchar(255) NOT NULL,
  `tujuan` varchar(255) NOT NULL,
  `perihal` text NOT NULL,
  `dasar_surat` varchar(255) NOT NULL,
  `maksud_tujuan` text NOT NULL,
  `tanggal_berangkat` date DEFAULT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `is_verify` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_spt`
--

INSERT INTO `tb_spt` (`id_spt`, `id_user`, `no_surat`, `tujuan`, `perihal`, `dasar_surat`, `maksud_tujuan`, `tanggal_berangkat`, `tanggal_kembali`, `is_verify`, `created_at`, `updated_at`) VALUES
('eec92170-6217-11ef-bdce-74563cac53f0', '03ca5c74-60ab-11ef-bdc7-74563cac53f0', '123/SPPD/asd', 'banjarmasin', 'hal', '1b75b2c0-6217-11ef-8eaf-74563cac53f0.png', 'asd', '2024-08-24', '2024-08-31', 1, '2024-08-24 20:48:11', '2024-08-24 20:48:11'),
('eec92170-6217-11ef-bdce-74563cac53f7', '19c11e86-6094-11ef-a313-74563cac53f0', '123/SPT/asd', 'asd', 'asd', '0', 'asd', '2024-08-24', '2024-08-29', 1, '2024-08-24 20:54:00', '2024-08-27 18:51:06');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` char(36) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` char(64) NOT NULL,
  `nip` char(18) NOT NULL,
  `pangkat` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `bidang` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `roles` enum('user','admin') NOT NULL,
  `is_verify` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama`, `username`, `email`, `password`, `nip`, `pangkat`, `jabatan`, `bidang`, `alamat`, `roles`, `is_verify`, `created_at`, `updated_at`) VALUES
('19c11e86-6094-11ef-a313-74563cac53f0', 'Muhammad Ikhwan', 'admin123', 'admin@gmail.com', '9d81eb0ea4b00df8c0f047a65e00cee69b2be01afde6a4d1be4b16e875e1d305', '66666666666', 'Pangkat', 'Jabatan', 'Bidang', 'Alamat', 'admin', 1, NULL, '2024-08-27 15:40:45'),
('70c92424-6446-11ef-9f47-74563cac53f0', 'alzakaria', 'alzakaria', 'alzakaria14@gmail.com', 'ba0fe8de07c80743fb07a7579a31131a9dbc95fc9832cd9349aea32c899af18c', '123123', 'Pengatur Tingkat I / II d', 'Ketua Divisi', 'Perencanaan', 'Jl Paku Alam RT 03', 'user', 1, '2024-08-27 15:31:57', '2024-10-10 21:09:12'),
('bd392cda-f0de-11ef-bc42-00155d1a0868', 'Al Zakaria', 'alzakaria14', 'alzakaria@ruangkarya.net', 'ba0fe8de07c80743fb07a7579a31131a9dbc95fc9832cd9349aea32c899af18c', '123123', 'Pengatur Muda Tingkat I / II b', '123', 'Umum dan Kepegawaian', 'Jl. Sungai Bakung, No. 144, RT.004 RW.000 Kecamatan Sungai Tabuk', 'user', 0, '2025-02-22 13:34:51', '2025-02-22 13:34:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_anggaran`
--
ALTER TABLE `tb_anggaran`
  ADD PRIMARY KEY (`id_anggaran`);

--
-- Indexes for table `tb_kegiatan`
--
ALTER TABLE `tb_kegiatan`
  ADD PRIMARY KEY (`id_kegiatan`);

--
-- Indexes for table `tb_kwitansi`
--
ALTER TABLE `tb_kwitansi`
  ADD PRIMARY KEY (`id_kwitansi`);

--
-- Indexes for table `tb_login`
--
ALTER TABLE `tb_login`
  ADD PRIMARY KEY (`id_login`);

--
-- Indexes for table `tb_lpj`
--
ALTER TABLE `tb_lpj`
  ADD PRIMARY KEY (`id_lpj`);

--
-- Indexes for table `tb_notadinas`
--
ALTER TABLE `tb_notadinas`
  ADD PRIMARY KEY (`id_notadinas`);

--
-- Indexes for table `tb_pengeluaran`
--
ALTER TABLE `tb_pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`);

--
-- Indexes for table `tb_slider`
--
ALTER TABLE `tb_slider`
  ADD PRIMARY KEY (`id_slider`);

--
-- Indexes for table `tb_sppd`
--
ALTER TABLE `tb_sppd`
  ADD PRIMARY KEY (`id_sppd`);

--
-- Indexes for table `tb_spt`
--
ALTER TABLE `tb_spt`
  ADD PRIMARY KEY (`id_spt`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
