-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2024 at 09:04 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smpn2parepare`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gurus`
--

CREATE TABLE `gurus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` char(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` char(18) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `aktif_mengajar` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `wali` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gurus`
--

INSERT INTO `gurus` (`id`, `id_user`, `nip`, `jenis_kelamin`, `aktif_mengajar`, `wali`, `created_at`, `updated_at`) VALUES
(5, '106', '198807272019032004', 'Perempuan', 'Y', 'Y', '2023-03-07 22:05:12', '2023-03-07 22:23:25'),
(6, '107', '197510292005022003', 'Perempuan', 'Y', 'N', '2023-03-07 22:09:45', '2023-03-07 22:23:33'),
(7, '108', '196809141994122001', 'Perempuan', 'Y', 'Y', '2023-03-07 22:10:32', '2023-03-07 22:23:42'),
(8, '109', '198012102007012014', 'Perempuan', 'Y', 'N', '2023-03-07 22:11:25', '2023-03-07 22:23:52');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_kelas`
--

CREATE TABLE `jadwal_kelas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hari` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu') COLLATE utf8mb4_unicode_ci NOT NULL,
  `mapel` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jampelajaran` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jadwal_kelas`
--

INSERT INTO `jadwal_kelas` (`id`, `hari`, `mapel`, `kelas`, `jampelajaran`, `created_at`, `updated_at`) VALUES
(1, 'Senin', '1', '3', '07:00:00', '2023-03-03 06:34:05', '2023-03-03 06:34:05'),
(2, 'Senin', '4', '1', '07:00:00', '2023-03-03 06:37:16', '2023-03-03 06:37:16'),
(3, 'Senin', '1', '1', '08:00:00', '2023-03-03 06:37:36', '2023-03-03 06:37:36'),
(5, 'Senin', '8', '3', '08:00:00', '2023-03-03 06:51:24', '2023-03-03 06:51:24'),
(6, 'Senin', '4', '2', '07:30:00', '2023-03-12 19:42:33', '2023-03-12 19:42:33'),
(7, 'Senin', '6', '1', '12:10:00', '2023-03-20 04:59:27', '2023-03-20 04:59:27');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_ujians`
--

CREATE TABLE `jadwal_ujians` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mapel` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `kelas` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `urut` char(12) COLLATE utf8_unicode_ci NOT NULL,
  `pilgan` char(12) COLLATE utf8_unicode_ci NOT NULL,
  `essay` char(12) COLLATE utf8_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `lama` char(12) COLLATE utf8_unicode_ci NOT NULL,
  `stat` enum('S','B') COLLATE utf8_unicode_ci NOT NULL,
  `qr` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `jadwal_ujians`
--

INSERT INTO `jadwal_ujians` (`id`, `mapel`, `kelas`, `urut`, `pilgan`, `essay`, `tanggal`, `jam`, `lama`, `stat`, `qr`, `created_at`, `updated_at`) VALUES
(1, '4', '1', '1', '1', '2', '2023-03-01', '13:15:00', '30', 'S', '761f22b2c1593d0bb87e0b606f990ba4974706de', '2023-03-12 05:15:37', '2023-03-13 08:01:07');

-- --------------------------------------------------------

--
-- Table structure for table `jam__pelajarans`
--

CREATE TABLE `jam__pelajarans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jampelajaran` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jawaban_essays`
--

CREATE TABLE `jawaban_essays` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_soal` char(12) COLLATE utf8_unicode_ci NOT NULL,
  `siswa` char(12) COLLATE utf8_unicode_ci NOT NULL,
  `jawaban` longtext COLLATE utf8_unicode_ci NOT NULL,
  `nilai_jawaban` double(16,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `jawaban_essays`
--

INSERT INTO `jawaban_essays` (`id`, `id_soal`, `siswa`, `jawaban`, `nilai_jawaban`, `created_at`, `updated_at`) VALUES
(6, '1', '11', 'di ci', 15.00, '2023-03-13 07:58:15', '2023-03-13 11:33:23'),
(7, '2', '11', 'coba', 23.00, '2023-03-13 07:58:15', '2023-03-13 11:26:26'),
(8, '3', '11', 'Sergio', 10.00, '2023-03-13 07:58:15', '2023-03-13 11:26:36'),
(9, '4', '11', 'di UI BK', 10.00, '2023-03-13 07:58:15', '2023-03-13 11:23:28'),
(10, '5', '11', 'hp', 0.00, '2023-03-13 07:58:15', '2023-03-13 11:27:46');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `namakelas` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahunajaran` year(4) NOT NULL,
  `semester` enum('ganjil','genap') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ganjil',
  `walikelas` char(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `namakelas`, `tahunajaran`, `semester`, `walikelas`, `created_at`, `updated_at`) VALUES
(1, '7E', 2023, 'ganjil', '5', '2023-03-01 15:21:08', '2023-03-07 22:11:51'),
(2, '8B', 2023, 'ganjil', '7', '2023-03-01 15:21:22', '2023-03-09 09:41:19');

-- --------------------------------------------------------

--
-- Table structure for table `kerjakan_soals`
--

CREATE TABLE `kerjakan_soals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `siswa` char(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_ujian` char(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_soal` char(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jawaban` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kuis`
--

CREATE TABLE `kuis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mapel` char(2) COLLATE utf8_unicode_ci NOT NULL,
  `urut` char(2) COLLATE utf8_unicode_ci NOT NULL,
  `siswa` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `nilai` double(3,2) NOT NULL,
  `deskripsi` longtext COLLATE utf8_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `mulai` time NOT NULL,
  `selesai` time NOT NULL,
  `file` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `jawab` varchar(191) COLLATE utf8_unicode_ci NOT NULL DEFAULT '-',
  `stat` enum('S','B') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mapels`
--

CREATE TABLE `mapels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `guru` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_mapel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mapels`
--

INSERT INTO `mapels` (`id`, `guru`, `nama_mapel`, `created_at`, `updated_at`) VALUES
(1, '7', 'Bahasa Inggris', '0000-00-00 00:00:00', '2023-03-07 22:16:40'),
(2, '6', 'IPS', '0000-00-00 00:00:00', '2023-03-07 22:13:08'),
(3, '7', 'Seni dan Prakarya', '0000-00-00 00:00:00', '2023-03-07 22:16:48'),
(4, '8', 'PJOK', '0000-00-00 00:00:00', '2023-03-07 22:18:22'),
(5, '8', 'Pkn', '0000-00-00 00:00:00', '2023-03-07 22:16:27'),
(6, '5', 'Matematika', '0000-00-00 00:00:00', '2023-03-07 22:17:23'),
(7, '7', 'Budaya Literasi', '0000-00-00 00:00:00', '2023-03-07 22:15:21'),
(8, '5', 'Bahasa Indonesia', '0000-00-00 00:00:00', '2023-03-07 22:13:56'),
(9, '6', 'IPA', '0000-00-00 00:00:00', '2023-03-07 22:17:56'),
(10, '5', 'PAI-PB', '0000-00-00 00:00:00', '2023-03-07 22:18:10'),
(12, '5', 'Mulo Bahasa Daerah', '0000-00-00 00:00:00', '2023-03-07 22:21:16'),
(13, '6', 'TIK', '0000-00-00 00:00:00', '2023-03-07 22:21:25');

-- --------------------------------------------------------

--
-- Table structure for table `materis`
--

CREATE TABLE `materis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mapel` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `urut` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tingkat` enum('7','8','9') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahunajaran` year(4) NOT NULL,
  `deskripsi` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `materis`
--

INSERT INTO `materis` (`id`, `judul`, `mapel`, `urut`, `tingkat`, `tahunajaran`, `deskripsi`, `file`, `created_at`, `updated_at`) VALUES
(1, 'Pelajaran bola besar', '4', '1', '7', 2023, '<p>materi tes 1</p>\r\n<p>&nbsp;</p>', '26032023174951.pdf', '2023-03-26 09:49:51', '2023-03-26 09:49:51'),
(2, 'permainan bola kecil', '4', '2', '7', 2023, '<p>bola kecil</p>', '26032023175145.pdf', '2023-03-26 09:51:45', '2023-03-26 09:51:45'),
(3, 'judulnya', '5', '1', '7', 2023, '<p>bdgv&nbsp;</p>', '26032023194859.pdf', '2023-03-26 11:48:59', '2023-03-26 11:48:59'),
(4, 'Permainan Bola Besaree', '4', '3', '7', 2023, '<p>asdasdas</p>', '28032023185509.pdf', '2023-03-28 10:55:09', '2023-03-28 10:55:09');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(28, '2014_10_12_000000_create_users_table', 1),
(29, '2014_10_12_100000_create_password_resets_table', 1),
(30, '2019_08_19_000000_create_failed_jobs_table', 1),
(31, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(32, '2023_01_16_063624_create_roles_table', 1),
(34, '2023_01_17_104834_create_gurus_table', 1),
(35, '2023_01_17_105432_create_siswas_table', 1),
(37, '2023_01_17_103226_create_kelas_table', 2),
(38, '2023_01_17_110450_create_mapels_table', 2),
(39, '2023_01_23_081603_create_jam__pelajarans_table', 2),
(41, '2023_01_23_082025_create_jadwal_kelas_table', 3),
(44, '2023_01_23_122030_create_materis_table', 5),
(56, '2023_02_01_201921_create_kerjakan_soals_table', 8),
(57, '2023_02_15_014538_create_uruts_table', 9),
(62, '2023_02_01_201307_create_soals_table', 11),
(69, '2023_02_18_221301_create_jadwal_ujians_table', 12),
(70, '2023_03_11_132657_create_soal_essays_table', 12),
(72, '2023_02_01_201057_create_ujians_table', 13),
(73, '2023_03_11_132903_create_jawaban_essays_table', 13),
(78, '2023_01_23_121905_create_tugas_table', 14),
(79, '2023_01_28_021050_create_kuis_table', 14),
(80, '2023_03_23_152850_create_notiftugas_table', 15),
(81, '2023_03_23_153040_create_notifmateris_table', 15),
(82, '2023_03_28_171751_create_notifikasigurus_table', 16);

-- --------------------------------------------------------

--
-- Table structure for table `notifikasigurus`
--

CREATE TABLE `notifikasigurus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pesan` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `guru` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `stat` enum('S','B') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `notifikasigurus`
--

INSERT INTO `notifikasigurus` (`id`, `pesan`, `guru`, `stat`, `created_at`, `updated_at`) VALUES
(1, 'Tugas baru telah ditambahkan pada mata pelajaran PJOK', '8', 'S', '2023-03-28 10:03:29', '2023-03-28 10:52:25');

-- --------------------------------------------------------

--
-- Table structure for table `notifmateris`
--

CREATE TABLE `notifmateris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pesan` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `siswa` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `stat` enum('B','S') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `notifmateris`
--

INSERT INTO `notifmateris` (`id`, `pesan`, `siswa`, `stat`, `created_at`, `updated_at`) VALUES
(1, 'Materi baru telah ditambahkan pada mata pelajaran PJOK', '202326001', 'S', '2023-03-26 09:49:51', '2023-03-26 09:51:31'),
(2, 'Materi baru telah ditambahkan pada mata pelajaran PJOK', '202326002', 'S', '2023-03-26 09:49:51', '2023-03-28 10:04:28'),
(3, 'Materi baru telah ditambahkan pada mata pelajaran PJOK', '202326003', 'B', '2023-03-26 09:49:51', '2023-03-26 09:49:51'),
(4, 'Materi baru telah ditambahkan pada mata pelajaran PJOK', '202326004', 'B', '2023-03-26 09:49:51', '2023-03-26 09:49:51'),
(5, 'Materi baru telah ditambahkan pada mata pelajaran PJOK', '202326005', 'B', '2023-03-26 09:49:51', '2023-03-26 09:49:51'),
(6, 'Materi baru telah ditambahkan pada mata pelajaran PJOK', '202326006', 'B', '2023-03-26 09:49:51', '2023-03-26 09:49:51'),
(7, 'Materi baru telah ditambahkan pada mata pelajaran PJOK', '202326007', 'B', '2023-03-26 09:49:51', '2023-03-26 09:49:51'),
(8, 'Materi baru telah ditambahkan pada mata pelajaran PJOK', '202326008', 'B', '2023-03-26 09:49:51', '2023-03-26 09:49:51'),
(9, 'Materi baru telah ditambahkan pada mata pelajaran PJOK', '202326010', 'B', '2023-03-26 09:49:51', '2023-03-26 09:49:51'),
(10, 'Materi baru telah ditambahkan pada mata pelajaran PJOK', '202326011', 'B', '2023-03-26 09:49:51', '2023-03-26 09:49:51'),
(11, 'Materi baru telah ditambahkan pada mata pelajaran PJOK', '202326012', 'B', '2023-03-26 09:49:51', '2023-03-26 09:49:51'),
(12, 'Materi baru telah ditambahkan pada mata pelajaran PJOK', '202326013', 'B', '2023-03-26 09:49:51', '2023-03-26 09:49:51'),
(13, 'Materi baru telah ditambahkan pada mata pelajaran PJOK', '202326014', 'B', '2023-03-26 09:49:51', '2023-03-26 09:49:51'),
(14, 'Materi baru telah ditambahkan pada mata pelajaran PJOK', '202326015', 'B', '2023-03-26 09:49:51', '2023-03-26 09:49:51'),
(15, 'Materi baru telah ditambahkan pada mata pelajaran PJOK', '202326016', 'B', '2023-03-26 09:49:51', '2023-03-26 09:49:51'),
(16, 'Materi baru telah ditambahkan pada mata pelajaran PJOK', '202326017', 'B', '2023-03-26 09:49:51', '2023-03-26 09:49:51'),
(17, 'Materi baru telah ditambahkan pada mata pelajaran PJOK', '202326001', 'S', '2023-03-26 09:51:45', '2023-03-26 09:53:31'),
(18, 'Materi baru telah ditambahkan pada mata pelajaran PJOK', '202326002', 'S', '2023-03-26 09:51:45', '2023-03-28 10:06:29'),
(19, 'Materi baru telah ditambahkan pada mata pelajaran PJOK', '202326003', 'B', '2023-03-26 09:51:45', '2023-03-26 09:51:45'),
(20, 'Materi baru telah ditambahkan pada mata pelajaran PJOK', '202326004', 'B', '2023-03-26 09:51:45', '2023-03-26 09:51:45'),
(21, 'Materi baru telah ditambahkan pada mata pelajaran PJOK', '202326005', 'B', '2023-03-26 09:51:45', '2023-03-26 09:51:45'),
(22, 'Materi baru telah ditambahkan pada mata pelajaran PJOK', '202326006', 'B', '2023-03-26 09:51:45', '2023-03-26 09:51:45'),
(23, 'Materi baru telah ditambahkan pada mata pelajaran PJOK', '202326007', 'B', '2023-03-26 09:51:45', '2023-03-26 09:51:45'),
(24, 'Materi baru telah ditambahkan pada mata pelajaran PJOK', '202326008', 'B', '2023-03-26 09:51:45', '2023-03-26 09:51:45'),
(25, 'Materi baru telah ditambahkan pada mata pelajaran PJOK', '202326010', 'B', '2023-03-26 09:51:45', '2023-03-26 09:51:45'),
(26, 'Materi baru telah ditambahkan pada mata pelajaran PJOK', '202326011', 'B', '2023-03-26 09:51:45', '2023-03-26 09:51:45'),
(27, 'Materi baru telah ditambahkan pada mata pelajaran PJOK', '202326012', 'B', '2023-03-26 09:51:45', '2023-03-26 09:51:45'),
(28, 'Materi baru telah ditambahkan pada mata pelajaran PJOK', '202326013', 'B', '2023-03-26 09:51:45', '2023-03-26 09:51:45'),
(29, 'Materi baru telah ditambahkan pada mata pelajaran PJOK', '202326014', 'B', '2023-03-26 09:51:45', '2023-03-26 09:51:45'),
(30, 'Materi baru telah ditambahkan pada mata pelajaran PJOK', '202326015', 'B', '2023-03-26 09:51:45', '2023-03-26 09:51:45'),
(31, 'Materi baru telah ditambahkan pada mata pelajaran PJOK', '202326016', 'B', '2023-03-26 09:51:45', '2023-03-26 09:51:45'),
(32, 'Materi baru telah ditambahkan pada mata pelajaran PJOK', '202326017', 'B', '2023-03-26 09:51:45', '2023-03-26 09:51:45'),
(33, 'Mata pelajaran PJOK', '202326001', 'B', '2023-03-28 10:55:09', '2023-03-28 10:55:09'),
(34, 'Mata pelajaran PJOK', '202326002', 'S', '2023-03-28 10:55:09', '2023-03-28 10:56:28'),
(35, 'Mata pelajaran PJOK', '202326003', 'B', '2023-03-28 10:55:09', '2023-03-28 10:55:09'),
(36, 'Mata pelajaran PJOK', '202326004', 'B', '2023-03-28 10:55:09', '2023-03-28 10:55:09'),
(37, 'Mata pelajaran PJOK', '202326005', 'B', '2023-03-28 10:55:09', '2023-03-28 10:55:09'),
(38, 'Mata pelajaran PJOK', '202326006', 'B', '2023-03-28 10:55:09', '2023-03-28 10:55:09'),
(39, 'Mata pelajaran PJOK', '202326007', 'B', '2023-03-28 10:55:09', '2023-03-28 10:55:09'),
(40, 'Mata pelajaran PJOK', '202326008', 'B', '2023-03-28 10:55:09', '2023-03-28 10:55:09'),
(41, 'Mata pelajaran PJOK', '202326010', 'B', '2023-03-28 10:55:09', '2023-03-28 10:55:09'),
(42, 'Mata pelajaran PJOK', '202326011', 'B', '2023-03-28 10:55:09', '2023-03-28 10:55:09'),
(43, 'Mata pelajaran PJOK', '202326012', 'B', '2023-03-28 10:55:09', '2023-03-28 10:55:09'),
(44, 'Mata pelajaran PJOK', '202326013', 'B', '2023-03-28 10:55:09', '2023-03-28 10:55:09'),
(45, 'Mata pelajaran PJOK', '202326014', 'B', '2023-03-28 10:55:09', '2023-03-28 10:55:09'),
(46, 'Mata pelajaran PJOK', '202326015', 'B', '2023-03-28 10:55:09', '2023-03-28 10:55:09'),
(47, 'Mata pelajaran PJOK', '202326016', 'B', '2023-03-28 10:55:09', '2023-03-28 10:55:09'),
(48, 'Mata pelajaran PJOK', '202326017', 'B', '2023-03-28 10:55:09', '2023-03-28 10:55:09');

-- --------------------------------------------------------

--
-- Table structure for table `notiftugas`
--

CREATE TABLE `notiftugas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pesan` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `siswa` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `stat` enum('B','S') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `notiftugas`
--

INSERT INTO `notiftugas` (`id`, `pesan`, `siswa`, `stat`, `created_at`, `updated_at`) VALUES
(1, 'Mata pelajaran PJOK', '202326001', 'B', '2023-03-28 10:55:44', '2023-03-28 10:55:44'),
(2, 'Mata pelajaran PJOK', '202326002', 'S', '2023-03-28 10:55:44', '2023-03-28 11:24:28'),
(3, 'Mata pelajaran PJOK', '202326003', 'B', '2023-03-28 10:55:44', '2023-03-28 10:55:44'),
(4, 'Mata pelajaran PJOK', '202326004', 'B', '2023-03-28 10:55:44', '2023-03-28 10:55:44'),
(5, 'Mata pelajaran PJOK', '202326005', 'B', '2023-03-28 10:55:44', '2023-03-28 10:55:44'),
(6, 'Mata pelajaran PJOK', '202326006', 'B', '2023-03-28 10:55:44', '2023-03-28 10:55:44'),
(7, 'Mata pelajaran PJOK', '202326007', 'B', '2023-03-28 10:55:44', '2023-03-28 10:55:44'),
(8, 'Mata pelajaran PJOK', '202326008', 'B', '2023-03-28 10:55:44', '2023-03-28 10:55:44'),
(9, 'Mata pelajaran PJOK', '202326010', 'B', '2023-03-28 10:55:44', '2023-03-28 10:55:44'),
(10, 'Mata pelajaran PJOK', '202326011', 'B', '2023-03-28 10:55:44', '2023-03-28 10:55:44'),
(11, 'Mata pelajaran PJOK', '202326012', 'B', '2023-03-28 10:55:44', '2023-03-28 10:55:44'),
(12, 'Mata pelajaran PJOK', '202326013', 'B', '2023-03-28 10:55:44', '2023-03-28 10:55:44'),
(13, 'Mata pelajaran PJOK', '202326014', 'B', '2023-03-28 10:55:44', '2023-03-28 10:55:44'),
(14, 'Mata pelajaran PJOK', '202326015', 'B', '2023-03-28 10:55:44', '2023-03-28 10:55:44'),
(15, 'Mata pelajaran PJOK', '202326016', 'B', '2023-03-28 10:55:44', '2023-03-28 10:55:44'),
(16, 'Mata pelajaran PJOK', '202326017', 'B', '2023-03-28 10:55:44', '2023-03-28 10:55:44'),
(17, 'Koreksi tugas ke-1 mata pelajaran PJOK', '202326001', 'B', '2023-03-28 12:49:38', '2023-03-28 12:49:38');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', '2023-01-22 22:08:43', '2023-01-22 22:08:43'),
(2, 'guru', '2023-01-22 22:08:43', '2023-01-22 22:08:43'),
(3, 'siswa', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `siswas`
--

CREATE TABLE `siswas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` char(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` char(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `siswas`
--

INSERT INTO `siswas` (`id`, `id_user`, `kelas`, `agama`, `jenis_kelamin`, `alamat`, `created_at`, `updated_at`) VALUES
(202326001, '11', '1', 'Islam', 'Perempuan', 'Parepare', '0000-00-00 00:00:00', '2023-03-07 21:24:33'),
(202326002, '12', '1', 'Islam', 'Perempuan', 'Parepare', '0000-00-00 00:00:00', '2023-03-07 22:25:35'),
(202326003, '13', '1', 'Islam', 'Laki-laki', 'Parepare', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(202326004, '14', '1', 'Islam', 'Perempuan', 'Parepare', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(202326005, '15', '1', 'Islam', 'Laki-laki', 'Parepare', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(202326006, '16', '1', 'Islam', 'Perempuan', 'Parepare', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(202326007, '17', '1', 'Islam', 'Laki-laki', 'Parepare', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(202326008, '18', '1', 'Islam', 'Perempuan', 'Parepare', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(202326009, '19', '2', 'Islam', 'Laki-laki', 'Parepare', '0000-00-00 00:00:00', '2023-03-12 19:43:01'),
(202326010, '20', '1', 'Islam', 'Perempuan', 'Parepare', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(202326011, '21', '1', 'Islam', 'Laki-laki', 'Parepare', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(202326012, '22', '1', 'Islam', 'Perempuan', 'Parepare', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(202326013, '23', '1', 'Islam', 'Laki-laki', 'Parepare', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(202326014, '24', '1', 'Islam', 'Perempuan', 'Parepare', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(202326015, '25', '1', 'Islam', 'Laki-laki', 'Parepare', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(202326016, '26', '1', 'Islam', 'Perempuan', 'Parepare', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(202326017, '27', '1', 'Islam', 'Laki-laki', 'Parepare', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `soals`
--

CREATE TABLE `soals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kelompoksoal` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `urut` char(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `soal` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `a` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `b` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `d` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jawaban_benar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `soals`
--

INSERT INTO `soals` (`id`, `kelompoksoal`, `urut`, `soal`, `a`, `b`, `c`, `d`, `jawaban_benar`, `created_at`, `updated_at`) VALUES
(1, '1', '1', 'bentuk latihan yang mengharuskan seseorang melakukan gerakan dengan cepat dan mengubah arah dengan tangkas tanpa kehilangan keseimbangan disebut latihan ', 'daya ledak  ', 'kecepatan  ', 'kekuatan', 'kelincahan', 'd', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, '1', '2', 'atlet berikut yang memerlukan unsur kelincahan yang baik adal', 'tinju', 'bola voli', 'sepak bola', 'angkat besi', 'c', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, '1', '3', 'latihan lari bolak-balik untuk mengembangkan daya tahan dan kelincahan dikenal dengan istilah', 'squat jump', 'shuttle run', 'interval traning', 'squart thrust', 'b', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, '1', '4', 'tingkat kelincahan seseorang sangat ditentukan oleh', 'kecepatan dan kelentukan', 'kekuatan otot', 'kecepatan ', 'daya tahan', 'a', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, '1', '5', 'seseorang yang memiliki tingkat kebugaran jasmani yang baik akan terhindar dari kemungkinan', 'gangguan kesehatan', 'cidera saat olahraga', 'pingsan akibat olahraga', 'kram saat olahraga', 'a', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, '1', '6', 'pakaian yang dikenakan dalam pertandingan pencak silat yaitu warna', 'hijau', 'putih', 'merah', 'hitam', 'd', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, '1', '7', 'pelopor pencak silat indonesia adalah', 'mr. bambang sumantri, sh', 'mr. muhammad yunus, sh', 'mr. wongsonegoro, sh', 'mr. abdul muis, sh', 'c', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, '1', '8', 'dibawah ini yang bukan teknik gerak dasar pencak silat adalah ', 'teknik kuda-kuda', 'teknik melompat', 'teknik tendangan', 'teknik tangkisan', 'b', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, '1', '9', 'gerakan serangan dengan menggunakan tungkai sering disebut juga dengan ', 'pukulan ', 'tendangan ', 'tangkisan', 'elakan', 'b', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, '1', '10', 'yang bukan teknik tendangan dalam pencak silat yaitu ', 'tendangan menyilang', 'tendangan lurus', 'tendangan t', 'tendangan lurus', 'a', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, '1', '11', 'tendangan yang dilakukan dalam lintasan setengah lingkaran adalah tendangan', 'sabit', 'melingkar', 'silang', 'tendangan t', 'a', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, '1', '12', 'serangan yang dilakukan dengan menggunakan tangan kosong sebagai komponen utamanya adalah', 'jatuhan ', 'hindaran ', 'elakan ', 'pukulan', 'd', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, '1', '13', 'salah satu bentuk serangan yang dipergunakan untuk jarak jauh yaitu', 'pukulan ', 'hindaran ', 'tangkisan', 'tendangan', 'd', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, '1', '14', 'jenis pukulan yang mana ayunan tangan salah satunya berbentuk kepalan kearah sasaran ulu hati, dan tangan yang satu lagi tetap menutup arah sasaran lawan dinamakan pukulan ', 'melingkar ', 'bandul ', 'lurus', 'tegak', 'b', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, '1', '15', 'salah satu tangan memukul kearah depan, sasaran yaitu dada si lawan dan tangan satunya lagi menutup arah point, yaitu sasaran perut keatas', 'melingkar ', 'bandul ', 'lurus', 'tegak', 'c', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, '1', '16', 'ketika pemain memegang peluru, titik berat peluru ada pada ', 'seluruh jari tangan', 'ibu jari', 'telapak tangan', 'ibu jari dan jari kelingking', 'c', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, '1', '17', 'posisi awal tolak peluru awalan menyamping yaitu', 'sektor lemparan di samping kiri', 'menghadap arah tolakan', 'membelakangi arah tolaka', 'sektor lemparan di samping kanan', 'a', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, '1', '18', 'ketika melakukan tolak peluru, fungsi tangan kiri yang tidak memegang peluru yaitu untuk ', 'menjaga keseimbangan', 'menambah kekuatan', 'melindungi peluru', 'variasi gaya', 'a', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, '1', '19', 'gaya tolak peluru dengan awalan menyamping dinamakan ', 'gaya flop', 'gaya obrien   ', 'gaya ortodock', 'gaya stradle', 'c', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, '1', '20', 'salah satu gaya tolak peluru dengan awalan membelakangi tolakan dinamakan ', 'gaya flop', 'gaya obrien   ', 'gaya ortodock', 'gaya stradle', 'b', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, '1', '21', 'lama waktu permainan sepak bola adala', '2 x 30 menit  ', '2 x 40 menit', '2 x 45 menit', '2 x 50 menit', 'c', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, '1', '22', 'teknik yang digunakan dalam permainan sepak bola untuk melakukan operan jarak dekat adalah ', 'kaki bagian dalam', 'kaki bagian luar', 'punggung kaki', 'kura-kura kaki', 'a', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, '1', '23', 'teknik yang digunakan dalam sepak bola untuk melakukan operan jarak jauh adalah ', 'kaki bagian dalam', 'kaki bagian luar', 'punggung kaki', 'kura-kura kaki', 'c', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, '1', '24', 'posisi badan saat menendang bola jarak jauh adalah ', 'dimiringkan ke samping kiri', 'dimiringkan ke samping kanan', 'dicondongkan ke belakang', 'dicondongkan ke depan', 'd', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, '1', '25', 'teknik yang digunakan untuk menghentikan bola yang bergulir di atas tanah dalam permainan sepak bola adalah ', 'menahan dengan kaki bagian dalam', 'menahan dengan telapak kaki', 'menahan dengan kaki bagian luar', 'menahan dengan paha', 'b', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, '1', '26', 'induk organisasi bola voli nasional adalah ', 'ipsi', 'perbasi', 'pbvsi', 'pssi', 'c', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, '1', '27', 'permainan bola voli diciptakan oleh ', 'dr. luther', 'per hendrick link', 'william g. morgan', 'dr. james a. naismith', 'c', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, '1', '28', 'teknik dasar bola voli, meliputi ', 'passing, lay-up, dan menangkap', 'passing, servis, dan smash', 'menggiring, menangkap, dan menembak', 'menendang, menggiring, dan menyundul bola', 'b', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, '1', '29', 'teknik permainan bola voli yang bertujuan untuk mengambil bola hasil servis lawan dinamakan', 'passing', 'smash', 'blocking', 'servis', 'a', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, '1', '30', 'servis dalam permainan bola voli hanya dapat dilakukan pada', 'tempat bebas', 'menurut kesukaan yang melakukan servis', 'kotak servis 6 meter', 'belakang garis servis selebar 9 meter', 'd', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, '1', '31', 'awalan, kaki lurus dengan bola, kaki tumpu diletakkan di samping bola dengan jari-jari menghadap ke depan dan lutut sedikit ditekuk, gerakan ini merupakan awalan menendang bola dengan ', 'kaki bagian dalam', 'kaki bagian luar', 'punggung kaki', 'tumit', 'b', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, '1', '32', 'berikut ini adalah gerakan menghentikan bola dalam permainan sepak bola, kecuali', 'menghentikan bola dengan paha', 'menghentikan bola dengan tumit', 'menghentikan bola dengan tumit', 'menghentikan bola dengan telapak kaki', 'd', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, '1', '33', 'kaki yang digunakan untuk menghentikan bola diputar keluar, sehingga kaki bagian dalam menghadap kearah datangnya bola, gerakan ini merupakan cara menghentikan bola dengan menggunakan ', 'kaki bagian luar', 'kaki bagian dalam', 'tumit', 'punggung kaki', 'd', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, '1', '34', 'permainan sepak bola merupakan permainan beregu yang masing-masing regu terdiri dari', 'lima pemain', 'delapan pemain   ', 'sebelas pemain', 'sepuluh pemain', 'c', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, '1', '35', 'badan bagian atas dicondongkan ke belakang dengan dada ditarik ke depan, gerakan ini merupakan cara menghentikan bola dengan menggunakan ', 'paha', 'dada', 'kaki bagian luar', 'kepala', 'b', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, '1', '36', 'teknik dalam permainan sepak bola, yang digunakan untuk melakukan operan dengan jarak yang dekat adalah', 'kaki bagian dalam', 'kaki bagian luar', 'tumit', 'punggung kaki', 'a', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, '1', '37', 'berikut ini adalah teknik-teknik dasar dalam permaianan sepak bola, kecuali', 'melatih ', 'mengumpan', 'menggiring', 'menendang', 'a', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, '1', '38', 'teknik menggiring bola dapat dilakukan dengan menggunakan ', 'kaki bagian dalam', 'ujung sikut', 'telapak kaki', 'ujung bagian belakang kaki', 'a', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `soal_essays`
--

CREATE TABLE `soal_essays` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kelompok_soal` char(12) COLLATE utf8_unicode_ci NOT NULL,
  `soal` char(12) COLLATE utf8_unicode_ci NOT NULL,
  `urut` char(12) COLLATE utf8_unicode_ci NOT NULL,
  `bobot` char(12) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `soal_essays`
--

INSERT INTO `soal_essays` (`id`, `kelompok_soal`, `soal`, `urut`, `bobot`, `created_at`, `updated_at`) VALUES
(2, '1', 'sadfkpj', '2', '23', '2023-03-12 05:39:27', '2023-03-12 05:39:27'),
(3, '1', 'sgitu', '3', '10', '2023-03-13 05:53:52', '2023-03-13 05:53:52'),
(4, '1', 'segini', '4', '10', '2023-03-13 05:54:02', '2023-03-13 05:54:02');

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mapel` char(2) COLLATE utf8_unicode_ci NOT NULL,
  `urut` char(2) COLLATE utf8_unicode_ci NOT NULL,
  `siswa` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `nilai` double(16,2) NOT NULL,
  `mulai` datetime NOT NULL,
  `deskripsi` longtext COLLATE utf8_unicode_ci NOT NULL,
  `selesai` datetime NOT NULL,
  `file` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `jawab` varchar(191) COLLATE utf8_unicode_ci NOT NULL DEFAULT '-',
  `keterangan` varchar(191) COLLATE utf8_unicode_ci NOT NULL DEFAULT '-',
  `stat` enum('S','B') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tugas`
--

INSERT INTO `tugas` (`id`, `mapel`, `urut`, `siswa`, `nilai`, `mulai`, `deskripsi`, `selesai`, `file`, `jawab`, `keterangan`, `stat`, `created_at`, `updated_at`) VALUES
(1, '4', '1', '202326001', 0.00, '2023-03-26 00:00:00', 'hjbzdjlcvxx hknm', '2023-04-03 00:00:00', '-', 'ryfyy', 'jawabannya kurang', 'B', '2023-03-26 10:07:29', '2023-03-28 12:49:38'),
(2, '4', '1', '202326002', 10.00, '2023-03-26 00:00:00', 'hjbzdjlcvxx hknm', '2023-04-03 00:00:00', '-', 'ffff', '-', 'S', '2023-03-26 10:07:29', '2023-03-28 10:54:23'),
(3, '4', '1', '202326003', 0.00, '2023-03-26 00:00:00', 'hjbzdjlcvxx hknm', '2023-04-03 00:00:00', '-', '-', '-', 'B', '2023-03-26 10:07:29', '2023-03-26 10:07:29'),
(4, '4', '1', '202326004', 0.00, '2023-03-26 00:00:00', 'hjbzdjlcvxx hknm', '2023-04-03 00:00:00', '-', '-', '-', 'B', '2023-03-26 10:07:29', '2023-03-26 10:07:29'),
(5, '4', '1', '202326005', 0.00, '2023-03-26 00:00:00', 'hjbzdjlcvxx hknm', '2023-04-03 00:00:00', '-', '-', '-', 'B', '2023-03-26 10:07:29', '2023-03-26 10:07:29'),
(6, '4', '1', '202326006', 0.00, '2023-03-26 00:00:00', 'hjbzdjlcvxx hknm', '2023-04-03 00:00:00', '-', '-', '-', 'B', '2023-03-26 10:07:29', '2023-03-26 10:07:29'),
(7, '4', '1', '202326007', 0.00, '2023-03-26 00:00:00', 'hjbzdjlcvxx hknm', '2023-04-03 00:00:00', '-', '-', '-', 'B', '2023-03-26 10:07:29', '2023-03-26 10:07:29'),
(8, '4', '1', '202326008', 0.00, '2023-03-26 00:00:00', 'hjbzdjlcvxx hknm', '2023-04-03 00:00:00', '-', '-', '-', 'B', '2023-03-26 10:07:29', '2023-03-26 10:07:29'),
(9, '4', '1', '202326010', 0.00, '2023-03-26 00:00:00', 'hjbzdjlcvxx hknm', '2023-04-03 00:00:00', '-', '-', '-', 'B', '2023-03-26 10:07:29', '2023-03-26 10:07:29'),
(10, '4', '1', '202326011', 0.00, '2023-03-26 00:00:00', 'hjbzdjlcvxx hknm', '2023-04-03 00:00:00', '-', '-', '-', 'B', '2023-03-26 10:07:29', '2023-03-26 10:07:29'),
(11, '4', '1', '202326012', 0.00, '2023-03-26 00:00:00', 'hjbzdjlcvxx hknm', '2023-04-03 00:00:00', '-', '-', '-', 'B', '2023-03-26 10:07:29', '2023-03-26 10:07:29'),
(12, '4', '1', '202326013', 0.00, '2023-03-26 00:00:00', 'hjbzdjlcvxx hknm', '2023-04-03 00:00:00', '-', '-', '-', 'B', '2023-03-26 10:07:29', '2023-03-26 10:07:29'),
(13, '4', '1', '202326014', 0.00, '2023-03-26 00:00:00', 'hjbzdjlcvxx hknm', '2023-04-03 00:00:00', '-', '-', '-', 'B', '2023-03-26 10:07:29', '2023-03-26 10:07:29'),
(14, '4', '1', '202326015', 0.00, '2023-03-26 00:00:00', 'hjbzdjlcvxx hknm', '2023-04-03 00:00:00', '-', '-', '-', 'B', '2023-03-26 10:07:29', '2023-03-26 10:07:29'),
(15, '4', '1', '202326016', 0.00, '2023-03-26 00:00:00', 'hjbzdjlcvxx hknm', '2023-04-03 00:00:00', '-', '-', '-', 'B', '2023-03-26 10:07:29', '2023-03-26 10:07:29'),
(16, '4', '1', '202326017', 0.00, '2023-03-26 00:00:00', 'hjbzdjlcvxx hknm', '2023-04-03 00:00:00', '-', '-', '-', 'B', '2023-03-26 10:07:29', '2023-03-26 10:07:29'),
(17, '4', '2', '202326001', 0.00, '2023-03-27 00:00:00', 'dfs', '2023-03-28 00:00:00', '-', '-', '-', 'B', '2023-03-26 11:50:31', '2023-03-26 11:50:31'),
(18, '4', '2', '202326002', 0.00, '2023-03-27 00:00:00', 'dfs', '2023-03-28 00:00:00', '-', '-', '-', 'B', '2023-03-26 11:50:31', '2023-03-26 11:50:31'),
(19, '4', '2', '202326003', 0.00, '2023-03-27 00:00:00', 'dfs', '2023-03-28 00:00:00', '-', '-', '-', 'B', '2023-03-26 11:50:31', '2023-03-26 11:50:31'),
(20, '4', '2', '202326004', 0.00, '2023-03-27 00:00:00', 'dfs', '2023-03-28 00:00:00', '-', '-', '-', 'B', '2023-03-26 11:50:31', '2023-03-26 11:50:31'),
(21, '4', '2', '202326005', 0.00, '2023-03-27 00:00:00', 'dfs', '2023-03-28 00:00:00', '-', '-', '-', 'B', '2023-03-26 11:50:31', '2023-03-26 11:50:31'),
(22, '4', '2', '202326006', 0.00, '2023-03-27 00:00:00', 'dfs', '2023-03-28 00:00:00', '-', '-', '-', 'B', '2023-03-26 11:50:31', '2023-03-26 11:50:31'),
(23, '4', '2', '202326007', 0.00, '2023-03-27 00:00:00', 'dfs', '2023-03-28 00:00:00', '-', '-', '-', 'B', '2023-03-26 11:50:31', '2023-03-26 11:50:31'),
(24, '4', '2', '202326008', 0.00, '2023-03-27 00:00:00', 'dfs', '2023-03-28 00:00:00', '-', '-', '-', 'B', '2023-03-26 11:50:31', '2023-03-26 11:50:31'),
(25, '4', '2', '202326010', 0.00, '2023-03-27 00:00:00', 'dfs', '2023-03-28 00:00:00', '-', '-', '-', 'B', '2023-03-26 11:50:31', '2023-03-26 11:50:31'),
(26, '4', '2', '202326011', 0.00, '2023-03-27 00:00:00', 'dfs', '2023-03-28 00:00:00', '-', '-', '-', 'B', '2023-03-26 11:50:31', '2023-03-26 11:50:31'),
(27, '4', '2', '202326012', 0.00, '2023-03-27 00:00:00', 'dfs', '2023-03-28 00:00:00', '-', '-', '-', 'B', '2023-03-26 11:50:31', '2023-03-26 11:50:31'),
(28, '4', '2', '202326013', 0.00, '2023-03-27 00:00:00', 'dfs', '2023-03-28 00:00:00', '-', '-', '-', 'B', '2023-03-26 11:50:31', '2023-03-26 11:50:31'),
(29, '4', '2', '202326014', 0.00, '2023-03-27 00:00:00', 'dfs', '2023-03-28 00:00:00', '-', '-', '-', 'B', '2023-03-26 11:50:31', '2023-03-26 11:50:31'),
(30, '4', '2', '202326015', 0.00, '2023-03-27 00:00:00', 'dfs', '2023-03-28 00:00:00', '-', '-', '-', 'B', '2023-03-26 11:50:31', '2023-03-26 11:50:31'),
(31, '4', '2', '202326016', 0.00, '2023-03-27 00:00:00', 'dfs', '2023-03-28 00:00:00', '-', '-', '-', 'B', '2023-03-26 11:50:31', '2023-03-26 11:50:31'),
(32, '4', '2', '202326017', 0.00, '2023-03-27 00:00:00', 'dfs', '2023-03-28 00:00:00', '-', '-', '-', 'B', '2023-03-26 11:50:31', '2023-03-26 11:50:31'),
(33, '4', '3', '202326001', 0.00, '2023-03-28 00:00:00', 'asjkdbasklkmn', '2023-03-29 00:00:00', '-', '-', '-', 'B', '2023-03-28 10:55:44', '2023-03-28 10:55:44'),
(34, '4', '3', '202326002', 0.00, '2023-03-28 00:00:00', 'asjkdbasklkmn', '2023-03-29 00:00:00', '-', '-', '-', 'B', '2023-03-28 10:55:44', '2023-03-28 10:55:44'),
(35, '4', '3', '202326003', 0.00, '2023-03-28 00:00:00', 'asjkdbasklkmn', '2023-03-29 00:00:00', '-', '-', '-', 'B', '2023-03-28 10:55:44', '2023-03-28 10:55:44'),
(36, '4', '3', '202326004', 0.00, '2023-03-28 00:00:00', 'asjkdbasklkmn', '2023-03-29 00:00:00', '-', '-', '-', 'B', '2023-03-28 10:55:44', '2023-03-28 10:55:44'),
(37, '4', '3', '202326005', 0.00, '2023-03-28 00:00:00', 'asjkdbasklkmn', '2023-03-29 00:00:00', '-', '-', '-', 'B', '2023-03-28 10:55:44', '2023-03-28 10:55:44'),
(38, '4', '3', '202326006', 0.00, '2023-03-28 00:00:00', 'asjkdbasklkmn', '2023-03-29 00:00:00', '-', '-', '-', 'B', '2023-03-28 10:55:44', '2023-03-28 10:55:44'),
(39, '4', '3', '202326007', 0.00, '2023-03-28 00:00:00', 'asjkdbasklkmn', '2023-03-29 00:00:00', '-', '-', '-', 'B', '2023-03-28 10:55:44', '2023-03-28 10:55:44'),
(40, '4', '3', '202326008', 0.00, '2023-03-28 00:00:00', 'asjkdbasklkmn', '2023-03-29 00:00:00', '-', '-', '-', 'B', '2023-03-28 10:55:44', '2023-03-28 10:55:44'),
(41, '4', '3', '202326010', 0.00, '2023-03-28 00:00:00', 'asjkdbasklkmn', '2023-03-29 00:00:00', '-', '-', '-', 'B', '2023-03-28 10:55:44', '2023-03-28 10:55:44'),
(42, '4', '3', '202326011', 0.00, '2023-03-28 00:00:00', 'asjkdbasklkmn', '2023-03-29 00:00:00', '-', '-', '-', 'B', '2023-03-28 10:55:44', '2023-03-28 10:55:44'),
(43, '4', '3', '202326012', 0.00, '2023-03-28 00:00:00', 'asjkdbasklkmn', '2023-03-29 00:00:00', '-', '-', '-', 'B', '2023-03-28 10:55:44', '2023-03-28 10:55:44'),
(44, '4', '3', '202326013', 0.00, '2023-03-28 00:00:00', 'asjkdbasklkmn', '2023-03-29 00:00:00', '-', '-', '-', 'B', '2023-03-28 10:55:44', '2023-03-28 10:55:44'),
(45, '4', '3', '202326014', 0.00, '2023-03-28 00:00:00', 'asjkdbasklkmn', '2023-03-29 00:00:00', '-', '-', '-', 'B', '2023-03-28 10:55:44', '2023-03-28 10:55:44'),
(46, '4', '3', '202326015', 0.00, '2023-03-28 00:00:00', 'asjkdbasklkmn', '2023-03-29 00:00:00', '-', '-', '-', 'B', '2023-03-28 10:55:44', '2023-03-28 10:55:44'),
(47, '4', '3', '202326016', 0.00, '2023-03-28 00:00:00', 'asjkdbasklkmn', '2023-03-29 00:00:00', '-', '-', '-', 'B', '2023-03-28 10:55:44', '2023-03-28 10:55:44'),
(48, '4', '3', '202326017', 0.00, '2023-03-28 00:00:00', 'asjkdbasklkmn', '2023-03-29 00:00:00', '-', '-', '-', 'B', '2023-03-28 10:55:44', '2023-03-28 10:55:44');

-- --------------------------------------------------------

--
-- Table structure for table `ujians`
--

CREATE TABLE `ujians` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mapel` char(2) COLLATE utf8_unicode_ci NOT NULL,
  `urut` char(2) COLLATE utf8_unicode_ci NOT NULL,
  `id_soal` char(2) COLLATE utf8_unicode_ci NOT NULL,
  `siswa` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `nilai` double(16,2) NOT NULL,
  `deskripsi` longtext COLLATE utf8_unicode_ci NOT NULL,
  `mulai` time NOT NULL,
  `selesai` time NOT NULL,
  `stat` enum('S','B') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ujians`
--

INSERT INTO `ujians` (`id`, `mapel`, `urut`, `id_soal`, `siswa`, `nilai`, `deskripsi`, `mulai`, `selesai`, `stat`, `created_at`, `updated_at`) VALUES
(2, '4', '1', '1', '11', 60.00, '761f22b2c1593d0bb87e0b606f990ba4974706de', '15:58:15', '15:58:15', 'S', '2023-03-13 07:58:15', '2023-03-13 07:58:15');

-- --------------------------------------------------------

--
-- Table structure for table `uruts`
--

CREATE TABLE `uruts` (
  `id_mapel` char(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `urut` char(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Dandre Becker', 'aufderhar.brett@example.com', '2023-01-22 22:08:43', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 2, 'Mt4mPOEhX4', '2023-01-22 22:08:43', '2023-01-22 22:08:43'),
(2, 'Prof. Demetris Barrows', 'swift.casimer@example.org', '2023-01-22 22:08:43', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 'WmYSioy8QNj2SYKyIiU45aX4MhJOmmZuGZncrnlKZQzALooGSCkgUgSqVWSU', '2023-01-22 22:08:43', '2023-01-22 22:08:43'),
(3, 'Ariane Becker', 'admin@mail.com', '2023-01-22 22:08:43', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 'fek0KcrDIyc8QrDI3P9frmHwsCdiprW8cp5mbbqvVYXag5N0tvG78ivnImmm', '2023-01-22 22:08:43', '2023-01-22 22:08:43'),
(4, 'Helen Predovic', 'smitham.alvah@example.com', '2023-01-22 22:08:43', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 'VM3aDTqJjD', '2023-01-22 22:08:43', '2023-01-22 22:08:43'),
(5, 'Dr. Taylor Glover V', 'klocko.dejah@example.org', '2023-01-22 22:08:43', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 'Nf9Ah361b4', '2023-01-22 22:08:43', '2023-01-22 22:08:43'),
(11, 'Andi Zahrah Athira', 'siswa11@mail.com', '0000-00-00 00:00:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 3, '', '0000-00-00 00:00:00', '2023-03-07 21:24:33'),
(12, 'Hafidzhah Umaimah', 'siswa12@mail.com', '0000-00-00 00:00:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 3, '', '0000-00-00 00:00:00', '2023-03-07 22:25:35'),
(13, 'Afia Dzil Athifa', 'siswa13@mail.com', '0000-00-00 00:00:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 3, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'Afwa Dzul Agilah', 'siswa14@mail.com', '0000-00-00 00:00:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 3, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'Alia Asnita', 'siswa15@mail.com', '0000-00-00 00:00:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 3, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 'Alya Amani Amandini', 'siswa16@mail.com', '0000-00-00 00:00:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 3, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 'April Hidayanti', 'siswa17@mail.com', '0000-00-00 00:00:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 3, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 'Arjuna Sastrabahu', 'siswa18@mail.com', '0000-00-00 00:00:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 3, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 'Arumy Baharuddin', 'siswa19@mail.com', '0000-00-00 00:00:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 3, '', '0000-00-00 00:00:00', '2023-03-12 19:43:01'),
(20, 'Dimas Bayu Anggara', 'siswa20@mail.com', '0000-00-00 00:00:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 3, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 'Fauzan Nur Raffi Mansyur', 'siswa21@mail.com', '0000-00-00 00:00:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 3, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 'Fira Anggreni Ilham', 'siswa22@mail.com', '0000-00-00 00:00:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 3, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 'Hafidzhah Umaimah', 'siswa23@mail.com', '0000-00-00 00:00:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 3, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 'Muhammad Ezzar', 'siswa24@mail.com', '0000-00-00 00:00:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 3, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 'Muhammad Fajrul Zaky', 'siswa25@mail.com', '0000-00-00 00:00:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 3, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 'Muhammad Fikri', 'siswa26@mail.com', '0000-00-00 00:00:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 3, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 'Muhammad Hafied Akbar', 'siswa27@mail.com', '0000-00-00 00:00:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 3, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(106, 'Gustinah Laewang, S. Pd', 'gustinah@mail.com', NULL, '$2y$10$OMXZir8BnfoM63id5Ox9heqNJCdCOtgbpgNOPhXGiu..rFAFvITqm', 2, NULL, '2023-03-07 22:05:12', '2023-03-07 22:23:25'),
(107, 'Masnah, S. Pd', 'masnah@mail.com', NULL, '$2y$10$YnnDoTrH8mF73UrxaQuge.RU5/UQ4pBHeIBtVKvkfGC/nSvGlJ.pm', 2, NULL, '2023-03-07 22:09:45', '2023-03-07 22:23:33'),
(108, 'Rahmaniar, S. Pd', 'rahmaniar@mail.com', NULL, '$2y$10$8ysuj9RE.EKN8.HCDyiiv.v..c1ugF9zgU.BkOlHXEgjtQw43R.PO', 2, NULL, '2023-03-07 22:10:32', '2023-03-07 22:23:42'),
(109, 'Darmawati, S. Pd', 'darmawati@mail.com', NULL, '$2y$10$Ek5IDmI.C6WR72wiuRXgsObSnGa7dNrMCjsBtMnwJq2Jb80qlw0gG', 2, NULL, '2023-03-07 22:11:25', '2023-03-07 22:23:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `gurus`
--
ALTER TABLE `gurus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal_kelas`
--
ALTER TABLE `jadwal_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal_ujians`
--
ALTER TABLE `jadwal_ujians`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jam__pelajarans`
--
ALTER TABLE `jam__pelajarans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jawaban_essays`
--
ALTER TABLE `jawaban_essays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kerjakan_soals`
--
ALTER TABLE `kerjakan_soals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kuis`
--
ALTER TABLE `kuis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mapels`
--
ALTER TABLE `mapels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materis`
--
ALTER TABLE `materis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifikasigurus`
--
ALTER TABLE `notifikasigurus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifmateris`
--
ALTER TABLE `notifmateris`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notiftugas`
--
ALTER TABLE `notiftugas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_role_name_unique` (`role_name`);

--
-- Indexes for table `siswas`
--
ALTER TABLE `siswas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `soals`
--
ALTER TABLE `soals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `soal_essays`
--
ALTER TABLE `soal_essays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ujians`
--
ALTER TABLE `ujians`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gurus`
--
ALTER TABLE `gurus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `jadwal_kelas`
--
ALTER TABLE `jadwal_kelas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jadwal_ujians`
--
ALTER TABLE `jadwal_ujians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jam__pelajarans`
--
ALTER TABLE `jam__pelajarans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jawaban_essays`
--
ALTER TABLE `jawaban_essays`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kerjakan_soals`
--
ALTER TABLE `kerjakan_soals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kuis`
--
ALTER TABLE `kuis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mapels`
--
ALTER TABLE `mapels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `materis`
--
ALTER TABLE `materis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `notifikasigurus`
--
ALTER TABLE `notifikasigurus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notifmateris`
--
ALTER TABLE `notifmateris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `notiftugas`
--
ALTER TABLE `notiftugas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `siswas`
--
ALTER TABLE `siswas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202326041;

--
-- AUTO_INCREMENT for table `soals`
--
ALTER TABLE `soals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `soal_essays`
--
ALTER TABLE `soal_essays`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `ujians`
--
ALTER TABLE `ujians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
