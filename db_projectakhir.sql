-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 27, 2024 at 05:08 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_projectakhir`
--
CREATE DATABASE IF NOT EXISTS `db_projectakhir` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `db_projectakhir`;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dokumen_kategoris`
--

CREATE TABLE `dokumen_kategoris` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dokumen_kategoris`
--

INSERT INTO `dokumen_kategoris` (`id`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Dokumen Kontrak Kegiatan', '2024-10-04 10:32:26', '2024-10-05 00:49:04'),
(2, 'Dokumen Kerjasama', '2024-10-05 00:49:29', '2024-10-05 00:49:29'),
(4, 'Dokumen Undangan', '2024-10-05 03:49:51', '2024-10-05 03:49:51');

-- --------------------------------------------------------

--
-- Table structure for table `dokumen_keluars`
--

CREATE TABLE `dokumen_keluars` (
  `id` bigint UNSIGNED NOT NULL,
  `no_dokumen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `perihal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `penerima` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `asal_dokumen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lampiran` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `instansi_id` bigint UNSIGNED NOT NULL,
  `dokumen_kategori_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dokumen_masuks`
--

CREATE TABLE `dokumen_masuks` (
  `id` bigint UNSIGNED NOT NULL,
  `no_dokumen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `perihal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `penerima` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `asal_dokumen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lampiran` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `instansi_id` bigint UNSIGNED NOT NULL,
  `dokumen_kategori_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dokumen_templates`
--

CREATE TABLE `dokumen_templates` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` json NOT NULL,
  `dokumen_kategori_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dokumen_templates`
--

