-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 18, 2025 at 12:47 PM
-- Server version: 11.7.2-MariaDB
-- PHP Version: 8.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `earsip_pst`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dokumen_kategoris`
--

CREATE TABLE `dokumen_kategoris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nomor_surat` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dokumen_kategoris`
--

INSERT INTO `dokumen_kategoris` (`id`, `nama_kategori`, `created_at`, `updated_at`, `nomor_surat`, `deleted_at`) VALUES
(1, 'Surat MOU', '2025-03-07 09:38:36', '2025-03-18 05:24:11', 'PST-MOU/11', '2025-03-18 05:24:11'),
(2, 'Dokumen', '2025-03-07 09:54:46', '2025-03-07 09:54:46', 'PST-DOC/07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dokumen_keluars`
--

CREATE TABLE `dokumen_keluars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_dokumen` varchar(255) NOT NULL,
  `penerima` varchar(255) NOT NULL,
  `lampiran` varchar(255) NOT NULL,
  `status` enum('Menunggu Persetujuan','Disetujui','Ditolak','Menunggu Dikirim','Dikirimkan','Selesai') NOT NULL DEFAULT 'Menunggu Persetujuan',
  `keterangan` varchar(255) DEFAULT NULL,
  `persetujuan` enum('ya','tidak') NOT NULL DEFAULT 'tidak',
  `tanggal_keluar` date NOT NULL,
  `bukti_dikirimkan` varchar(255) DEFAULT NULL,
  `instansi_id` bigint(20) UNSIGNED DEFAULT NULL,
  `dokumen_kategori_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `pdf_content` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nomor_surat` varchar(255) DEFAULT NULL,
  `nomor_urut` varchar(255) DEFAULT NULL,
  `sifat_dokumen` tinyint(1) NOT NULL DEFAULT 0,
  `disetujui` tinyint(4) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dokumen_keluars`
--

INSERT INTO `dokumen_keluars` (`id`, `nama_dokumen`, `penerima`, `lampiran`, `status`, `keterangan`, `persetujuan`, `tanggal_keluar`, `bukti_dikirimkan`, `instansi_id`, `dokumen_kategori_id`, `user_id`, `pdf_content`, `created_at`, `updated_at`, `nomor_surat`, `nomor_urut`, `sifat_dokumen`, `disetujui`, `deleted_at`) VALUES
(1, 'testat', 'tetst', 'dokumen/keluar/testat_08032025_002321.pdf', 'Dikirimkan', 'teasr', 'tidak', '2025-03-08', NULL, 11, 2, 6, 'PT PRATAMA SOLUSI TEKNOLOGI\nIntegrated and IT Solution\n\nJl Rusa 1 No 57 Nagri Kidul Kec Purwakarta Kab Purwakarta Jawa Barat 41111\nTelpHp 62 85156562493 Email  Office PratamatechsolutioncoId\nWebsite  HttpsWwwPratamatechsolutionCoId\n\nPurwakarta 20250308\nNomor\nHal\n\n PSTDOC07001III2025\n teasda\n\nKepada Yth\n1 PPK teasdaw\n2 KETUA tstat\n3 PIC Tim Pengembangan teasd\n\nHormat kami\nPT Pratama Solusi Teknologi\n\nGagas Sangga Pratama SKom\nDirektur', '2025-03-07 10:23:22', '2025-03-08 09:04:36', 'PST-DOC/07.001/III/2025', '001', 0, 2, NULL),
(2, 'dawdwadawdwa', 'tesdadwad', 'dokumen/keluar/dawdwadawdwa_08032025_013558.pdf', 'Dikirimkan', NULL, 'tidak', '2025-03-08', NULL, 19, 2, 6, 'PT PRATAMA SOLUSI TEKNOLOGI\nIntegrated and IT Solution\n\nJl Rusa 1 No 57 Nagri Kidul Kec Purwakarta Kab Purwakarta Jawa Barat 41111\nTelpHp 62 85156562493 Email  Office PratamatechsolutioncoId\nWebsite  HttpsWwwPratamatechsolutionCoId\n\nPurwakarta 20250308\nNomor\nHal\n\n PSTDOC07002III2025\n hahjahjha\n\nKepada Yth\n1 PPK hdajkhdwajk\n2 KETUA djakwdjaiwh\n3 PIC Tim Pengembangan hdkawhdajkw\n\nHormat kami\nPT Pratama Solusi Teknologi\n\nGagas Sangga Pratama SKom\nDirektur', '2025-03-07 10:56:11', '2025-03-08 09:01:07', 'PST-DOC/07.002/III/2025', '002', 0, 2, NULL),
(3, 'test barcode', 'Kabid', 'dokumen/keluar/test_barcode_08032025_232235.pdf', 'Dikirimkan', NULL, 'tidak', '2025-03-09', NULL, 10, 2, 6, 'PT PRATAMA SOLUSI TEKNOLOGI\nIntegrated and IT Solution\n\nJl Rusa 1 No 57 Nagri Kidul Kec Purwakarta Kab Purwakarta Jawa Barat 41111\nTelpHp 62 85156562493 Email  Office PratamatechsolutioncoId\nWebsite  HttpsWwwPratamatechsolutionCoId\n\nPurwakarta 20250309\nNomor\nHal\n\n PSTDOC07003III2025\n tesadaw\n\nKepada Yth\n1 PPK tesada\n2 KETUA testa\n3 PIC Tim Pengembangan testst\nKONTEN\nHormat kami\nPT Pratama Solusi Teknologi\n\nGagas Sangga Pratama SKom\nDirektur', '2025-03-08 09:22:48', '2025-03-08 09:29:37', 'PST-DOC/07.003/III/2025', '003', 1, 2, NULL),
(4, 'Ut perspiciatis vit', 'Repellendus Volupta', 'dokumen/keluar/Ut_perspiciatis_vit_09032025_225803.pdf', 'Dikirimkan', 'Distinctio Sint co', 'tidak', '1971-06-28', NULL, 53, 1, 6, 'PT PRATAMA SOLUSI TEKNOLOGI\nIntegrated and IT Solution\n\nJl Rusa 1 No 57 Nagri Kidul Kec Purwakarta Kab Purwakarta Jawa Barat 41111\nTelpHp 62 85156562493 Email  Office PratamatechsolutioncoId\nWebsite  HttpsWwwPratamatechsolutionCoId\n\nPurwakarta 20250310\nNomor\nHal\n\n PSTMOU11001III2025\n Velit magnam nisi fu\n\nKepada Yth\n1 PPK Elit aut velit volu\n2 KETUA Ea sequi provident\n3 PIC Tim Pengembangan Velit error ullamco\nKONTEN\nHormat kami\nPT Pratama Solusi Teknologi\n\nGagas Sangga Pratama SKom\nDirektur', '2025-03-09 08:58:13', '2025-03-18 04:41:05', 'PST-MOU/11.001/III/2025', '001', 0, 2, '2025-03-18 04:41:05'),
(5, 'Animi officiis perf', 'Amet aliqua Ad iru', 'dokumen/keluar/Animi_officiis_perf_09032025_232448.pdf', 'Dikirimkan', 'Ut debitis sint et e', 'tidak', '2016-02-21', NULL, 16, 2, 6, 'PT PRATAMA SOLUSI TEKNOLOGI\nIntegrated and IT Solution\n\nJl Rusa 1 No 57 Nagri Kidul Kec Purwakarta Kab Purwakarta Jawa Barat 41111\nTelpHp 62 85156562493 Email  Office PratamatechsolutioncoId\nWebsite  HttpsWwwPratamatechsolutionCoId\n\nPurwakarta 20250303\nNomor\nHal\n\n PSTDOC07004III2025\n dawdacadaax\n\nKepada Yth\n1 PPK zxczxccasdqavacf\n2 KETUA czcasdadwdq\n3 PIC Tim Pengembangan czsdadq\nKONTEN\nHormat kami\nPT Pratama Solusi Teknologi\n\nGagas Sangga Pratama SKom\nDirektur', '2025-03-09 09:24:58', '2025-03-18 04:42:24', 'PST-DOC/07.004/III/2025', '004', 0, 2, '2025-03-18 04:42:24'),
(6, 'da dsad sdawd', 'test', 'dokumen/keluar/da_dsad_sdawd_10032025_034722.pdf', 'Dikirimkan', NULL, 'tidak', '2025-03-10', NULL, 7, 2, 6, 'PT PRATAMA SOLUSI TEKNOLOGI\nIntegrated and IT Solution\n\nJl Rusa 1 No 57 Nagri Kidul Kec Purwakarta Kab Purwakarta Jawa Barat 41111\nTelpHp 62 85156562493 Email  Office PratamatechsolutioncoId\nWebsite  HttpsWwwPratamatechsolutionCoId\n\nPurwakarta 20250310\nNomor\nHal\n\n PSTDOC07005III2025\n dawdawd\n\nKepada Yth\n1 PPK dawd\n2 KETUA zxczxc\n3 PIC Tim Pengembangan 213e\nKONTEN\nHormat kami\nPT Pratama Solusi Teknologi\n\nGagas Sangga Pratama SKom\nDirektur', '2025-03-09 13:47:36', '2025-03-09 13:48:38', 'PST-DOC/07.005/III/2025', '005', 1, 2, NULL),
(7, 'tsadafa dadwad', 'Testad', 'dokumen/keluar/tsadafa_dadwad_17032025_235604.pdf', 'Dikirimkan', NULL, 'tidak', '2025-03-17', NULL, 13, 2, 6, 'PT PRATAMA SOLUSI TEKNOLOGI\nIntegrated and IT Solution\n\nJl Rusa 1 No 57 Nagri Kidul Kec Purwakarta Kab Purwakarta Jawa Barat 41111\nTelpHp 62 85156562493 Email  Office PratamatechsolutioncoId\nWebsite  HttpsWwwPratamatechsolutionCoId\n\nPurwakarta 20250317\nNomor\nHal\n\n PSTDOC07006III2025\n dwdawda\n\nKepada Yth\n1 PPK dadaw\n2 KETUA dawdaw\n3 PIC Tim Pengembangan adzcasd\nKONTEN\nHormat kami\nPT Pratama Solusi Teknologi\n\nGagas Sangga Pratama SKom\nDirektur', '2025-03-17 09:56:16', '2025-03-17 10:07:44', 'PST-DOC/07.006/III/2025', '006', 1, 2, NULL),
(8, 'weSdasdwd', 'gadawdwae', 'dokumen/keluar/weSdasdwd_18032025_000500.pdf', 'Dikirimkan', NULL, 'tidak', '2025-03-18', NULL, 5, 2, 6, 'PT PRATAMA SOLUSI TEKNOLOGI\nIntegrated and IT Solution\n\nJl Rusa 1 No 57 Nagri Kidul Kec Purwakarta Kab Purwakarta Jawa Barat 41111\nTelpHp 62 85156562493 Email  Office PratamatechsolutioncoId\nWebsite  HttpsWwwPratamatechsolutionCoId\n\nPurwakarta 20250318\nNomor\nHal\n\n PSTDOC07007III2025\n dawedeawdzc\n\nKepada Yth\n1 PPK dasdcacdz\n2 KETUA dzcdcdqe2\n3 PIC Tim Pengembangan zcsdcqeqwe\nKONTEN\nHormat kami\nPT Pratama Solusi Teknologi\n\nGagas Sangga Pratama SKom\nDirektur', '2025-03-17 10:05:11', '2025-03-17 19:35:47', 'PST-DOC/07.007/III/2025', '007', 0, 2, NULL),
(9, 'totos', 'tatas', 'dokumen/keluar/totos_18032025_023242.pdf', 'Dikirimkan', NULL, 'tidak', '2025-03-18', NULL, 12, 2, 6, 'PT PRATAMA SOLUSI TEKNOLOGI\nIntegrated and IT Solution\n\nJl Rusa 1 No 57 Nagri Kidul Kec Purwakarta Kab Purwakarta Jawa Barat 41111\nTelpHp 62 85156562493 Email  Office PratamatechsolutioncoId\nWebsite  HttpsWwwPratamatechsolutionCoId\n\nPurwakarta 20250318\nNomor\nHal\n\n PSTDOC07008III2025\n dhajdh\n\nKepada Yth\n1 PPK hkdjahw dawhdawd\n2 KETUA hwaj hdjkaw\n3 PIC Tim Pengembangan dw hadjk hawd\nKONTEN\nHormat kami\nPT Pratama Solusi Teknologi\n\nGagas Sangga Pratama SKom\nDirektur', '2025-03-17 19:32:53', '2025-03-17 19:35:55', 'PST-DOC/07.008/III/2025', '008', 1, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dokumen_masuks`
--

CREATE TABLE `dokumen_masuks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_dokumen` varchar(255) NOT NULL,
  `penerima` varchar(255) NOT NULL,
  `pengirim` varchar(255) NOT NULL,
  `lampiran` varchar(255) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `instansi_id` bigint(20) UNSIGNED DEFAULT NULL,
  `dokumen_kategori_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `pdf_content` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dokumen_templates`
--

CREATE TABLE `dokumen_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`data`)),
  `dokumen_kategori_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dokumen_templates`
--

INSERT INTO `dokumen_templates` (`id`, `nama`, `file`, `data`, `dokumen_kategori_id`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Template Dokumen', 'dokumen/template/Template_Dokumen-1741450445.docx', '[\"TANGGAL\",\"NOMOR_SURAT\",\"PERIHAL\",\"PPK\",\"KETUA\",\"PIC\"]', 2, 6, '2025-03-07 09:56:12', '2025-03-18 05:29:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `instansis`
--

CREATE TABLE `instansis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_instansi` varchar(255) NOT NULL,
  `singkatan_instansi` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `instansis`
--

INSERT INTO `instansis` (`id`, `nama_instansi`, `singkatan_instansi`, `alamat`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 'Inspektorat', 'INSPEKTORAT', 'Jl. Veteran No.147, Nagri Kaler, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41115', '2024-10-04 19:54:10', '2024-10-04 19:54:10', NULL),
(5, 'Sekertariat Daerah', 'SETDA', 'Jl. Gandanegara No.25, Nagri Kidul, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41111', '2024-10-04 19:58:58', '2024-10-04 19:58:58', NULL),
(6, 'Dinas Pendidikan', 'DISDIK', 'Jl. Veteran No 1 Gang beringin Kel. Nagri Kaler, Kecamatan Purwakarta  Kabupaten Purwakarta Jawa Barat 41114', '2024-10-04 20:00:44', '2025-03-18 05:37:30', NULL),
(7, 'Dinas Kesehatan', 'DINKES', 'Jl. Veteran No.60, Nagri Kaler, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41115, Indonesia', '2024-10-04 20:01:49', '2024-10-04 20:01:49', NULL),
(8, 'Dinas Sosial Pemberdayaan Perempuan dan Perlindungan Anak', 'DINSOS', 'Jl. Taman Pahlawan No. 9, Purwamekar, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41119', '2024-10-04 20:03:17', '2024-10-04 20:03:17', NULL),
(9, 'Satuan Polisi Pamong Praja', 'SATPOL PP', 'Gg. Wortel No.29, Nagri Tengah, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41111', '2024-10-04 20:06:11', '2024-10-04 20:06:11', NULL),
(10, 'Dinas Ketenagakerjaan dan Transmigrasi', 'DISNAKER', 'Jl. Veteran No. 03, Ciseureuh, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41115, Indonesia', '2024-10-04 20:07:10', '2024-10-04 20:07:10', NULL),
(11, 'Dinas Lingkungan Hidup', 'DLH', 'Jl. Taman Pahlawan, Purwamekar, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41119', '2024-10-04 20:08:42', '2024-10-04 20:15:51', NULL),
(12, 'Dinas Kependudukan dan Pencatatan Sipil', 'DISDUKCAPIL', 'Jl. Mr. Dr. Kusuma Atmaja No. 8, Nagri Tengah, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41114, Indonesia', '2024-10-04 20:12:33', '2024-10-04 20:13:29', NULL),
(13, 'Dinas Pengendalian Penduduk dan Keluarga Berencana', 'DPPKB', 'Jl. Taman Pahlawan, Purwamekar, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41119A', '2024-10-04 20:15:13', '2024-10-04 20:15:13', NULL),
(14, 'Dinas Perhubungan', 'DISHUB', 'Jl. Veteran No.1, Ciseureuh, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41118, Indonesia', '2024-10-04 20:17:14', '2024-10-04 20:17:14', NULL),
(15, 'Dinas Komunikasi dan Informatika', 'DISKOMINFO', 'Jl. Ganda Negara No.25, Nagri Kidul, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41111', '2024-10-04 20:18:26', '2024-10-04 20:18:26', NULL),
(16, 'Dinas Koperasi Usaha Kecil dan Menengah Perdagangan dan Perindustrian', 'DISKOPRINDAG', 'Jl. Jend. Ahmad Yani No.170, Nagri Kaler, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41113', '2024-10-04 20:21:47', '2024-10-04 20:21:47', NULL),
(17, 'Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu', 'DPMPTSP', 'Jl. Jendral Sudirman, Nagri Kaler, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41115', '2024-10-04 20:22:45', '2024-10-04 20:22:45', NULL),
(18, 'Dinas Kepemudaan, Olahraga, Pariwisata, dan Kebudayaan', 'DISPORAPARBUD', 'Jl. Purnawarman Timur No.2, Sindangkasih, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41112, Indonesia', '2024-10-04 20:23:58', '2024-10-04 20:23:58', NULL),
(19, 'Dinas Kearsipan dan Perpustakaan', 'ARSIP', 'JL Veteran, No. 01, Komplek Perum Griya Asri, Ciseureuh, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41118, Indonesia', '2024-10-04 20:24:49', '2024-10-04 20:24:49', NULL),
(20, 'Dinas Pangan dan Pertanian', 'DISPANGTAN', 'Jl. Surawinata No.30, Nagri Kaler, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41114, Indonesia', '2024-10-04 20:26:08', '2024-10-04 20:26:08', NULL),
(21, 'Dinas Perikanan dan Perternakan', 'DISKANAK', 'Jl. Suradireja No.28, Nagri Kaler, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41114', '2024-10-04 20:26:51', '2024-10-04 20:26:51', NULL),
(22, 'Badan Perencanaan Pembangunan Penelitian dan Pengembangan Daerah', 'BAPELITBANGDA', 'Jl. Gandanegara No. 25, Kelurahan Nageri Kidul, Kecamatan Purwakarta, Kabupaten Purwakarta, Provinsi Jawa Barat. Kode Pos 41111', '2024-10-04 20:27:47', '2024-10-04 20:27:47', NULL),
(23, 'Badan Keuangan dan Aset Daerah', 'BKAD', 'Jl. Gandanegara No.25, Nagri Kidul, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41111', '2024-10-04 20:28:21', '2024-10-04 20:28:21', NULL),
(24, 'Badan Pendapatan Daerah', 'BAPENDA', 'Jl. Surawinata No.30A, Nagri Tengah, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41114, Indonesia', '2024-10-04 20:29:12', '2024-10-04 20:29:12', NULL),
(25, 'Badan Kepegawaian dan Pengembangan Sumber Daya Manusia', 'BKPSDM', 'Jl. Veteran, Komplek Perum Hegarmanah Kel. Ciseureuh, Kec. Purwakarta, Kab. Purwakarta, Jawa Barat 41118', '2024-10-04 20:30:00', '2024-10-04 20:30:00', NULL),
(26, 'Badan Penanggulangan Bencana Daerah', 'BPDB', 'Jl. Purnawarman Selatan, Sindangkasih, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41112', '2024-10-04 20:30:41', '2024-10-04 20:30:41', NULL),
(27, 'Dinas Pekerjaan Umum dan Tata Ruang', 'DPUTR', 'Jalan K.K Singawinata No. 116, Nagri Kidul, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41111, Indonesia', '2024-10-04 20:31:32', '2024-10-04 20:31:32', NULL),
(28, 'Dinas Pemadam Kebakaran dan Penyelematan', 'DAMKAR', 'Jl. Jend. Ahmed Yani No.113, Cipaisan, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41113, Indonesia', '2024-10-04 20:33:28', '2024-10-04 20:33:28', NULL),
(29, 'Dinas Perumahan dan Kawasa Permukiman', 'DISTARKIM', 'Jl. Veteran No. 139, Nagri Kaler, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41115', '2024-10-04 20:34:49', '2024-10-04 20:34:49', NULL),
(30, 'Badan Kesatuan Bangsa dan Politik', 'KESBANGPOL', 'Jl. Veteran No. 153 Purwakarta Kode Pos 41115', '2024-10-04 20:38:16', '2024-10-04 20:38:16', NULL),
(31, 'Dinas Pemberdayaan Masyarakat dan Desa', 'DPMD', 'Jl. Purnawarman Timur No.8, Sindangkasih, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41112', '2024-10-04 20:39:07', '2024-10-04 20:39:07', NULL),
(32, 'Sekertariat Dewan', 'SETWAN', 'Jl. Gandanegara No.25, Nagri Kidul, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41111, Indonesia', '2024-10-04 20:43:25', '2024-10-04 20:43:25', NULL),
(33, 'RSUD Bayu Asih', 'BAYU ASIH', 'Jl. Veteran No.39, Nagri Kaler, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41115', '2024-10-04 20:46:42', '2024-10-04 20:46:42', NULL),
(34, 'Badan Pusat Statistik', 'BPS', 'Jl. Baru, RT.031/RW.009, Maracang, Kec. Babakancikao, Kabupaten Purwakarta, Jawa Barat 41151, Indonesia', '2024-10-04 20:47:52', '2024-10-04 20:47:52', NULL),
(35, 'Kecamatan Darangdan', 'Kecamatan Darangdan', 'JL. Raya Darangdan, KM 22, Tegalmunjul, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41116, Indonesia', '2024-10-04 20:48:39', '2024-10-04 20:48:39', NULL),
(36, 'Kecamatan Cibatu', 'Kecamatan Cibatu', 'Kec. Cibatu, Kabupaten Purwakarta, Jawa Barat', '2024-10-04 20:55:45', '2024-10-04 20:55:45', NULL),
(37, 'Kecamatan Campaka', 'Kecamatan Campaka', 'Jl. Raya No.17, Campaka, Kabupaten Purwakarta, Jawa Barat 41181, Indonesia', '2024-10-04 20:56:31', '2024-10-04 20:56:31', NULL),
(38, 'Kecamatan Bungursari', 'Kecamatan Bungursari', 'Kec. Bungursari, Kabupaten Purwakarta, Jawa Barat', '2024-10-04 20:57:41', '2024-10-04 20:57:41', NULL),
(39, 'Kecamatan Babakancikao', 'Kecamatan Babakancikao', 'Kecamatan Babakan Cikao, Purwakarta, Jawa Barat', '2024-10-04 20:58:53', '2024-10-04 20:58:53', NULL),
(40, 'Kecamatan Sukasari', 'Kecamatan Sukasari', 'Jl. Sukasari, Sukasari, Purwasari, Kabupaten Karawang, Jawa Barat 41373, Indonesia', '2024-10-04 21:01:06', '2024-10-04 21:01:06', NULL),
(41, 'Kecamatan Jatiluhur', 'Kecamatan Jatiluhur', 'Jl. Ir. H. Juanda, Jatiluhur, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41152, Indonesia', '2024-10-04 21:02:08', '2024-10-04 21:02:08', NULL),
(42, 'Kecamatan Maniis', 'Kecamatan Maniis', 'Kec. Maniis, Kabupaten Purwakarta, Jawa Barat', '2024-10-04 21:04:05', '2024-10-04 21:04:05', NULL),
(43, 'Kecamatan Tegalwaru', 'Kecamatan Tegalwaru', 'Jl. Cijati Warungjeruk, Sukahaji, Tegal Waru, Kabupaten Purwakarta, Jawa Barat 41165, Indonesia', '2024-10-04 21:04:34', '2024-10-04 21:04:34', NULL),
(44, 'Kecamatan Plered', 'Kecamatan Plered', 'Jl. Raya Plered, Purwakarta, Sindangsari, Plered, Kabupaten Purwakarta, Jawa Barat 41162, Indonesia', '2024-10-04 21:05:48', '2024-10-04 21:05:48', NULL),
(45, 'Kecamatan Sukatani', 'Kecamatan Sukatani', 'Jl. Raya Sukatani KM.11, Sukatani, Purwakarta, Kabupaten Purwakarta, Jawa Barat 41167, Indonesia', '2024-10-04 21:06:20', '2024-10-04 21:06:20', NULL),
(46, 'Kecamatan Bojong', 'Kecamatan Bojong', 'Jl. Veteran No.146, Nagri Kaler, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41115, Indonesia', '2024-10-04 21:06:59', '2024-10-04 21:06:59', NULL),
(47, 'Kecamatan Kiarapedes', 'Kecamatan Kiarapedes', 'Jl. Raya Kiarapedes Km. 28, Kabupaten Purwakarta, Jawa Barat', '2024-10-04 21:07:35', '2024-10-04 21:07:35', NULL),
(48, 'Kecamatan Wanayasa', 'Kecamatan Wanayasa', 'Jl. Veteran No.146, Nagri Kaler, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41115, Indonesia', '2024-10-04 21:08:05', '2024-10-04 21:08:05', NULL),
(49, 'Kecamatan Pondoksalam', 'Kecamatan Pondoksalam', 'Kec. Pondoksalam, Kabupaten Purwakarta, Jawa Barat', '2024-10-04 21:08:52', '2024-10-04 21:08:52', NULL),
(50, 'Kecamatan Pasawahan', 'Kecamatan Pasawahan', 'Pasawahan, Kec. Pasawahan, Kabupaten Purwakarta, Jawa Barat 41172, Indonesia', '2024-10-04 21:09:46', '2024-10-04 21:09:46', NULL),
(51, 'Kecamatan Purwakarta', 'Kecamatan Purwakarta', 'Jalan Veteran, Purwakarta, Jawa Barat, Indonesia', '2024-10-04 21:11:45', '2024-10-04 21:11:45', NULL),
(52, 'Kecamatan Nagri Kidul', 'Kecamatan Nagri Kidul', 'Jl. Gandanegara No. 25, Kelurahan Nageri Kidul, Kecamatan Purwakarta, Kabupaten Purwakarta, Provinsi Jawa Barat 41111.', '2024-10-04 21:12:31', '2024-10-04 21:12:31', NULL),
(53, 'Kecamatan Nagri Kaler', 'Kecamatan Nagri Kaler', 'Jalan Veteran No.7, Purwakarta, Jawa Barat 41115, Indonesia', '2024-10-04 21:13:01', '2024-10-04 21:13:01', NULL),
(54, 'Kecamatan Nagri Tengah', 'Kecamatan Nagri Tengah', 'Jalan Hidayat Martalogawa No 16 (Tegal Tulang), Purwakarta, Jawa Barat, Indonesia', '2024-10-04 21:13:50', '2024-10-04 21:13:50', NULL),
(55, 'Kecamatan Sindangkasih', 'Kecamatan Sindangkasih', 'Jalan Basuki Rahmat No. 34-36, Sindangkasih, Kecamatan Purwakarta, Kabupaten Purwakarta, Jawa Barat 41112, Indonesia', '2024-10-04 21:14:21', '2024-10-04 21:14:21', NULL),
(56, 'Kecamatan Cipaisan', 'Kecamatan Cipaisan', 'Jl. Ahmad yani (CIPAISAN), Purwakarta, Jawa Barat, Indonesia', '2024-10-04 21:15:01', '2024-10-04 21:15:01', NULL),
(57, 'Kecamatan Purwamekar', 'Kecamatan Purwamekar', 'alan Mekarsari I No.33, Purwamekar, Kecamatan Purwakarta, Purwamekar, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41114, Indonesia', '2024-10-04 21:15:41', '2024-10-04 21:15:41', NULL),
(58, 'Kecamatan Cisereuh', 'Kecamatan Cisereuh', 'Ciseureuh, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat', '2024-10-04 21:16:47', '2024-10-04 21:16:47', NULL),
(59, 'Kecamatan Tegalmunjul', 'Kecamatan Tegalmunjul', 'Tegalmunjul, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat', '2024-10-04 21:17:59', '2024-10-04 21:17:59', NULL),
(60, 'Kecamatan Munjuljaya', 'Kecamatan Munjuljaya', 'Munjuljaya, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat', '2024-10-10 12:33:38', '2024-10-10 12:33:38', NULL),
(61, 'Puskesmas Purwakarta', 'Puskesmas Purwakarta', 'Jl. Siliwangi No.3, Nagri Kidul, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41117', '2024-10-10 12:38:07', '2024-10-10 12:38:07', NULL),
(62, 'Puskesmas Munjuljaya', 'Puskesmas Munjuljaya', 'Ipik gandamanah, Purwakarta, Jawa Barat, Indonesia', '2024-10-10 12:39:06', '2024-10-10 12:39:06', NULL),
(63, 'Puskesmas Koncara', 'Puskesmas Koncara', 'Jalan Ibrahim Singadilaga No. 60, Purwamekar, Kecamatan Purwakarta, Nagri Kaler, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41119, Indonesia', '2024-10-10 12:40:14', '2024-10-10 12:40:14', NULL),
(64, 'Puskesmas Campaka', 'Puskesmas Campaka', 'Jl. Raya Campaka, Campaka, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41181, Indonesia', '2024-10-10 12:41:40', '2024-10-10 12:41:40', NULL),
(65, 'Puskesmas Jatiluhur', 'Puskesmas Jatiluhur', 'JL. Ir. H. Juanda No. 73, Kec. Jatiluhur, Kab. Purwakarta Purwakarta, Jawa Barat, Indonesia', '2024-10-10 12:42:56', '2024-10-10 12:42:56', NULL),
(66, 'Puskesmas Plered', 'Puskesmas Plered', 'Jl. Raya Plered, Sindangsari, Kec. Plered, Kabupaten Purwakarta, Jawa Barat 41162', '2024-10-10 12:47:01', '2024-10-10 12:47:01', NULL),
(67, 'Puskesmas Sukatani', 'Puskesmas Sukatani', 'Jalan Raya Sukatani KM.12 (Samping Polsek Sukatani), Purwakarta, Jawa Barat, Indonesia', '2024-10-10 12:48:41', '2024-10-10 12:48:41', NULL),
(68, 'Puskesmas Darangdan', 'Puskesmas Darangdan', 'Jl.Darangdan No.80, Purwakarta, Jawa Barat, Indonesia', '2024-10-10 12:49:20', '2024-10-10 12:49:20', NULL),
(69, 'Puskesmas Maniis', 'Puskesmas Maniis', 'Maniis (Jl Raya Palumbon), Purwakarta, Jawa Barat, Indonesia', '2024-10-10 12:49:48', '2024-10-10 12:49:48', NULL),
(70, 'Puskesmas Tegalwaru', 'Puskesmas Tegalwaru', 'Batutumpang, Purwakarta, Jawa Barat, Indonesia', '2024-10-10 12:50:22', '2024-10-10 12:50:22', NULL),
(71, 'Puskesmas Wanayasa', 'Puskesmas Wanayasa', 'Jl. Raya Wanayasa No. 28, Kec. Wanayasa, Purwakarta Purwakarta, Jawa Barat, Indonesia 41174', '2024-10-10 12:51:01', '2024-10-10 12:51:01', NULL),
(72, 'Puskesmas Pasawahan', 'Puskesmas Pasawahan', 'Jalan Terusan Kapten Halim No.105, Sawah Kulon, Pasawahan, Sawah Kulon, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41172, Indonesia', '2024-10-10 12:51:46', '2024-10-10 12:51:46', NULL),
(73, 'Puskesmas Bojong', 'Puskesmas Bojong', 'Jalan Raya Bojong Kab. Purwakarta, Jawa Barat', '2024-10-10 12:52:53', '2024-10-10 12:52:53', NULL),
(74, 'Puskesmas Maracang', 'Puskesmas Maracang', 'Jl. Kopi, Maracang, Kec. Babakancikao, Kabupaten Purwakarta, Jawa Barat 41151, Indonesia', '2024-10-10 12:53:24', '2024-10-10 12:53:24', NULL),
(75, 'Puskesmas Mulyamekar', 'Puskesmas Mulyamekar', 'Jl. Veteran No. 246, Kec. Purwakarta, Kab. Purwakarta Purwakarta, Jawa Barat, Indonesia 41118', '2024-10-10 12:55:00', '2024-10-10 12:55:00', NULL),
(76, 'Puskesmas Bungursari', 'Puskesmas Bungursari', 'Jl. Raya Bungursari No. 124, Kec. Bungursari, Purwakarta Purwakarta, Jawa Barat, Indonesia', '2024-10-10 12:57:58', '2024-10-10 12:57:58', NULL),
(77, 'Puskesmas Cibatu', 'Puskesmas Cibatu', 'Jl. Raya Cibatu Km. 15, Kec. Cibatu, Kab. Purwakarta Purwakarta, Jawa Barat, Indonesia 41181', '2024-10-10 12:58:59', '2024-10-10 12:58:59', NULL),
(78, 'Puskesmas Sukasari', 'Puskesmas Sukasari', 'Kec.Sukasari ,Purwakarta Kab Purwakarta, Jawa Barat', '2024-10-10 13:02:01', '2024-10-10 13:02:01', NULL),
(79, 'Puskesmas Pondoksalam', 'Puskesmas Pondoksalam', 'Jl. Raya Terusan Kapten Halim, Kec. Pondok Salam, Purwakarta Purwakarta, Jawa Barat, Indonesia 41115', '2024-10-10 13:02:29', '2024-10-10 13:02:29', NULL),
(80, 'Puskesmas Kiarapedes', 'Puskesmas Kiarapedes', 'Jl. Raya Kiarapedes Km. 24, Kec. Kiarapedes, Purwakarta Purwakarta, Jawa Barat, Indonesia 41175', '2024-10-10 13:02:59', '2024-10-10 13:02:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(1, 'default', '{\"uuid\":\"0a249ea7-e2ba-4001-a5c8-2fd2e4b631cc\",\"displayName\":\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\",\"command\":\"O:33:\\\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\\\":2:{s:6:\\\"models\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\DokumenKeluar\\\";s:2:\\\"id\\\";a:1:{i:0;i:1;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:10:\\\"connection\\\";s:8:\\\"database\\\";}\"},\"telescope_uuid\":null}', 0, NULL, 1741368202, 1741368202),
(2, 'default', '{\"uuid\":\"24daee42-df72-44f4-aea9-44c935d039b7\",\"displayName\":\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\",\"command\":\"O:33:\\\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\\\":2:{s:6:\\\"models\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\DokumenKeluar\\\";s:2:\\\"id\\\";a:1:{i:0;i:2;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:10:\\\"connection\\\";s:8:\\\"database\\\";}\"},\"telescope_uuid\":null}', 0, NULL, 1741370171, 1741370171),
(3, 'default', '{\"uuid\":\"4de0a0ef-626a-487b-9ada-26e0f6c9e800\",\"displayName\":\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\",\"command\":\"O:33:\\\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\\\":2:{s:6:\\\"models\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\DokumenKeluar\\\";s:2:\\\"id\\\";a:1:{i:0;i:2;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:10:\\\"connection\\\";s:8:\\\"database\\\";}\"},\"telescope_uuid\":null}', 0, NULL, 1741372261, 1741372261),
(4, 'default', '{\"uuid\":\"1cf1b3b1-3303-49da-b688-10ea29feda6f\",\"displayName\":\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\",\"command\":\"O:33:\\\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\\\":2:{s:6:\\\"models\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\DokumenKeluar\\\";s:2:\\\"id\\\";a:1:{i:0;i:2;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:10:\\\"connection\\\";s:8:\\\"database\\\";}\"},\"telescope_uuid\":null}', 0, NULL, 1741372567, 1741372567),
(5, 'default', '{\"uuid\":\"3b44390b-0e66-490b-b850-dba681050e4c\",\"displayName\":\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\",\"command\":\"O:33:\\\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\\\":2:{s:6:\\\"models\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\DokumenKeluar\\\";s:2:\\\"id\\\";a:1:{i:0;i:2;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:10:\\\"connection\\\";s:8:\\\"database\\\";}\"},\"telescope_uuid\":null}', 0, NULL, 1741449667, 1741449667),
(6, 'default', '{\"uuid\":\"2f03dca7-d5e5-4bc8-b626-d650b070629b\",\"displayName\":\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\",\"command\":\"O:33:\\\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\\\":2:{s:6:\\\"models\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\DokumenKeluar\\\";s:2:\\\"id\\\";a:1:{i:0;i:1;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:10:\\\"connection\\\";s:8:\\\"database\\\";}\"},\"telescope_uuid\":null}', 0, NULL, 1741449877, 1741449877),
(7, 'default', '{\"uuid\":\"d86df40d-e0c5-4879-b14b-eb24b49acf7a\",\"displayName\":\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\",\"command\":\"O:33:\\\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\\\":2:{s:6:\\\"models\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\DokumenKeluar\\\";s:2:\\\"id\\\";a:1:{i:0;i:3;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:10:\\\"connection\\\";s:8:\\\"database\\\";}\"},\"telescope_uuid\":null}', 0, NULL, 1741450968, 1741450968),
(8, 'default', '{\"uuid\":\"92160a91-50ed-4c30-bb69-12c1fd12df82\",\"displayName\":\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\",\"command\":\"O:33:\\\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\\\":2:{s:6:\\\"models\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\DokumenKeluar\\\";s:2:\\\"id\\\";a:1:{i:0;i:3;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:10:\\\"connection\\\";s:8:\\\"database\\\";}\"},\"telescope_uuid\":null}', 0, NULL, 1741451378, 1741451378),
(9, 'default', '{\"uuid\":\"af5bf9aa-d8a2-445f-b3f6-48912b95b0a3\",\"displayName\":\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\",\"command\":\"O:33:\\\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\\\":2:{s:6:\\\"models\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\DokumenKeluar\\\";s:2:\\\"id\\\";a:1:{i:0;i:4;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:10:\\\"connection\\\";s:8:\\\"database\\\";}\"},\"telescope_uuid\":null}', 0, NULL, 1741535893, 1741535893),
(10, 'default', '{\"uuid\":\"2a11e1e7-7e8e-491a-8a13-15095290120a\",\"displayName\":\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\",\"command\":\"O:33:\\\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\\\":2:{s:6:\\\"models\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\DokumenKeluar\\\";s:2:\\\"id\\\";a:1:{i:0;i:4;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:10:\\\"connection\\\";s:8:\\\"database\\\";}\"},\"telescope_uuid\":null}', 0, NULL, 1741536184, 1741536184),
(11, 'default', '{\"uuid\":\"d0c8d77f-8850-4b16-8523-d9a4d5dc3219\",\"displayName\":\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\",\"command\":\"O:33:\\\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\\\":2:{s:6:\\\"models\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\DokumenKeluar\\\";s:2:\\\"id\\\";a:1:{i:0;i:5;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:10:\\\"connection\\\";s:8:\\\"database\\\";}\"},\"telescope_uuid\":null}', 0, NULL, 1741537498, 1741537498),
(12, 'default', '{\"uuid\":\"e8d04c37-4a34-49be-91c8-6ec47c951384\",\"displayName\":\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\",\"command\":\"O:33:\\\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\\\":2:{s:6:\\\"models\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\DokumenKeluar\\\";s:2:\\\"id\\\";a:1:{i:0;i:5;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:10:\\\"connection\\\";s:8:\\\"database\\\";}\"},\"telescope_uuid\":null}', 0, NULL, 1741537554, 1741537554),
(13, 'default', '{\"uuid\":\"7fd7bb1e-1a54-470d-b84d-1d813623cc58\",\"displayName\":\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\",\"command\":\"O:33:\\\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\\\":2:{s:6:\\\"models\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\DokumenKeluar\\\";s:2:\\\"id\\\";a:1:{i:0;i:6;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:10:\\\"connection\\\";s:8:\\\"database\\\";}\"},\"telescope_uuid\":null}', 0, NULL, 1741553256, 1741553256),
(14, 'default', '{\"uuid\":\"f36d48b2-fcff-4aaf-9277-1116cdb68086\",\"displayName\":\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\",\"command\":\"O:33:\\\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\\\":2:{s:6:\\\"models\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\DokumenKeluar\\\";s:2:\\\"id\\\";a:1:{i:0;i:6;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:10:\\\"connection\\\";s:8:\\\"database\\\";}\"},\"telescope_uuid\":null}', 0, NULL, 1741553321, 1741553321),
(15, 'default', '{\"uuid\":\"5a54c748-48a2-4fd8-98fd-b68668f7e7f5\",\"displayName\":\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\",\"command\":\"O:33:\\\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\\\":2:{s:6:\\\"models\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\DokumenKeluar\\\";s:2:\\\"id\\\";a:1:{i:0;i:7;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:10:\\\"connection\\\";s:8:\\\"database\\\";}\"},\"telescope_uuid\":null}', 0, NULL, 1742230576, 1742230576),
(16, 'default', '{\"uuid\":\"62963611-a263-4cfc-b03d-0027d29c365a\",\"displayName\":\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\",\"command\":\"O:33:\\\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\\\":2:{s:6:\\\"models\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\DokumenKeluar\\\";s:2:\\\"id\\\";a:1:{i:0;i:8;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:10:\\\"connection\\\";s:8:\\\"database\\\";}\"},\"telescope_uuid\":null}', 0, NULL, 1742231111, 1742231111),
(17, 'default', '{\"uuid\":\"6ee762b4-12a4-4fd7-96bf-b5da2740b8be\",\"displayName\":\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\",\"command\":\"O:33:\\\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\\\":2:{s:6:\\\"models\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\DokumenKeluar\\\";s:2:\\\"id\\\";a:1:{i:0;i:7;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:10:\\\"connection\\\";s:8:\\\"database\\\";}\"},\"telescope_uuid\":null}', 0, NULL, 1742231265, 1742231265),
(18, 'default', '{\"uuid\":\"2ee0fa2a-0e19-4767-a26c-2b0b6d9e3ad1\",\"displayName\":\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\",\"command\":\"O:33:\\\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\\\":2:{s:6:\\\"models\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\DokumenKeluar\\\";s:2:\\\"id\\\";a:1:{i:0;i:9;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:10:\\\"connection\\\";s:8:\\\"database\\\";}\"},\"telescope_uuid\":null}', 0, NULL, 1742239973, 1742239973),
(19, 'default', '{\"uuid\":\"04decda6-4148-4069-8645-81f86d1e0d3f\",\"displayName\":\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\",\"command\":\"O:33:\\\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\\\":2:{s:6:\\\"models\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\DokumenKeluar\\\";s:2:\\\"id\\\";a:1:{i:0;i:8;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:10:\\\"connection\\\";s:8:\\\"database\\\";}\"},\"telescope_uuid\":null}', 0, NULL, 1742240147, 1742240147),
(20, 'default', '{\"uuid\":\"688d5f4a-515b-4171-bbc7-8d7475d0bb86\",\"displayName\":\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\",\"command\":\"O:33:\\\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\\\":2:{s:6:\\\"models\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\DokumenKeluar\\\";s:2:\\\"id\\\";a:1:{i:0;i:9;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:10:\\\"connection\\\";s:8:\\\"database\\\";}\"},\"telescope_uuid\":null}', 0, NULL, 1742240155, 1742240155),
(21, 'default', '{\"uuid\":\"1847c547-e0cf-4bad-804c-ce05d1a0960c\",\"displayName\":\"Laravel\\\\Scout\\\\Jobs\\\\RemoveFromSearch\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Laravel\\\\Scout\\\\Jobs\\\\RemoveFromSearch\",\"command\":\"O:35:\\\"Laravel\\\\Scout\\\\Jobs\\\\RemoveFromSearch\\\":2:{s:6:\\\"models\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\DokumenKeluar\\\";s:2:\\\"id\\\";a:1:{i:0;i:4;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";s:44:\\\"Laravel\\\\Scout\\\\Jobs\\\\RemoveableScoutCollection\\\";}s:10:\\\"connection\\\";s:8:\\\"database\\\";}\"},\"telescope_uuid\":\"9e74c5e3-0f62-46f1-839e-e996bf9451ba\"}', 0, NULL, 1742243733, 1742243733),
(22, 'default', '{\"uuid\":\"3e20e849-8672-4bcb-91d4-fce05a939d91\",\"displayName\":\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\",\"command\":\"O:33:\\\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\\\":2:{s:6:\\\"models\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\DokumenKeluar\\\";s:2:\\\"id\\\";a:1:{i:0;i:4;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:10:\\\"connection\\\";s:8:\\\"database\\\";}\"},\"telescope_uuid\":null}', 0, NULL, 1742272798, 1742272798),
(23, 'default', '{\"uuid\":\"1b20ebbe-7408-4d82-9b1f-a0377960aaf2\",\"displayName\":\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\",\"command\":\"O:33:\\\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\\\":2:{s:6:\\\"models\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\DokumenKeluar\\\";s:2:\\\"id\\\";a:1:{i:0;i:4;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:10:\\\"connection\\\";s:8:\\\"database\\\";}\"},\"telescope_uuid\":null}', 0, NULL, 1742272798, 1742272798),
(24, 'default', '{\"uuid\":\"f2ee6de6-00f3-46e9-9ff5-fa3c72ec895d\",\"displayName\":\"Laravel\\\\Scout\\\\Jobs\\\\RemoveFromSearch\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Laravel\\\\Scout\\\\Jobs\\\\RemoveFromSearch\",\"command\":\"O:35:\\\"Laravel\\\\Scout\\\\Jobs\\\\RemoveFromSearch\\\":2:{s:6:\\\"models\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\DokumenKeluar\\\";s:2:\\\"id\\\";a:1:{i:0;i:4;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";s:44:\\\"Laravel\\\\Scout\\\\Jobs\\\\RemoveableScoutCollection\\\";}s:10:\\\"connection\\\";s:8:\\\"database\\\";}\"},\"telescope_uuid\":\"9e757386-4023-4d4f-abbd-3a66fd2b0fa2\"}', 0, NULL, 1742272865, 1742272865),
(25, 'default', '{\"uuid\":\"26d6368e-8cf7-44c8-91d7-908a627d22eb\",\"displayName\":\"Laravel\\\\Scout\\\\Jobs\\\\RemoveFromSearch\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Laravel\\\\Scout\\\\Jobs\\\\RemoveFromSearch\",\"command\":\"O:35:\\\"Laravel\\\\Scout\\\\Jobs\\\\RemoveFromSearch\\\":2:{s:6:\\\"models\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\DokumenKeluar\\\";s:2:\\\"id\\\";a:1:{i:0;i:5;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";s:44:\\\"Laravel\\\\Scout\\\\Jobs\\\\RemoveableScoutCollection\\\";}s:10:\\\"connection\\\";s:8:\\\"database\\\";}\"},\"telescope_uuid\":\"9e7573ff-5be2-417b-884e-b39fe50ebdc1\"}', 0, NULL, 1742272944, 1742272944);

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `log_datetime` datetime NOT NULL,
  `table_name` varchar(50) DEFAULT NULL,
  `log_type` varchar(50) NOT NULL,
  `request_info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`request_info`)),
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`data`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `user_id`, `log_datetime`, `table_name`, `log_type`, `request_info`, `data`) VALUES
(1, 6, '2025-03-18 00:58:24', NULL, 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (X11; Linux x86_64; rv:136.0) Gecko\\/20100101 Firefox\\/136.0\"}', NULL),
(2, 6, '2025-03-18 02:32:53', 'dokumen_keluars', 'create', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (X11; Linux x86_64; rv:136.0) Gecko\\/20100101 Firefox\\/136.0\"}', '{\"nama_dokumen\":\"totos\",\"penerima\":\"tatas\",\"tanggal_keluar\":\"2025-03-18\",\"keterangan\":null,\"status\":\"Menunggu Persetujuan\",\"sifat_dokumen\":\"1\",\"instansi_id\":\"12\",\"dokumen_kategori_id\":\"2\",\"user_id\":6,\"nomor_surat\":\"PST-DOC\\/07.008\\/III\\/2025\",\"nomor_urut\":\"008\",\"lampiran\":\"dokumen\\/keluar\\/totos_18032025_023242.docx\",\"updated_at\":\"2025-03-17T19:32:53.000000Z\",\"created_at\":\"2025-03-17T19:32:53.000000Z\",\"id\":9}'),
(3, 6, '2025-03-18 02:35:15', NULL, 'logout', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (X11; Linux x86_64; rv:136.0) Gecko\\/20100101 Firefox\\/136.0\"}', NULL),
(4, 7, '2025-03-18 02:35:25', NULL, 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (X11; Linux x86_64; rv:136.0) Gecko\\/20100101 Firefox\\/136.0\"}', NULL),
(5, 7, '2025-03-18 02:35:47', 'dokumen_keluars', 'edit', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (X11; Linux x86_64; rv:136.0) Gecko\\/20100101 Firefox\\/136.0\"}', '{\"id\":8,\"nama_dokumen\":\"weSdasdwd\",\"penerima\":\"gadawdwae\",\"lampiran\":\"dokumen\\/keluar\\/weSdasdwd_18032025_000500.docx\",\"status\":\"Menunggu Persetujuan\",\"keterangan\":null,\"persetujuan\":\"tidak\",\"tanggal_keluar\":\"2025-03-18\",\"bukti_dikirimkan\":null,\"instansi_id\":5,\"dokumen_kategori_id\":2,\"user_id\":6,\"pdf_content\":null,\"created_at\":\"2025-03-17 17:05:11\",\"updated_at\":\"2025-03-17 17:05:11\",\"nomor_surat\":\"PST-DOC\\/07.007\\/III\\/2025\",\"nomor_urut\":\"007\",\"sifat_dokumen\":0,\"disetujui\":0}'),
(6, 7, '2025-03-18 02:35:55', 'dokumen_keluars', 'edit', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (X11; Linux x86_64; rv:136.0) Gecko\\/20100101 Firefox\\/136.0\"}', '{\"id\":9,\"nama_dokumen\":\"totos\",\"penerima\":\"tatas\",\"lampiran\":\"dokumen\\/keluar\\/totos_18032025_023242.docx\",\"status\":\"Menunggu Persetujuan\",\"keterangan\":null,\"persetujuan\":\"tidak\",\"tanggal_keluar\":\"2025-03-18\",\"bukti_dikirimkan\":null,\"instansi_id\":12,\"dokumen_kategori_id\":2,\"user_id\":6,\"pdf_content\":null,\"created_at\":\"2025-03-18 02:32:53\",\"updated_at\":\"2025-03-18 02:32:53\",\"nomor_surat\":\"PST-DOC\\/07.008\\/III\\/2025\",\"nomor_urut\":\"008\",\"sifat_dokumen\":1,\"disetujui\":0}'),
(7, 7, '2025-03-18 02:36:05', NULL, 'logout', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (X11; Linux x86_64; rv:136.0) Gecko\\/20100101 Firefox\\/136.0\"}', NULL),
(8, 6, '2025-03-18 02:36:17', NULL, 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (X11; Linux x86_64; rv:136.0) Gecko\\/20100101 Firefox\\/136.0\"}', NULL),
(9, 6, '2025-03-18 03:35:33', 'dokumen_keluars', 'delete', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (X11; Linux x86_64; rv:136.0) Gecko\\/20100101 Firefox\\/136.0\"}', '{\"id\":4,\"nama_dokumen\":\"Ut perspiciatis vit\",\"penerima\":\"Repellendus Volupta\",\"lampiran\":\"dokumen\\/keluar\\/Ut_perspiciatis_vit_09032025_225803.pdf\",\"status\":\"Dikirimkan\",\"keterangan\":\"Distinctio Sint co\",\"persetujuan\":\"tidak\",\"tanggal_keluar\":\"1971-06-28\",\"bukti_dikirimkan\":null,\"instansi_id\":53,\"dokumen_kategori_id\":1,\"user_id\":6,\"pdf_content\":\"PT PRATAMA SOLUSI TEKNOLOGI\\nIntegrated and IT Solution\\n\\nJl Rusa 1 No 57 Nagri Kidul Kec Purwakarta Kab Purwakarta Jawa Barat 41111\\nTelpHp 62 85156562493 Email  Office PratamatechsolutioncoId\\nWebsite  HttpsWwwPratamatechsolutionCoId\\n\\nPurwakarta 20250310\\nNomor\\nHal\\n\\n PSTMOU11001III2025\\n Velit magnam nisi fu\\n\\nKepada Yth\\n1 PPK Elit aut velit volu\\n2 KETUA Ea sequi provident\\n3 PIC Tim Pengembangan Velit error ullamco\\nKONTEN\\nHormat kami\\nPT Pratama Solusi Teknologi\\n\\nGagas Sangga Pratama SKom\\nDirektur\",\"created_at\":\"2025-03-09 15:58:13\",\"updated_at\":\"2025-03-18 03:35:33\",\"nomor_surat\":\"PST-MOU\\/11.001\\/III\\/2025\",\"nomor_urut\":\"001\",\"sifat_dokumen\":0,\"disetujui\":2,\"deleted_at\":\"2025-03-18 03:35:33\"}'),
(10, 6, '2025-03-18 11:39:40', NULL, 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (X11; Linux x86_64; rv:136.0) Gecko\\/20100101 Firefox\\/136.0\"}', NULL),
(11, 6, '2025-03-18 11:39:58', 'dokumen_keluars', 'edit', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (X11; Linux x86_64; rv:136.0) Gecko\\/20100101 Firefox\\/136.0\"}', '{\"id\":4,\"nama_dokumen\":\"Ut perspiciatis vit\",\"penerima\":\"Repellendus Volupta\",\"lampiran\":\"dokumen\\/keluar\\/Ut_perspiciatis_vit_09032025_225803.pdf\",\"status\":\"Dikirimkan\",\"keterangan\":\"Distinctio Sint co\",\"persetujuan\":\"tidak\",\"tanggal_keluar\":\"1971-06-28\",\"bukti_dikirimkan\":null,\"instansi_id\":53,\"dokumen_kategori_id\":1,\"user_id\":6,\"pdf_content\":\"PT PRATAMA SOLUSI TEKNOLOGI\\nIntegrated and IT Solution\\n\\nJl Rusa 1 No 57 Nagri Kidul Kec Purwakarta Kab Purwakarta Jawa Barat 41111\\nTelpHp 62 85156562493 Email  Office PratamatechsolutioncoId\\nWebsite  HttpsWwwPratamatechsolutionCoId\\n\\nPurwakarta 20250310\\nNomor\\nHal\\n\\n PSTMOU11001III2025\\n Velit magnam nisi fu\\n\\nKepada Yth\\n1 PPK Elit aut velit volu\\n2 KETUA Ea sequi provident\\n3 PIC Tim Pengembangan Velit error ullamco\\nKONTEN\\nHormat kami\\nPT Pratama Solusi Teknologi\\n\\nGagas Sangga Pratama SKom\\nDirektur\",\"created_at\":\"2025-03-09 15:58:13\",\"updated_at\":\"2025-03-18 03:35:33\",\"nomor_surat\":\"PST-MOU\\/11.001\\/III\\/2025\",\"nomor_urut\":\"001\",\"sifat_dokumen\":0,\"disetujui\":2,\"deleted_at\":\"2025-03-18 03:35:33\"}'),
(12, 6, '2025-03-18 11:41:05', 'dokumen_keluars', 'delete', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (X11; Linux x86_64; rv:136.0) Gecko\\/20100101 Firefox\\/136.0\"}', '{\"id\":4,\"nama_dokumen\":\"Ut perspiciatis vit\",\"penerima\":\"Repellendus Volupta\",\"lampiran\":\"dokumen\\/keluar\\/Ut_perspiciatis_vit_09032025_225803.pdf\",\"status\":\"Dikirimkan\",\"keterangan\":\"Distinctio Sint co\",\"persetujuan\":\"tidak\",\"tanggal_keluar\":\"1971-06-28\",\"bukti_dikirimkan\":null,\"instansi_id\":53,\"dokumen_kategori_id\":1,\"user_id\":6,\"pdf_content\":\"PT PRATAMA SOLUSI TEKNOLOGI\\nIntegrated and IT Solution\\n\\nJl Rusa 1 No 57 Nagri Kidul Kec Purwakarta Kab Purwakarta Jawa Barat 41111\\nTelpHp 62 85156562493 Email  Office PratamatechsolutioncoId\\nWebsite  HttpsWwwPratamatechsolutionCoId\\n\\nPurwakarta 20250310\\nNomor\\nHal\\n\\n PSTMOU11001III2025\\n Velit magnam nisi fu\\n\\nKepada Yth\\n1 PPK Elit aut velit volu\\n2 KETUA Ea sequi provident\\n3 PIC Tim Pengembangan Velit error ullamco\\nKONTEN\\nHormat kami\\nPT Pratama Solusi Teknologi\\n\\nGagas Sangga Pratama SKom\\nDirektur\",\"created_at\":\"2025-03-09 15:58:13\",\"updated_at\":\"2025-03-18 11:41:05\",\"nomor_surat\":\"PST-MOU\\/11.001\\/III\\/2025\",\"nomor_urut\":\"001\",\"sifat_dokumen\":0,\"disetujui\":2,\"deleted_at\":\"2025-03-18 11:41:05\"}'),
(13, 6, '2025-03-18 11:42:24', 'dokumen_keluars', 'delete', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (X11; Linux x86_64; rv:136.0) Gecko\\/20100101 Firefox\\/136.0\"}', '{\"id\":5,\"nama_dokumen\":\"Animi officiis perf\",\"penerima\":\"Amet aliqua Ad iru\",\"lampiran\":\"dokumen\\/keluar\\/Animi_officiis_perf_09032025_232448.pdf\",\"status\":\"Dikirimkan\",\"keterangan\":\"Ut debitis sint et e\",\"persetujuan\":\"tidak\",\"tanggal_keluar\":\"2016-02-21\",\"bukti_dikirimkan\":null,\"instansi_id\":16,\"dokumen_kategori_id\":2,\"user_id\":6,\"pdf_content\":\"PT PRATAMA SOLUSI TEKNOLOGI\\nIntegrated and IT Solution\\n\\nJl Rusa 1 No 57 Nagri Kidul Kec Purwakarta Kab Purwakarta Jawa Barat 41111\\nTelpHp 62 85156562493 Email  Office PratamatechsolutioncoId\\nWebsite  HttpsWwwPratamatechsolutionCoId\\n\\nPurwakarta 20250303\\nNomor\\nHal\\n\\n PSTDOC07004III2025\\n dawdacadaax\\n\\nKepada Yth\\n1 PPK zxczxccasdqavacf\\n2 KETUA czcasdadwdq\\n3 PIC Tim Pengembangan czsdadq\\nKONTEN\\nHormat kami\\nPT Pratama Solusi Teknologi\\n\\nGagas Sangga Pratama SKom\\nDirektur\",\"created_at\":\"2025-03-09 16:24:58\",\"updated_at\":\"2025-03-18 11:42:24\",\"nomor_surat\":\"PST-DOC\\/07.004\\/III\\/2025\",\"nomor_urut\":\"004\",\"sifat_dokumen\":0,\"disetujui\":2,\"deleted_at\":\"2025-03-18 11:42:24\"}'),
(14, 6, '2025-03-18 12:24:11', 'dokumen_kategoris', 'delete', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (X11; Linux x86_64; rv:136.0) Gecko\\/20100101 Firefox\\/136.0\"}', '{\"id\":1,\"nama_kategori\":\"Surat MOU\",\"created_at\":\"2025-03-07 16:38:36\",\"updated_at\":\"2025-03-18 12:24:11\",\"nomor_surat\":\"PST-MOU\\/11\",\"deleted_at\":\"2025-03-18 12:24:11\"}'),
(15, 6, '2025-03-18 12:28:24', 'dokumen_templates', 'delete', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (X11; Linux x86_64; rv:136.0) Gecko\\/20100101 Firefox\\/136.0\"}', '{\"id\":1,\"nama\":\"Template Dokumen\",\"file\":\"dokumen\\/template\\/Template_Dokumen-1741450445.docx\",\"data\":\"[\\\"TANGGAL\\\",\\\"NOMOR_SURAT\\\",\\\"PERIHAL\\\",\\\"PPK\\\",\\\"KETUA\\\",\\\"PIC\\\"]\",\"dokumen_kategori_id\":2,\"user_id\":6,\"created_at\":\"2025-03-07 16:56:12\",\"updated_at\":\"2025-03-18 12:28:24\",\"deleted_at\":\"2025-03-18 12:28:24\"}'),
(16, 6, '2025-03-18 12:29:24', 'dokumen_templates', 'edit', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (X11; Linux x86_64; rv:136.0) Gecko\\/20100101 Firefox\\/136.0\"}', '{\"id\":1,\"nama\":\"Template Dokumen\",\"file\":\"dokumen\\/template\\/Template_Dokumen-1741450445.docx\",\"data\":\"[\\\"TANGGAL\\\",\\\"NOMOR_SURAT\\\",\\\"PERIHAL\\\",\\\"PPK\\\",\\\"KETUA\\\",\\\"PIC\\\"]\",\"dokumen_kategori_id\":2,\"user_id\":6,\"created_at\":\"2025-03-07 16:56:12\",\"updated_at\":\"2025-03-18 12:28:24\",\"deleted_at\":\"2025-03-18 12:28:24\"}'),
(17, 6, '2025-03-18 12:37:24', 'instansis', 'delete', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (X11; Linux x86_64; rv:136.0) Gecko\\/20100101 Firefox\\/136.0\"}', '{\"id\":6,\"nama_instansi\":\"Dinas Pendidikan\",\"singkatan_instansi\":\"DISDIK\",\"alamat\":\"Jl. Veteran No 1 Gang beringin Kel. Nagri Kaler, Kecamatan Purwakarta  Kabupaten Purwakarta Jawa Barat 41114\",\"created_at\":\"2024-10-05 03:00:44\",\"updated_at\":\"2025-03-18 12:37:24\",\"deleted_at\":\"2025-03-18 12:37:24\"}'),
(18, 6, '2025-03-18 12:37:30', 'instansis', 'edit', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (X11; Linux x86_64; rv:136.0) Gecko\\/20100101 Firefox\\/136.0\"}', '{\"id\":6,\"nama_instansi\":\"Dinas Pendidikan\",\"singkatan_instansi\":\"DISDIK\",\"alamat\":\"Jl. Veteran No 1 Gang beringin Kel. Nagri Kaler, Kecamatan Purwakarta  Kabupaten Purwakarta Jawa Barat 41114\",\"created_at\":\"2024-10-05 03:00:44\",\"updated_at\":\"2025-03-18 12:37:24\",\"deleted_at\":\"2025-03-18 12:37:24\"}'),
(19, 6, '2025-03-18 12:42:52', 'users', 'delete', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (X11; Linux x86_64; rv:136.0) Gecko\\/20100101 Firefox\\/136.0\"}', '{\"id\":7,\"name\":\"testpim\",\"email\":\"pimpinan123@gmail.com\",\"email_verified_at\":null,\"password\":\"$2y$12$vY\\/lYbnhbJVYzNAtyoFHSugWo228Z1zh7FOxSgQrTmjzpByHCIWwe\",\"role\":\"pimpinan\",\"photo_path\":null,\"ttd_path\":null,\"remember_token\":null,\"created_at\":\"2024-10-05 00:32:24\",\"updated_at\":\"2025-03-18 12:42:52\",\"phone\":\"085156938759\",\"deleted_at\":\"2025-03-18 12:42:52\"}'),
(20, 6, '2025-03-18 12:43:01', 'users', 'edit', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (X11; Linux x86_64; rv:136.0) Gecko\\/20100101 Firefox\\/136.0\"}', '{\"id\":7,\"name\":\"testpim\",\"email\":\"pimpinan123@gmail.com\",\"email_verified_at\":null,\"password\":\"$2y$12$vY\\/lYbnhbJVYzNAtyoFHSugWo228Z1zh7FOxSgQrTmjzpByHCIWwe\",\"role\":\"pimpinan\",\"photo_path\":null,\"ttd_path\":null,\"remember_token\":null,\"created_at\":\"2024-10-05 00:32:24\",\"updated_at\":\"2025-03-18 12:42:52\",\"phone\":\"085156938759\",\"deleted_at\":\"2025-03-18 12:42:52\"}'),
(21, 6, '2025-03-18 12:45:29', NULL, 'logout', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (X11; Linux x86_64; rv:136.0) Gecko\\/20100101 Firefox\\/136.0\"}', NULL),
(22, 7, '2025-03-18 12:45:40', NULL, 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (X11; Linux x86_64; rv:136.0) Gecko\\/20100101 Firefox\\/136.0\"}', NULL),
(23, 7, '2025-03-18 12:45:57', NULL, 'logout', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (X11; Linux x86_64; rv:136.0) Gecko\\/20100101 Firefox\\/136.0\"}', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_10_03_140458_create_dokumen_kategoris_table', 1),
(5, '2024_10_03_140846_create_instansis_table', 1),
(6, '2024_10_03_141234_create_dokumen_masuks_table', 1),
(8, '2024_11_02_073126_create_dokumen_templates_table', 1),
(9, '2024_12_18_022647_add_column_alasan_to_dokumen_keluars', 1),
(10, '2024_12_18_023305_add_column_phone_to_users', 1),
(11, '2025_02_19_101402_add_column_nomor_surat_to_dokumen_kategoris', 1),
(13, '2024_10_03_141238_create_dokumen_keluars_table', 2),
(14, '2025_02_19_101715_add_column_nomor_urut_to_dokumen_keluars', 2),
(15, '2020_11_20_100001_create_log_table', 3),
(16, '2022_01_17_000000_create_log_table', 4),
(17, '2025_03_18_030007_add_column_soft_delete_to_dokumen_keluars', 5),
(18, '2025_03_18_030013_add_column_soft_delete_to_dokumen_masuks', 5),
(19, '2025_03_18_030028_add_column_soft_delete_to_dokumen_templates', 5),
(20, '2025_03_18_030050_add_column_soft_delete_to_dokumen_kategoris', 5),
(21, '2025_03_18_123113_add_column_soft_delete_to_instansis', 6),
(22, '2025_03_18_123121_add_column_soft_delete_to_users', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('PkS4UJaxYH7Z0pE7I86Ge57R7M041AvG6hcWLnlh', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiVnAwbGJTdDc1ajh6OWtWYTRpWnJJemZGcDBPalpCMXM4SkVQcFcycCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MDoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL2Fyc2lwX2tlbHVhciI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQwOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4vYXJzaXBfa2VsdWFyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czoyMjoiUEhQREVCVUdCQVJfU1RBQ0tfREFUQSI7YToxOntzOjMzOiJYNGQ1Zjc3YWM5NzRiYTRiMDA0YTA0MzBjZDczNmViNWYiO047fXM6MzoiX3R0IjthOjE6e3M6MTM6InJlcXVlc3Rfc3RhY2siO2E6MTp7aTowO2E6ODp7czo1OiJlcnJvciI7YjowO3M6ODoiZHVyYXRpb24iO2Q6MTgzNTtzOjEwOiJzdGF0dXNDb2RlIjtpOjMwMjtzOjM6InVybCI7czoxOToiL2FkbWluL2Fyc2lwX2tlbHVhciI7czo2OiJtZXRob2QiO3M6MzoiR0VUIjtzOjc6InByb2ZpbGUiO3M6MzY6IjllNzU3NzlmLTU5NjktNGY4NC1iMjZiLTIxYTI0MTE0N2IyMyI7czoxMToicHJvZmlsZXJVcmwiO3M6Njc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9fdHQvc2hvdy85ZTc1Nzc5Zi01OTY5LTRmODQtYjI2Yi0yMWEyNDExNDdiMjMiO3M6NDoidHlwZSI7czo1OiJvdGhlciI7fX19fQ==', 1742273553),
('xQkyvXWkqQZ8tlIxiwxnjIGf8p3ky7hVRlFGFVB1', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYm9Tcm10WENIWDJ0TDk0WHpic09ZOXZINXROY0luUDlKQmxrY2FpeSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJfdHQiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjIxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAiO319', 1742276758);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','pimpinan') NOT NULL,
  `photo_path` varchar(255) DEFAULT NULL,
  `ttd_path` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `photo_path`, `ttd_path`, `remember_token`, `created_at`, `updated_at`, `phone`, `deleted_at`) VALUES
(6, 'Byul', 'admin123@gmail.com', NULL, '$2y$12$GdO2plEoAy/.eaMMYKNkteO1/WmwRwbMZYFoaOxaWaymWpG07Snja', 'admin', 'foto_profil/2anuS4MfguW385RGnQzuB4ko6zumhTw0UqhL2igT.jpg', NULL, NULL, '2024-10-04 17:32:24', '2024-10-04 17:53:10', NULL, NULL),
(7, 'testpim', 'pimpinan123@gmail.com', NULL, '$2y$12$vY/lYbnhbJVYzNAtyoFHSugWo228Z1zh7FOxSgQrTmjzpByHCIWwe', 'pimpinan', NULL, NULL, NULL, '2024-10-04 17:32:24', '2025-03-18 05:43:01', '085156938759', NULL);

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
ALTER TABLE `dokumen_keluars` ADD FULLTEXT KEY `dokumen_keluars_nama_dokumen_fulltext` (`nama_dokumen`);
ALTER TABLE `dokumen_keluars` ADD FULLTEXT KEY `dokumen_keluars_pdf_content_fulltext` (`pdf_content`);
ALTER TABLE `dokumen_keluars` ADD FULLTEXT KEY `dokumen_keluars_nama_dokumen_pdf_content_fulltext` (`nama_dokumen`,`pdf_content`);

--
-- Indexes for table `dokumen_masuks`
--
ALTER TABLE `dokumen_masuks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dokumen_masuks_instansi_id_foreign` (`instansi_id`),
  ADD KEY `dokumen_masuks_dokumen_kategori_id_foreign` (`dokumen_kategori_id`),
  ADD KEY `dokumen_masuks_user_id_foreign` (`user_id`);
ALTER TABLE `dokumen_masuks` ADD FULLTEXT KEY `dokumen_masuks_nama_dokumen_fulltext` (`nama_dokumen`);
ALTER TABLE `dokumen_masuks` ADD FULLTEXT KEY `dokumen_masuks_pdf_content_fulltext` (`pdf_content`);
ALTER TABLE `dokumen_masuks` ADD FULLTEXT KEY `dokumen_masuks_nama_dokumen_pdf_content_fulltext` (`nama_dokumen`,`pdf_content`);

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
-- Indexes for table `logs`
--
ALTER TABLE `logs`
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dokumen_keluars`
--
ALTER TABLE `dokumen_keluars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `dokumen_masuks`
--
ALTER TABLE `dokumen_masuks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dokumen_templates`
--
ALTER TABLE `dokumen_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `instansis`
--
ALTER TABLE `instansis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dokumen_keluars`
--
ALTER TABLE `dokumen_keluars`
  ADD CONSTRAINT `dokumen_keluars_dokumen_kategori_id_foreign` FOREIGN KEY (`dokumen_kategori_id`) REFERENCES `dokumen_kategoris` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `dokumen_keluars_instansi_id_foreign` FOREIGN KEY (`instansi_id`) REFERENCES `instansis` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `dokumen_keluars_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `dokumen_masuks`
--
ALTER TABLE `dokumen_masuks`
  ADD CONSTRAINT `dokumen_masuks_dokumen_kategori_id_foreign` FOREIGN KEY (`dokumen_kategori_id`) REFERENCES `dokumen_kategoris` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `dokumen_masuks_instansi_id_foreign` FOREIGN KEY (`instansi_id`) REFERENCES `instansis` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `dokumen_masuks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `dokumen_templates`
--
ALTER TABLE `dokumen_templates`
  ADD CONSTRAINT `dokumen_templates_dokumen_kategori_id_foreign` FOREIGN KEY (`dokumen_kategori_id`) REFERENCES `dokumen_kategoris` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `dokumen_templates_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