INSERT INTO `dokumen_templates` (`id`, `nama`, `file`, `data`, `dokumen_kategori_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Template dokumen undangan', 'dokumen/template/Template_dokumen_undangan-1732723529.docx', '[\"TANGGAL\", \"PERIHAL\", \"PPK\", \"KETUA\", \"PIC\"]', 4, 6, '2024-11-27 09:05:34', '2024-11-27 09:05:34');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `instansis`
--

CREATE TABLE `instansis` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_instansi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `singkatan_instansi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `instansis`
--

INSERT INTO `instansis` (`id`, `nama_instansi`, `singkatan_instansi`, `alamat`, `created_at`, `updated_at`) VALUES
(4, 'Inspektorat', 'INSPEKTORAT', 'Jl. Veteran No.147, Nagri Kaler, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41115', '2024-10-05 02:54:10', '2024-10-05 02:54:10'),
(5, 'Sekertariat Daerah', 'SETDA', 'Jl. Gandanegara No.25, Nagri Kidul, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41111', '2024-10-05 02:58:58', '2024-10-05 02:58:58'),
(6, 'Dinas Pendidikan', 'DISDIK', 'Jl. Veteran No 1 Gang beringin Kel. Nagri Kaler, Kecamatan Purwakarta  Kabupaten Purwakarta Jawa Barat 41114', '2024-10-05 03:00:44', '2024-10-05 03:00:44'),
(7, 'Dinas Kesehatan', 'DINKES', 'Jl. Veteran No.60, Nagri Kaler, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41115, Indonesia', '2024-10-05 03:01:49', '2024-10-05 03:01:49'),
(8, 'Dinas Sosial Pemberdayaan Perempuan dan Perlindungan Anak', 'DINSOS', 'Jl. Taman Pahlawan No. 9, Purwamekar, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41119', '2024-10-05 03:03:17', '2024-10-05 03:03:17'),
(9, 'Satuan Polisi Pamong Praja', 'SATPOL PP', 'Gg. Wortel No.29, Nagri Tengah, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41111', '2024-10-05 03:06:11', '2024-10-05 03:06:11'),
(10, 'Dinas Ketenagakerjaan dan Transmigrasi', 'DISNAKER', 'Jl. Veteran No. 03, Ciseureuh, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41115, Indonesia', '2024-10-05 03:07:10', '2024-10-05 03:07:10'),
(11, 'Dinas Lingkungan Hidup', 'DLH', 'Jl. Taman Pahlawan, Purwamekar, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41119', '2024-10-05 03:08:42', '2024-10-05 03:15:51'),
(12, 'Dinas Kependudukan dan Pencatatan Sipil', 'DISDUKCAPIL', 'Jl. Mr. Dr. Kusuma Atmaja No. 8, Nagri Tengah, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41114, Indonesia', '2024-10-05 03:12:33', '2024-10-05 03:13:29'),
(13, 'Dinas Pengendalian Penduduk dan Keluarga Berencana', 'DPPKB', 'Jl. Taman Pahlawan, Purwamekar, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41119A', '2024-10-05 03:15:13', '2024-10-05 03:15:13'),
(14, 'Dinas Perhubungan', 'DISHUB', 'Jl. Veteran No.1, Ciseureuh, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41118, Indonesia', '2024-10-05 03:17:14', '2024-10-05 03:17:14'),
(15, 'Dinas Komunikasi dan Informatika', 'DISKOMINFO', 'Jl. Ganda Negara No.25, Nagri Kidul, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41111', '2024-10-05 03:18:26', '2024-10-05 03:18:26'),
(16, 'Dinas Koperasi Usaha Kecil dan Menengah Perdagangan dan Perindustrian', 'DISKOPRINDAG', 'Jl. Jend. Ahmad Yani No.170, Nagri Kaler, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41113', '2024-10-05 03:21:47', '2024-10-05 03:21:47'),
(17, 'Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu', 'DPMPTSP', 'Jl. Jendral Sudirman, Nagri Kaler, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41115', '2024-10-05 03:22:45', '2024-10-05 03:22:45'),
(18, 'Dinas Kepemudaan, Olahraga, Pariwisata, dan Kebudayaan', 'DISPORAPARBUD', 'Jl. Purnawarman Timur No.2, Sindangkasih, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41112, Indonesia', '2024-10-05 03:23:58', '2024-10-05 03:23:58'),
(19, 'Dinas Kearsipan dan Perpustakaan', 'ARSIP', 'JL Veteran, No. 01, Komplek Perum Griya Asri, Ciseureuh, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41118, Indonesia', '2024-10-05 03:24:49', '2024-10-05 03:24:49'),
(20, 'Dinas Pangan dan Pertanian', 'DISPANGTAN', 'Jl. Surawinata No.30, Nagri Kaler, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41114, Indonesia', '2024-10-05 03:26:08', '2024-10-05 03:26:08'),
(21, 'Dinas Perikanan dan Perternakan', 'DISKANAK', 'Jl. Suradireja No.28, Nagri Kaler, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41114', '2024-10-05 03:26:51', '2024-10-05 03:26:51'),
(22, 'Badan Perencanaan Pembangunan Penelitian dan Pengembangan Daerah', 'BAPELITBANGDA', 'Jl. Gandanegara No. 25, Kelurahan Nageri Kidul, Kecamatan Purwakarta, Kabupaten Purwakarta, Provinsi Jawa Barat. Kode Pos 41111', '2024-10-05 03:27:47', '2024-10-05 03:27:47'),
(23, 'Badan Keuangan dan Aset Daerah', 'BKAD', 'Jl. Gandanegara No.25, Nagri Kidul, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41111', '2024-10-05 03:28:21', '2024-10-05 03:28:21'),
(24, 'Badan Pendapatan Daerah', 'BAPENDA', 'Jl. Surawinata No.30A, Nagri Tengah, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41114, Indonesia', '2024-10-05 03:29:12', '2024-10-05 03:29:12'),
(25, 'Badan Kepegawaian dan Pengembangan Sumber Daya Manusia', 'BKPSDM', 'Jl. Veteran, Komplek Perum Hegarmanah Kel. Ciseureuh, Kec. Purwakarta, Kab. Purwakarta, Jawa Barat 41118', '2024-10-05 03:30:00', '2024-10-05 03:30:00'),
(26, 'Badan Penanggulangan Bencana Daerah', 'BPDB', 'Jl. Purnawarman Selatan, Sindangkasih, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41112', '2024-10-05 03:30:41', '2024-10-05 03:30:41'),
(27, 'Dinas Pekerjaan Umum dan Tata Ruang', 'DPUTR', 'Jalan K.K Singawinata No. 116, Nagri Kidul, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41111, Indonesia', '2024-10-05 03:31:32', '2024-10-05 03:31:32'),
(28, 'Dinas Pemadam Kebakaran dan Penyelematan', 'DAMKAR', 'Jl. Jend. Ahmed Yani No.113, Cipaisan, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41113, Indonesia', '2024-10-05 03:33:28', '2024-10-05 03:33:28'),
(29, 'Dinas Perumahan dan Kawasa Permukiman', 'DISTARKIM', 'Jl. Veteran No. 139, Nagri Kaler, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41115', '2024-10-05 03:34:49', '2024-10-05 03:34:49'),
(30, 'Badan Kesatuan Bangsa dan Politik', 'KESBANGPOL', 'Jl. Veteran No. 153 Purwakarta Kode Pos 41115', '2024-10-05 03:38:16', '2024-10-05 03:38:16'),
(31, 'Dinas Pemberdayaan Masyarakat dan Desa', 'DPMD', 'Jl. Purnawarman Timur No.8, Sindangkasih, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41112', '2024-10-05 03:39:07', '2024-10-05 03:39:07'),
(32, 'Sekertariat Dewan', 'SETWAN', 'Jl. Gandanegara No.25, Nagri Kidul, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41111, Indonesia', '2024-10-05 03:43:25', '2024-10-05 03:43:25'),
(33, 'RSUD Bayu Asih', 'BAYU ASIH', 'Jl. Veteran No.39, Nagri Kaler, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41115', '2024-10-05 03:46:42', '2024-10-05 03:46:42'),
(34, 'Badan Pusat Statistik', 'BPS', 'Jl. Baru, RT.031/RW.009, Maracang, Kec. Babakancikao, Kabupaten Purwakarta, Jawa Barat 41151, Indonesia', '2024-10-05 03:47:52', '2024-10-05 03:47:52'),
(35, 'Kecamatan Darangdan', 'Kecamatan Darangdan', 'JL. Raya Darangdan, KM 22, Tegalmunjul, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41116, Indonesia', '2024-10-05 03:48:39', '2024-10-05 03:48:39'),
(36, 'Kecamatan Cibatu', 'Kecamatan Cibatu', 'Kec. Cibatu, Kabupaten Purwakarta, Jawa Barat', '2024-10-05 03:55:45', '2024-10-05 03:55:45'),
(37, 'Kecamatan Campaka', 'Kecamatan Campaka', 'Jl. Raya No.17, Campaka, Kabupaten Purwakarta, Jawa Barat 41181, Indonesia', '2024-10-05 03:56:31', '2024-10-05 03:56:31'),
(38, 'Kecamatan Bungursari', 'Kecamatan Bungursari', 'Kec. Bungursari, Kabupaten Purwakarta, Jawa Barat', '2024-10-05 03:57:41', '2024-10-05 03:57:41'),
(39, 'Kecamatan Babakancikao', 'Kecamatan Babakancikao', 'Kecamatan Babakan Cikao, Purwakarta, Jawa Barat', '2024-10-05 03:58:53', '2024-10-05 03:58:53'),
(40, 'Kecamatan Sukasari', 'Kecamatan Sukasari', 'Jl. Sukasari, Sukasari, Purwasari, Kabupaten Karawang, Jawa Barat 41373, Indonesia', '2024-10-05 04:01:06', '2024-10-05 04:01:06'),
(41, 'Kecamatan Jatiluhur', 'Kecamatan Jatiluhur', 'Jl. Ir. H. Juanda, Jatiluhur, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41152, Indonesia', '2024-10-05 04:02:08', '2024-10-05 04:02:08'),
(42, 'Kecamatan Maniis', 'Kecamatan Maniis', 'Kec. Maniis, Kabupaten Purwakarta, Jawa Barat', '2024-10-05 04:04:05', '2024-10-05 04:04:05'),
(43, 'Kecamatan Tegalwaru', 'Kecamatan Tegalwaru', 'Jl. Cijati Warungjeruk, Sukahaji, Tegal Waru, Kabupaten Purwakarta, Jawa Barat 41165, Indonesia', '2024-10-05 04:04:34', '2024-10-05 04:04:34'),
(44, 'Kecamatan Plered', 'Kecamatan Plered', 'Jl. Raya Plered, Purwakarta, Sindangsari, Plered, Kabupaten Purwakarta, Jawa Barat 41162, Indonesia', '2024-10-05 04:05:48', '2024-10-05 04:05:48'),
(45, 'Kecamatan Sukatani', 'Kecamatan Sukatani', 'Jl. Raya Sukatani KM.11, Sukatani, Purwakarta, Kabupaten Purwakarta, Jawa Barat 41167, Indonesia', '2024-10-05 04:06:20', '2024-10-05 04:06:20'),
(46, 'Kecamatan Bojong', 'Kecamatan Bojong', 'Jl. Veteran No.146, Nagri Kaler, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41115, Indonesia', '2024-10-05 04:06:59', '2024-10-05 04:06:59'),
(47, 'Kecamatan Kiarapedes', 'Kecamatan Kiarapedes', 'Jl. Raya Kiarapedes Km. 28, Kabupaten Purwakarta, Jawa Barat', '2024-10-05 04:07:35', '2024-10-05 04:07:35'),
(48, 'Kecamatan Wanayasa', 'Kecamatan Wanayasa', 'Jl. Veteran No.146, Nagri Kaler, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41115, Indonesia', '2024-10-05 04:08:05', '2024-10-05 04:08:05'),
(49, 'Kecamatan Pondoksalam', 'Kecamatan Pondoksalam', 'Kec. Pondoksalam, Kabupaten Purwakarta, Jawa Barat', '2024-10-05 04:08:52', '2024-10-05 04:08:52'),
(50, 'Kecamatan Pasawahan', 'Kecamatan Pasawahan', 'Pasawahan, Kec. Pasawahan, Kabupaten Purwakarta, Jawa Barat 41172, Indonesia', '2024-10-05 04:09:46', '2024-10-05 04:09:46'),
(51, 'Kecamatan Purwakarta', 'Kecamatan Purwakarta', 'Jalan Veteran, Purwakarta, Jawa Barat, Indonesia', '2024-10-05 04:11:45', '2024-10-05 04:11:45'),
(52, 'Kecamatan Nagri Kidul', 'Kecamatan Nagri Kidul', 'Jl. Gandanegara No. 25, Kelurahan Nageri Kidul, Kecamatan Purwakarta, Kabupaten Purwakarta, Provinsi Jawa Barat 41111.', '2024-10-05 04:12:31', '2024-10-05 04:12:31'),
(53, 'Kecamatan Nagri Kaler', 'Kecamatan Nagri Kaler', 'Jalan Veteran No.7, Purwakarta, Jawa Barat 41115, Indonesia', '2024-10-05 04:13:01', '2024-10-05 04:13:01'),
(54, 'Kecamatan Nagri Tengah', 'Kecamatan Nagri Tengah', 'Jalan Hidayat Martalogawa No 16 (Tegal Tulang), Purwakarta, Jawa Barat, Indonesia', '2024-10-05 04:13:50', '2024-10-05 04:13:50'),
(55, 'Kecamatan Sindangkasih', 'Kecamatan Sindangkasih', 'Jalan Basuki Rahmat No. 34-36, Sindangkasih, Kecamatan Purwakarta, Kabupaten Purwakarta, Jawa Barat 41112, Indonesia', '2024-10-05 04:14:21', '2024-10-05 04:14:21'),
(56, 'Kecamatan Cipaisan', 'Kecamatan Cipaisan', 'Jl. Ahmad yani (CIPAISAN), Purwakarta, Jawa Barat, Indonesia', '2024-10-05 04:15:01', '2024-10-05 04:15:01'),
(57, 'Kecamatan Purwamekar', 'Kecamatan Purwamekar', 'alan Mekarsari I No.33, Purwamekar, Kecamatan Purwakarta, Purwamekar, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41114, Indonesia', '2024-10-05 04:15:41', '2024-10-05 04:15:41'),
(58, 'Kecamatan Cisereuh', 'Kecamatan Cisereuh', 'Ciseureuh, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat', '2024-10-05 04:16:47', '2024-10-05 04:16:47'),
(59, 'Kecamatan Tegalmunjul', 'Kecamatan Tegalmunjul', 'Tegalmunjul, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat', '2024-10-05 04:17:59', '2024-10-05 04:17:59'),
(60, 'Kecamatan Munjuljaya', 'Kecamatan Munjuljaya', 'Munjuljaya, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat', '2024-10-10 19:33:38', '2024-10-10 19:33:38'),
(61, 'Puskesmas Purwakarta', 'Puskesmas Purwakarta', 'Jl. Siliwangi No.3, Nagri Kidul, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41117', '2024-10-10 19:38:07', '2024-10-10 19:38:07'),
(62, 'Puskesmas Munjuljaya', 'Puskesmas Munjuljaya', 'Ipik gandamanah, Purwakarta, Jawa Barat, Indonesia', '2024-10-10 19:39:06', '2024-10-10 19:39:06'),
(63, 'Puskesmas Koncara', 'Puskesmas Koncara', 'Jalan Ibrahim Singadilaga No. 60, Purwamekar, Kecamatan Purwakarta, Nagri Kaler, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41119, Indonesia', '2024-10-10 19:40:14', '2024-10-10 19:40:14'),
(64, 'Puskesmas Campaka', 'Puskesmas Campaka', 'Jl. Raya Campaka, Campaka, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41181, Indonesia', '2024-10-10 19:41:40', '2024-10-10 19:41:40'),
(65, 'Puskesmas Jatiluhur', 'Puskesmas Jatiluhur', 'JL. Ir. H. Juanda No. 73, Kec. Jatiluhur, Kab. Purwakarta Purwakarta, Jawa Barat, Indonesia', '2024-10-10 19:42:56', '2024-10-10 19:42:56'),
(66, 'Puskesmas Plered', 'Puskesmas Plered', 'Jl. Raya Plered, Sindangsari, Kec. Plered, Kabupaten Purwakarta, Jawa Barat 41162', '2024-10-10 19:47:01', '2024-10-10 19:47:01'),
(67, 'Puskesmas Sukatani', 'Puskesmas Sukatani', 'Jalan Raya Sukatani KM.12 (Samping Polsek Sukatani), Purwakarta, Jawa Barat, Indonesia', '2024-10-10 19:48:41', '2024-10-10 19:48:41'),
(68, 'Puskesmas Darangdan', 'Puskesmas Darangdan', 'Jl.Darangdan No.80, Purwakarta, Jawa Barat, Indonesia', '2024-10-10 19:49:20', '2024-10-10 19:49:20'),
(69, 'Puskesmas Maniis', 'Puskesmas Maniis', 'Maniis (Jl Raya Palumbon), Purwakarta, Jawa Barat, Indonesia', '2024-10-10 19:49:48', '2024-10-10 19:49:48'),
(70, 'Puskesmas Tegalwaru', 'Puskesmas Tegalwaru', 'Batutumpang, Purwakarta, Jawa Barat, Indonesia', '2024-10-10 19:50:22', '2024-10-10 19:50:22'),
(71, 'Puskesmas Wanayasa', 'Puskesmas Wanayasa', 'Jl. Raya Wanayasa No. 28, Kec. Wanayasa, Purwakarta Purwakarta, Jawa Barat, Indonesia 41174', '2024-10-10 19:51:01', '2024-10-10 19:51:01'),
(72, 'Puskesmas Pasawahan', 'Puskesmas Pasawahan', 'Jalan Terusan Kapten Halim No.105, Sawah Kulon, Pasawahan, Sawah Kulon, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41172, Indonesia', '2024-10-10 19:51:46', '2024-10-10 19:51:46'),
(73, 'Puskesmas Bojong', 'Puskesmas Bojong', 'Jalan Raya Bojong Kab. Purwakarta, Jawa Barat', '2024-10-10 19:52:53', '2024-10-10 19:52:53'),
(74, 'Puskesmas Maracang', 'Puskesmas Maracang', 'Jl. Kopi, Maracang, Kec. Babakancikao, Kabupaten Purwakarta, Jawa Barat 41151, Indonesia', '2024-10-10 19:53:24', '2024-10-10 19:53:24'),
(75, 'Puskesmas Mulyamekar', 'Puskesmas Mulyamekar', 'Jl. Veteran No. 246, Kec. Purwakarta, Kab. Purwakarta Purwakarta, Jawa Barat, Indonesia 41118', '2024-10-10 19:55:00', '2024-10-10 19:55:00'),
(76, 'Puskesmas Bungursari', 'Puskesmas Bungursari', 'Jl. Raya Bungursari No. 124, Kec. Bungursari, Purwakarta Purwakarta, Jawa Barat, Indonesia', '2024-10-10 19:57:58', '2024-10-10 19:57:58'),
(77, 'Puskesmas Cibatu', 'Puskesmas Cibatu', 'Jl. Raya Cibatu Km. 15, Kec. Cibatu, Kab. Purwakarta Purwakarta, Jawa Barat, Indonesia 41181', '2024-10-10 19:58:59', '2024-10-10 19:58:59'),
(78, 'Puskesmas Sukasari', 'Puskesmas Sukasari', 'Kec.Sukasari ,Purwakarta Kab Purwakarta, Jawa Barat', '2024-10-10 20:02:01', '2024-10-10 20:02:01'),
(79, 'Puskesmas Pondoksalam', 'Puskesmas Pondoksalam', 'Jl. Raya Terusan Kapten Halim, Kec. Pondok Salam, Purwakarta Purwakarta, Jawa Barat, Indonesia 41115', '2024-10-10 20:02:29', '2024-10-10 20:02:29'),
(80, 'Puskesmas Kiarapedes', 'Puskesmas Kiarapedes', 'Jl. Raya Kiarapedes Km. 24, Kec. Kiarapedes, Purwakarta Purwakarta, Jawa Barat, Indonesia 41175', '2024-10-10 20:02:59', '2024-10-10 20:02:59');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(19, '0001_01_01_000000_create_users_table', 1),
(20, '0001_01_01_000001_create_cache_table', 1),
(21, '0001_01_01_000002_create_jobs_table', 1),
(22, '2024_10_03_140458_create_dokumen_kategoris_table', 1),
(23, '2024_10_03_140846_create_instansis_table', 1),
(24, '2024_10_03_141234_create_dokumen_masuks_table', 1),
(25, '2024_10_03_141238_create_dokumen_keluars_table', 1),
(26, '2024_10_28_134747_create_pdf_documents_table', 2),
(27, '2024_11_02_073126_create_dokumen_templates_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pdf_documents`
--

CREATE TABLE `pdf_documents` (
  `id` bigint UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci,
  `content` text COLLATE utf8mb4_unicode_ci,
  `file_name` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('5xtVwKdMVGZkntba2MdW7bVaiVh38UQVCTXfoeRR', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36 Edg/129.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZFFla3E0cmxhRTZJUE1FeEV4eFVMQjN0NUduSnluRjVVSURxNjJrZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9rZWxvbGFfaW5zdGFuc2kiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo2O30=', 1728654890),
('Q3ej6fQB79S15131gZiiaUUGeezYzJXPNbP1QKlX', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiMWhndkYzSkhMMnc0N2Mzcmc4S1pWUHl5alZQTEQwTUpBeTJhelZNbyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi90ZW1wbGF0ZV9kb2t1bWVuL2xpaGF0LzEiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo2O3M6MzoiX3R0IjthOjA6e31zOjIyOiJQSFBERUJVR0JBUl9TVEFDS19EQVRBIjthOjA6e319', 1732724570);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','pimpinan') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `photo_path`, `remember_token`, `created_at`, `updated_at`) VALUES
(6, 'Byul', 'admin123@gmail.com', NULL, '$2y$12$GdO2plEoAy/.eaMMYKNkteO1/WmwRwbMZYFoaOxaWaymWpG07Snja', 'admin', 'foto_profil/2anuS4MfguW385RGnQzuB4ko6zumhTw0UqhL2igT.jpg', NULL, '2024-10-05 00:32:24', '2024-10-05 00:53:10'),
(7, 'testpim', 'pimpinan123@gmail.com', NULL, '$2y$12$vY/lYbnhbJVYzNAtyoFHSugWo228Z1zh7FOxSgQrTmjzpByHCIWwe', 'pimpinan', NULL, NULL, '2024-10-05 00:32:24', '2024-10-05 00:32:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `dokumen_kategoris`
--
ALTER TABLE `dokumen_kategoris`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dokumen_keluars`
--
ALTER TABLE `dokumen_keluars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dokumen_keluars_instansi_id_foreign` (`instansi_id`),
  ADD KEY `dokumen_keluars_dokumen_kategori_id_foreign` (`dokumen_kategori_id`),
  ADD KEY `dokumen_keluars_user_id_foreign` (`user_id`);

--
-- Indexes for table `dokumen_masuks`
--
ALTER TABLE `dokumen_masuks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dokumen_masuks_instansi_id_foreign` (`instansi_id`),
  ADD KEY `dokumen_masuks_dokumen_kategori_id_foreign` (`dokumen_kategori_id`),
  ADD KEY `dokumen_masuks_user_id_foreign` (`user_id`);

--
-- Indexes for table `dokumen_templates`
--
ALTER TABLE `dokumen_templates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dokumen_templates_dokumen_kategori_id_foreign` (`dokumen_kategori_id`),
  ADD KEY `dokumen_templates_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `instansis`
--
ALTER TABLE `instansis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pdf_documents`
--
ALTER TABLE `pdf_documents`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `pdf_documents` ADD FULLTEXT KEY `pdf_documents_title_fulltext` (`title`);
ALTER TABLE `pdf_documents` ADD FULLTEXT KEY `pdf_documents_content_fulltext` (`content`);
ALTER TABLE `pdf_documents` ADD FULLTEXT KEY `pdf_documents_title_content_fulltext` (`title`,`content`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dokumen_kategoris`
--
ALTER TABLE `dokumen_kategoris`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dokumen_keluars`
--
ALTER TABLE `dokumen_keluars`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dokumen_masuks`
--
ALTER TABLE `dokumen_masuks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dokumen_templates`
--
ALTER TABLE `dokumen_templates`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `instansis`
--
ALTER TABLE `instansis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `pdf_documents`
--
ALTER TABLE `pdf_documents`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dokumen_keluars`
--
ALTER TABLE `dokumen_keluars`
  ADD CONSTRAINT `dokumen_keluars_dokumen_kategori_id_foreign` FOREIGN KEY (`dokumen_kategori_id`) REFERENCES `dokumen_kategoris` (`id`),
  ADD CONSTRAINT `dokumen_keluars_instansi_id_foreign` FOREIGN KEY (`instansi_id`) REFERENCES `instansis` (`id`),
  ADD CONSTRAINT `dokumen_keluars_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `dokumen_masuks`
--
ALTER TABLE `dokumen_masuks`
  ADD CONSTRAINT `dokumen_masuks_dokumen_kategori_id_foreign` FOREIGN KEY (`dokumen_kategori_id`) REFERENCES `dokumen_kategoris` (`id`),
  ADD CONSTRAINT `dokumen_masuks_instansi_id_foreign` FOREIGN KEY (`instansi_id`) REFERENCES `instansis` (`id`),
  ADD CONSTRAINT `dokumen_masuks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `dokumen_templates`
--
ALTER TABLE `dokumen_templates`
  ADD CONSTRAINT `dokumen_templates_dokumen_kategori_id_foreign` FOREIGN KEY (`dokumen_kategori_id`) REFERENCES `dokumen_kategoris` (`id`),
  ADD CONSTRAINT `dokumen_templates_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
