-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 18, 2025 at 05:58 PM
-- Server version: 5.7.39
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `teknologi-pilar-bangsa`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(64) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `email`) VALUES
(0, 'admin', '$2y$10$B0nkf7IdhAoemUPdEemA8uoO3SjnaphUDRGQLsGeGqYnlTxTdnduC', 'admin@gmail.com'),
(1, 'admin', '$2a$12$ZyXm148wWv5rgYE7tLtQLePif1Qd9N3fCUZNMXi0MeSRfJSJWmjbu', 'teknologi.pilarbangsa@yahoo.com');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `nip` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nama_guru` varchar(128) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_mapel` varchar(64) NOT NULL,
  `id_mapel` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`nip`, `email`, `nama_guru`, `password`, `nama_mapel`, `id_mapel`) VALUES
('1262768669230173', 'ida45faridah@gmail.com', 'IDA FARIDAH', '$2a$12$Za6n93xdT74uLD51cYKWVu9wkUpmtZKvF6JTruxunczsF6WmqyelO', 'Prakarya', 12),
('2637764665130252', 'sobri22122007@gmail.com', 'SOBRI', '$2a$12$Jksw4At51ii2bx8X9RhzGOEcwba3rnAjLvd.Y1ueX4UZajnGAzC1y', 'Pendidikan Jasmani', 3),
('3359762663130193', 'sa8876668@gmail.com', 'MOH. SYAMSUL MAARIF', '$2a$12$sW0Xe.BwLPYbl3T.2AO2wuucttU1kPC/EKm246CSOudActEVgw0/6', 'Rancang Bangun Jaringan', 13),
('3436771672130022', 'wisnu.reza@yahoo.com', 'WISNU REZA PRANANDA', '$2a$12$Eq1YvMRTCVotSw6zlbCIDORZ3ZyW2yzUvUL9dJJ6ciCH42Z/uEEl.', 'Gambar Teknik', 16),
('3440769670130013', 'nedivagulo@gmail.com', 'YUPITER CARLIS GULO', '$2a$12$G5Pb0NhKOm18eJsWhrAp1uS0RiQTiTlsRu3SHkTGCm4h3A4Q3QFDW', 'Komunikasi Digital', 7),
('3442768669210013', 'noviastriyani90@gmail.com', 'NOVI ASTRIYANI', '$2a$12$KsZuKLtwiCD1uN1GlJ48LuEe7Zib0Ffabvw44Zv.ZVD5mukR9OiGi', 'Dasar-Dasar Otomotif', 14),
('4048766667137073', 'mulyadi88@gmail.com', 'MULYADI', '$2a$12$it9D2sMZ8kEDK2UlgcmFAu7Sarl31Q/zja4x.PbHVMw1nJW9MrXcO', '', NULL),
('4262769670130023', 'Surbeinrangkuti@gmail.com', 'MHD.SURBEIN', '$2a$12$u07XnomwKXp.YHMfaxeD4ONAqluw9F9Yn.gSro9dBbgZ0l46P6ny.', 'Pemrograman Dasar', 11),
('447770671130293', 'mohamadfadilah1lima@gmail.com', 'MOHAMAD FADILAH', '$2a$12$tmrG2G/eIH3K5OkCi47A.ecOhB/7VLBFuSfyEZVGZPpX8s9m7yzkW', 'Pendidikan Agama Islam', 4),
('4536768669130183', 'aepp.pb@gmail.com', 'SAEPUDIN', '$2a$12$mFOWRj0VfcP5S7nzXvMow.XE05bMc/FW6/pCgncARysNPtrx8XNRe', 'Dasar Desain Grafis', 10),
('463774675230162', 'zhurayda01@gmail.com', 'ZHURAYDA', '$2a$12$WzAR/biFEIeOd9NqMKVWFewV8x5XSpaDOdaj3vWmxs8a.OxwtHTwa', 'Pengolahan Audio & Video', 8),
('51767670130083', 'ga416739@gmail.com', 'GUNAWAN', '$2a$12$EcrnQ.IpfdbU1b6pWc0gBuXihDkr8rPpiITSNSa2YRVBz7DJhYr86', 'Matematika', 2),
('7133762666300003', 'ernawatipb2020@gmail.com', 'ERNAWATI', '$2a$12$uIya7tumarwaiiHtRe6S2OYQP6wZ5ivC1PChYCyE.Bc3NJPhfW1Iu', '', NULL),
('7147771672230153', 'kh15khusnul@gmail.com', 'KHUSNUL KHOTIMAH', '$2a$12$N/NSvSih.KBMXkwU6OCYK..OXgG6248gbWogWGI.InD.KTUZ84SmO', '', NULL),
('7151770671230003', 'tikaetikasa@gmail.com', 'TIKA ETIKASARI', '$2a$12$d8ogP5BgBVX1Afu0o4VUXOvP3GSKonKdqJ04ks83pUC21wAH5l4My', 'Bahasa Inggris', 5),
('7160771672230233', 'aeninoerul93@gmail.com', 'NURUL AENI', '$2a$12$c95y.28qyMrpS6EuXRTmr.ODZP6zR6oSq0vO9xAkM5bmVcNGvfsca', '', NULL),
('737774675130102', 'lukmanulhakim199605@gmail.com', 'LUKMANUL HAKIM', '$2a$12$sgC1ZKKk07CTIxwg42stxeRExcaXV8c/O7kjFeFdnYo6YJb/0k4z2', '', NULL),
('7862769670230022', 'Jzeinarifin@gmail.com', 'JESISCA ZEIN ARIFIN', '$2a$12$Aekn/G7ESBU73av2qvVIEOow0g7LDpCKM1XGncvQWXLHjsuoCtETq', '', NULL),
('7954771672230140', 'dalviyani@gmail.com', 'ALVIYANI DAMAYANTI', '$2a$12$8bSDPjf25jRuhylrgOWWi.WRWAukltzEYKiyB9LgO1DphfDhcRHhe', '', NULL),
('839775676230032', 'Annisamei0797@gmail.com', 'ANNISA FITRI ARIFIN', '$2a$12$7J65HTwbNvbVGetkklZhqOBH43bgLUp7lkwf9cTUlBaiN2lBzOO1', '', NULL),
('8549761662300072', 'yezial724@gmail.com', 'IMAS FAUZIAH', '$2a$12$KiQaDS9k/vOJYDCdouJ/7.xF.jYlmmMUbjJaEc0R2tj9acSqUBaeO', '', NULL),
('8737769670230022', 'riaade165@gmail.com', 'ADE RIA APRIYANTHI', '$2a$12$7Rly1Dw/bBTQJerTLvRCMeOw.o4FoTqf4izhvb2FyyXIBnmTou25K', 'Teknik Dasar Otomotif', 17),
('8933744647300002', 'silaning66voctech1@gmail.com', 'SILANING MURTIASIH', '$2a$12$RC6iAdycngSKyddv3xmdsePz1a0AMWUAStyPiT7llXEv7LuikQgoC', 'Sistem Engine Kendaraan', 15),
('9154775676230163', 'leniagustianana822@gmail.com', 'LENI AGUSTIANA', '$2a$12$cweGdxfRhn0uJqfcpIDvZ.ZRkjANpFif/t6hKVfcjUgFIcbdiWx9G', 'Bahasa Indonesia', 1),
('9157771672230203', 'nurmalanurmala22982@gmail.com', 'NURMALA', '$2a$12$PtYbbXmPLzAnvt5Mp.pIBepID9oKj4qMD1d6KOrvJVxzLbkQNCmhK', 'Teknik 2D & 3D', 9),
('9462769670230013', 'rinassami30@gmail.com', 'RINA ASSAMI', '$2a$12$YluRExuLbFuaEDeHPvE58uyTo0g4Q3jugBSoi0Abfdi4LHfbKe8XW', 'Matematika', 6);

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `id_kelas` int(25) DEFAULT NULL,
  `nip` varchar(20) DEFAULT NULL,
  `id_materi` int(11) DEFAULT NULL,
  `hari` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu') DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `nama_kelas` varchar(128) DEFAULT NULL,
  `nama_guru` varchar(128) DEFAULT NULL,
  `nama_mapel` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(25) NOT NULL,
  `nip` varchar(20) DEFAULT NULL,
  `nama_kelas` varchar(128) NOT NULL,
  `jumlah_siswa` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nip`, `nama_kelas`, `jumlah_siswa`) VALUES
(1, NULL, '10 DKV 1', '42'),
(2, NULL, '11 TKR 2', '45');

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE `mapel` (
  `id_mapel` int(11) NOT NULL,
  `nama_mapel` varchar(100) NOT NULL,
  `kode_mapel` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `nip` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`id_mapel`, `nama_mapel`, `kode_mapel`, `created_at`, `updated_at`, `nip`) VALUES
(1, 'Bahasa Indonesia', '001', '2025-05-25 21:27:44', '2025-06-11 14:29:39', '9154775676230163'),
(2, 'Matematika', '002', '2025-05-25 21:49:32', '2025-06-11 14:29:06', '51767670130083'),
(3, 'Pendidikan Jasmani', '003', '2025-06-11 02:11:41', '2025-06-11 14:28:31', '2637764665130252'),
(4, 'Pendidikan Agama Islam', '004', '2025-06-11 02:20:48', '2025-06-11 09:20:48', '447770671130293'),
(5, 'Bahasa Inggris', '006', '2025-06-11 07:19:04', '2025-06-11 14:19:04', '7151770671230003'),
(6, 'Pendidikan Kewarganegaraan', '005', '2025-06-11 07:19:47', '2025-06-11 14:19:47', '9462769670230013'),
(7, 'Komunikasi Digital', '007', '2025-06-11 07:48:02', '2025-06-11 14:48:02', '3440769670130013'),
(8, 'Pengolahan Audio &amp; Video', '008', '2025-06-11 07:49:25', '2025-06-11 14:49:25', '463774675230162'),
(9, 'Teknik 2D &amp; 3D', '009', '2025-06-11 07:57:07', '2025-06-11 14:57:07', '9157771672230203'),
(10, 'Dasar Desain Grafis', '010', '2025-06-11 07:59:04', '2025-06-11 14:59:04', '4536768669130183'),
(11, 'Pemrograman Dasar', '011', '2025-06-11 08:02:12', '2025-06-11 15:02:12', '4262769670130023'),
(12, 'Prakarya', '012', '2025-06-13 13:20:31', '2025-06-13 20:20:31', '1262768669230173'),
(13, 'Rancang Bangun Jaringan', '013', '2025-06-13 13:28:33', '2025-06-13 20:28:33', '3359762663130193'),
(14, 'Dasar-Dasar Otomotif', '014', '2025-06-13 13:31:06', '2025-06-13 20:31:06', '3442768669210013'),
(15, 'Sistem Engine Kendar', '015', '2025-06-13 13:32:23', '2025-06-13 13:36:06', '8933744647300002'),
(16, 'Gambar Teknik', '017', '2025-06-13 13:43:23', '2025-06-13 20:43:23', '3436771672130022'),
(17, 'Teknik Dasar Otomotif', '018', '2025-06-13 13:44:31', '2025-06-13 20:44:31', '8737769670230022');

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE `materi` (
  `id_materi` int(11) NOT NULL,
  `nama_guru` varchar(128) NOT NULL,
  `nama_mapel` varchar(128) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `tanggal_upload` date DEFAULT NULL,
  `deskripsi` varchar(1024) NOT NULL,
  `kelas` varchar(128) NOT NULL,
  `nip` varchar(20) DEFAULT NULL,
  `id_kelas` int(25) DEFAULT NULL,
  `id_mapel` int(11) DEFAULT NULL,
  `id_siswa` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `materi`
--

INSERT INTO `materi` (`id_materi`, `nama_guru`, `nama_mapel`, `file`, `tanggal_upload`, `deskripsi`, `kelas`, `nip`, `id_kelas`, `id_mapel`, `id_siswa`) VALUES
(87, 'SOBRI', 'Pendidikan Jasmani', 'Screenshot_2025-06-13_224453.png', '2025-06-13', 'Materi Hari Ini', '10 DKV 1', '2637764665130252', 1, NULL, NULL),
(88, 'NOVI ASTRIYANI', 'Dasar-Dasar Otomotif', 'Sistem_Informasi_E.docx', '2025-06-14', 'dghdhg', '11 TKR 2', '3442768669210013', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pengumpulan_tugas`
--

CREATE TABLE `pengumpulan_tugas` (
  `id_pengumpulan` int(11) NOT NULL,
  `id_tugas` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `nilai` float DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `tanggal_pengumpulan` datetime DEFAULT NULL,
  `komentar_guru` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pilihan_jawaban`
--

CREATE TABLE `pilihan_jawaban` (
  `id_pilihan` int(11) NOT NULL,
  `id_soal` int(11) NOT NULL,
  `pilihan_a` text NOT NULL,
  `pilihan_b` text NOT NULL,
  `pilihan_c` text NOT NULL,
  `pilihan_d` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pilihan_jawaban`
--

INSERT INTO `pilihan_jawaban` (`id_pilihan`, `id_soal`, `pilihan_a`, `pilihan_b`, `pilihan_c`, `pilihan_d`) VALUES
(1, 1, '105 meter x 68 meter', '105 meter x 69 meter', '106 meter x 68 meter', '107 meter x 70 meter'),
(3, 7, '9', '19', '11', '12'),
(4, 9, 'Gaya Bebas', 'Gaya Kupu-kupu', 'Gaya Dada', 'Gaya Punggung'),
(5, 10, 'Gaya Bebas', 'Gaya Dada', 'Gaya Kupu-kupu', 'Gaya Punggung'),
(6, 11, 'Terus di dalam air', 'Menghadap ke atas', 'Keluar-masuk dari permukaan air', 'Selalu menghadap ke bawah'),
(7, 12, '100 m, 200 m, 400 m', '800 m, 1500 m, 5000 m', '3000 m, 5000 m, 10.000 m', 'Maraton dan half-maraton'),
(8, 13, 'Start melayang', 'Start berdiri', 'Start jongkok', 'Start berlutut');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_answers`
--

CREATE TABLE `quiz_answers` (
  `id_jawaban` int(11) NOT NULL,
  `id_submission_quiz` int(11) NOT NULL,
  `id_soal` int(11) NOT NULL,
  `jawaban_siswa` char(1) NOT NULL,
  `is_correct` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_submissions`
--

CREATE TABLE `quiz_submissions` (
  `id_submission_quiz` int(11) NOT NULL,
  `id_siswa` int(20) NOT NULL,
  `id_tugas` int(11) NOT NULL,
  `score` int(11) DEFAULT NULL,
  `submission_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(50) NOT NULL DEFAULT 'completed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ruang_diskusi`
--

CREATE TABLE `ruang_diskusi` (
  `id_diskusi` int(11) NOT NULL,
  `id_materi` int(11) DEFAULT NULL,
  `id_siswa` int(20) DEFAULT NULL,
  `nip` varchar(20) DEFAULT NULL,
  `pesan` text,
  `tanggal_kirim` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ruang_diskusi`
--

INSERT INTO `ruang_diskusi` (`id_diskusi`, `id_materi`, `id_siswa`, `nip`, `pesan`, `tanggal_kirim`) VALUES
(1, 87, NULL, '2637764665130252', 'hai\r\n', '2025-06-17 20:47:07'),
(2, 87, 88, NULL, 'itu ada tugas quiz ya pak', '2025-06-17 20:48:05'),
(3, 87, 88, NULL, 'hallo', '2025-06-18 17:51:17'),
(4, 87, 88, NULL, 'tes pak, tugas sudah semua ya', '2025-06-18 17:55:58');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(20) NOT NULL,
  `id_kelas` int(25) DEFAULT NULL,
  `nama_kelas` varchar(50) DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(255) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `id_kelas`, `nama_kelas`, `nama`, `password`, `email`, `image`, `is_active`, `date_created`) VALUES
(1, 1, '10 DKV 1', 'ACHMAD HADI WIJAYA', '$2a$12$kWc7l4odiePy1AdtYcgtg..0ocJJ6Z4vGY9vQtMsKbGA82ABIbRl.', '0062860479@gmail.com', 'default.jpg', 1, 0),
(2, 2, '11 TKR 2', 'ADITYA SAPUTRA', '$2a$12$d52UvqoCwa6Zz2jbq7mDWumqIGCascGbTUxDmZhJ0p0FHiiFkly2S', '0075857758@gmail.com', 'default.jpg', 1, 0),
(43, 1, '10 DKV 1', 'ACHMAD FAZAR SETIAWAN', '$2a$12$ghxIVGqu6mnb.XyuReyy8Of5RMKlSF9uMjqxhKf2DgGEqEY4Vbgmm', '0084357300@gmail.com', 'default.jpg', 1, 0),
(44, 2, '11 TKR 2', 'ADYATMA VITO ZAKI', '$2a$12$LAEFcsurgCfwXwoy5GRe6.4fNLZXwlmzYbAl/vC7yQCGOpJhF2bEy', '0094849946@gmail.com', 'default.jpg', 1, 0),
(58, 2, '11 TKR 2', 'Alexandria Dermawan', '$2y$10$CI.vMGHLPsnCHMMUF2q3WuWnDVcFhPMq./PvgQbyjovGU19w7h.F.', 'alexa@gmail.com', 'default.jpg', 1, 0),
(88, 1, '10 DKV 1', 'AHMAD DERYS HABIBI', '$2a$12$iQ3mzzgrTVlUqP.pPYOa..g0upE2106W4Lg10FkE6qao4H1kbu4h2', '3080438288@gmail.com', 'default.jpg', 1, 0),
(89, 2, '11 TKR 2', 'ANANDA PUTRI DAVINA', '$2a$12$9Gy1JbjWNwLvWwv78WMTuOB39H2UqYwebebXHgSauXC0cUq3A/RQu', '0099277972@gmail.com', 'default.jpg', 1, 0),
(124, 1, '10 DKV 1', 'AHMAD LILI PUDHOLI', '$2a$12$vC4UO96RkaZ2zg9/YL3i1ucgSbkact1bxzrJ5Pa.I7L8SUpTAUaaC', '3095390114@gmail.com', 'default.jpg', 1, 0),
(125, 2, '11 TKR 2', 'AIRA ANGGRAINI', '$2a$12$iaE0qnNaap0jJG2L4Kt0beAa8QrKKj0lNwiZ5W9QrycrGawxsckeO', '0098594754@gmail.com', 'default.jpg', 1, 0),
(163, 1, '10 DKV 1', 'AKBAR MAULANA', '$2a$12$hc18Czv6QV8fEli8n01TSuccovuEe4zmsnMs2mjk3fhaBnm96kHr6', '0091781322@gmail.com', 'default.jpg', 1, 0),
(164, 2, '11 TKR 2', 'ALMAIRA AURA PUTRI', '$2a$12$1BXWoGNr4zlLUhNfA2PIUuK./8i7LhzTAf/z1/LKkcLWfh6mEz3gK', '0087441593@gmail.com', 'default.jpg', 1, 0),
(197, 1, '10 DKV 1', 'ALYA FAIHAH', '$2a$12$xFqNez9Sel2QOOei5bNSH.XTHWkl6wneiEtKUkHHIyS66BRHm0KT.', '0089189773@gmail.com', 'default.jpg', 1, 0),
(198, 2, '11 TKR 2', 'AMELIA PUTRI', '$2a$12$45oZvHBYvh8cFfpikBNIR.mH017x.wjQdKksJ73YQaO2Qx2WzstCO', '3106095910@gmail.com', 'default.jpg', 1, 0),
(308, 1, '10 DKV 1', 'ADITYA DHIYAURROHMAN', '$2a$12$TFhwiXGmg59LanYBLP/Dg.46RwkicN15lw0yJFtTbFQ7SZARymym.', '0082479544@gmail.com', 'default.jpg', 1, 0),
(309, 2, '11 TKR 2', 'ADITYA NOVA ARYANTO', '$2a$12$2VpvhX9h1DGGeovYTrUMa.HS5nYfQLAEiH.T.D/pcVGHMTc0f7Dsm', '0093336264@gmail.com', 'default.jpg', 1, 0),
(383, 1, '10 DKV 1', 'ADE SAPUTRA', '$2a$12$NpKIzRwoIDqcQrtEj9rmLuH/Qhx7q7lc3OnYLfEBZG57uPZP4ahaa', '0081966433@gmail.com', 'default.jpg', 1, 0),
(384, 2, '11 TKR 2', 'AHMAD A RAMDHANA', '$2a$12$ssKqmr7rsx5CgHKqta6dWO0ZFAcmmNz/X0mbYnC4bw95QNIz5CWJi', '0076722150@gmail.com', 'default.jpg', 1, 0),
(428, 1, '10 DKV 1', 'ADAM RAMA CHANDRA WINATA', '$2a$12$cnpFhMeQjzvGbSFXeCVYku9FH4yU45XAWVqj6S2okh/sqiGJAbhj6', '0065217345@gmail.com', 'default.jpg', 1, 0),
(429, 2, '11 TKR 2', 'AHMAD FABIAN RAMADHAN', '$2a$12$kBdDAgZ6HrOzWec7NucVLO3r5xBS/NbsVgCeAN53H6sRX/DmPNu4O', '0075920888@gmail.com', 'default.jpg', 1, 0),
(472, 1, '10 DKV 1', 'ADELEA USHIBAH', '$2a$12$xwASJQ7lID4gZsXp454Uau1HfBBhQyAya7gZBeN6hgTQEeybpNMQK', '0084354151@gmail.com', 'default.jpg', 1, 0),
(473, 2, '11 TKR 2', 'ALIKA PUTRI', '$2a$12$BqoscTTKydDyrgJ4.eyANeKlUAzYIUUDLL/dc3.1LHAsCfgYQRW.O', '0086743987@gmail.com', 'default.jpg', 1, 0),
(505, 1, '10 DKV 1', 'ALISTA NUR AINI', '$2a$12$adknRVnRGlp/KgUIeQPSLuPRIbeFNYUOyeSfkdAoBjX775hz6lLgS', '0089195629@gmail.com', 'default.jpg', 1, 0),
(506, 2, '11 TKR 2', 'AMANDA SYAFIRA', '$2a$12$mAQUYA2LZ429ENL57X0OgOTxOlR.g0HAU1pEsm.21t5ZqFABNEy7O', '0083617013@gmail.com', 'default.jpg', 1, 0),
(537, 1, '10 DKV 1', 'ANDINI PUTRI', '$2a$12$nT3vwSP74u2gtmLuBtWtGOs4MIJ8zT15m8Ud2xzYXRLQLW66K2z1e', '0089123509@gmail.com', 'default.jpg', 1, 0),
(538, 2, '11 TKR 2', 'ANINDA NUR AULIA', '$2a$12$6B0z3sdCtVssklfUxeJOw.B7AH8/wx8iqn/ILOOLci74oX.DyDre.', '0076693643@gmail.com', 'default.jpg', 1, 0),
(570, 1, '11 OTKP 4', 'ANNISA KHOLIFAH DEWI', '$2a$12$EpgI/ubq6mVh.Z8KL6mT.O20FGsysdwU1vN5yj.wDi5DTPm3umFRO', '0082029705@gmail.com', 'default.jpg', 1, 0),
(571, 2, '11 OTKP 4', 'AYU PUTRI FAUZIAH', '$2a$12$upsXAvdI85pfou3ksHjvqujS3T6xCcozv19NOp1Fn5YreXm2TGU.K', '0071942149@gmail.com', 'default.jpg', 1, 0),
(604, 1, '11 TKRO 1', 'ABDUL RAHMAN SOLEH', '$2a$12$il3SK3JvOTw/FBilcx4TPOX.tJXuD/wxRRNO2ATZXzNUfmxQ/nHii', '0079279154@gmail.com', 'default.jpg', 1, 0),
(605, 2, '11 TKRO 1', 'ACHMAD RAFLI', '$2a$12$8lbTTwuK2v13rigc2kAPkOyozyeTv4Eq0ikLF8FJiIZRIKhzjni6u', '0076020753@gmail.com', 'default.jpg', 1, 0),
(643, 1, '11 TKRO 2', 'ABU ABDILLAH', '$2a$12$MxuxRowRK6FIFPK8jb6Om.KrlAg87X5ZVehnmiFxqLMO7fpXVcwtG', '0075662500@gmail.com', 'default.jpg', 1, 0),
(644, 2, '11 TKRO 2', 'ADRIAN FAKHRUL ROZI', '$2a$12$1DEX8D.3IKsY4NvWU8/S9OouPzIAm1SZLGQCM0WUxXUHlWxb1LVoK', '0085000199@gmail.com', 'default.jpg', 1, 0),
(683, 1, '11 TKRO 3', 'AFRIANDA HARNADIKA', '$2a$12$RFk0NXmgsJHDYN8euAapE.kIMOlkRGykhVh.4xyFQoeE3.01juq4q', '0089672023@gmail.com', 'default.jpg', 1, 0),
(684, 2, '11 TKRO 3', 'AGUNG FAJAR KURNIAWAN', '$2a$12$slY0tMcIK/LAABlodEx0U.zTI2hOSt5a6g5dgc0f8k8C285Rk29ym', '0075660862@gmail.com', 'default.jpg', 1, 0),
(724, 1, '12 MM 1', 'ACHMAD MAULANA MALIK', '$2a$12$FcC6mlA6lsZBKOYO3gChK.nbi9WwTzhvot4yctTW.NlFBX4qM4RU2', '0071221143@gmail.com', 'default.jpg', 1, 0),
(725, 2, '12 MM 1', 'ADIMAS PUTRA RAMADHON', '$2a$12$ce0FHg.e7VPTy3F.p6HkneCDHHWYuwKagSn9kvKP2sd/iRjl6T0KC', '0058174503@gmail.com', 'default.jpg', 1, 0),
(758, 1, '12 MM 2', 'ADINDA PUTRI', '$2a$12$nRXn6bGk/iDHNXeOKAVB6eVswJYF7CcT8p3rSVe5nW/DgIV402hSa', '0055810383@gmail.com', 'default.jpg', 1, 0),
(759, 2, '12 MM 2', 'ADITTIYA', '$2a$12$wGyPiFcRqMu0UwYeihsYMuGqSQu3w8aPUT0BbOaUqeCXVSJaCEevm', '0075026266@gmail.com', 'default.jpg', 1, 0),
(791, 1, '12 OTKP 1', 'ADINDA ZAHRA', '$2a$12$2QxhUb4rDMdzaYlcv71TQeUnNAB2jVFmPmamBsz44gVa3FqxwoZ8q', '0072091449@gmail.com', 'default.jpg', 1, 0),
(792, 2, '12 OTKP 1', 'ALFI SYAHRIN', '$2a$12$TqcS0fowsU9t1TM5xd9cy.KEfysuspo1sqQiTxwL8XfnnGgIPITG2', '0075800968@gmail.com', 'default.jpg', 1, 0),
(823, 1, '12 OTKP 2', 'AISYAH NUR RAHMADANY', '$2a$12$lQjWUIliUQS6ws91WhzIZOwhJJcBppZtjNq.OcJyh9zH3VhfRZJ6.', '0072218128@gmail.com', 'default.jpg', 1, 0),
(824, 2, '12 OTKP 2', 'AMANDHA PUTRI NABILLA', '$2a$12$WM1CYjC4eSflehAk0SQ8tOncxVc5YP6VjP2JoNK6aEEo16YyDrOqy', '0073171360@gmail.com', 'default.jpg', 1, 0),
(852, 1, '12 OTKP 3', 'ALFIAH NUR FADILAH', '$2a$12$7CecdPqdkOJEn1xD/fyaoeTQ8JZD43oQryyfsWw4sBfTa6kXlGryK', '0065455818@gmail.com', 'default.jpg', 1, 0),
(853, 2, '12 OTKP 3', 'ANESTIA SABELAINI', '$2a$12$xy9ecQeawVDpMFErqio21uq/CpJPI5BJr2eOg8TSN8Y/DDSQUYJoa', '0059103831@gmail.com', 'default.jpg', 1, 0),
(882, 1, '12 TKRO 1', 'ACHMAD BAIHAQI AL FARIZY', '$2a$12$JLrLy2qsg1xPRnmDZsIJ4.nXXu4b7nzr5z3Cc7USVaKvBtgZlO/cG', '0075835469@gmail.com', 'default.jpg', 1, 0),
(883, 2, '12 TKRO 1', 'ADITIA ARDIANSYAH', '$2a$12$ECmSmreceFfZ8kEsAtFfZu4ieIQBVhTHLqZqZ35N6B7fQXZi/gMAe', '0068413972@gmail.com', 'default.jpg', 1, 0),
(922, 1, '12 TKRO 2', 'ADLU HAKIM', '$2a$12$vXRLB3C2OmjojpcsAUzlV.KYQx8Q3YYbrBrDM52aIiPKmM9Q.J4fe', '0073876731@gmail.com', 'default.jpg', 1, 0),
(923, 2, '12 TKRO 2', 'AHMAD APRIANSYAH MULANI', '$2a$12$boMLjMYkKhakGQPA2zQH..U.4RkhtcTMl35OW49VN.c4ZoOX.oxj6', '0076383160@gmail.com', 'default.jpg', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `soal_pilihan_ganda`
--

CREATE TABLE `soal_pilihan_ganda` (
  `id_soal` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `id_tugas` int(11) DEFAULT NULL,
  `pertanyaan` text NOT NULL,
  `kunci_jawaban` varchar(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `soal_pilihan_ganda`
--

INSERT INTO `soal_pilihan_ganda` (`id_soal`, `id_mapel`, `nip`, `id_tugas`, `pertanyaan`, `kunci_jawaban`, `created_at`, `updated_at`) VALUES
(1, 3, '2637764665130252', NULL, 'Berapa ukuran lapangan sepakbola standar FIFA?', 'A', '2025-06-16 19:59:57', '2025-06-17 13:35:05'),
(7, 3, '2637764665130252', NULL, 'Jumlah pemain dalam satu tim sepak bola yang bermain di lapangan adalah', 'C', '2025-06-17 13:43:34', '2025-06-17 13:43:34'),
(9, 3, '2637764665130252', 3, 'Gaya renang yang menyerupai gerakan katak saat berenang adalah', 'C', '2025-06-17 14:00:31', '2025-06-17 14:00:31'),
(10, 3, '2637764665130252', 3, 'Gaya renang yang paling cepat adalah', 'A', '2025-06-17 14:00:31', '2025-06-17 14:00:31'),
(11, 3, '2637764665130252', 3, 'Dalam renang gaya dada, posisi wajah perenang berada', 'C', '2025-06-17 14:00:31', '2025-06-17 14:00:31'),
(12, 3, '2637764665130252', 5, 'Nomor lari jarak pendek (sprint) dalam atletik terdiri dari', 'A', '2025-06-17 22:47:37', '2025-06-17 22:47:37'),
(13, 3, '2637764665130252', 5, 'Start yang digunakan dalam lari jarak pendek adalah', 'C', '2025-06-17 22:47:37', '2025-06-17 22:47:37');

-- --------------------------------------------------------

--
-- Table structure for table `submission_tugas`
--

CREATE TABLE `submission_tugas` (
  `id_submission` int(11) NOT NULL,
  `id_tugas` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `file_submission` varchar(255) NOT NULL,
  `tanggal_submit` datetime NOT NULL,
  `nilai` decimal(5,2) DEFAULT NULL,
  `komentar` text,
  `status` enum('belum','sudah','terlambat') NOT NULL DEFAULT 'belum',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `submission_tugas`
--

INSERT INTO `submission_tugas` (`id_submission`, `id_tugas`, `id_siswa`, `file_submission`, `tanggal_submit`, `nilai`, `komentar`, `status`, `created_at`, `updated_at`) VALUES
(2, 3, 88, '', '2025-06-17 21:30:32', 0.00, NULL, 'sudah', '2025-06-17 21:30:32', '2025-06-17 21:30:32'),
(3, 4, 88, 'tugas_4_88_1750224692.png', '2025-06-18 05:31:32', 79.00, 'lumayan', 'sudah', '2025-06-18 05:31:32', '2025-06-18 05:38:16'),
(4, 5, 88, '', '2025-06-18 05:48:45', 100.00, NULL, 'sudah', '2025-06-18 05:48:45', '2025-06-18 05:48:45'),
(5, 6, 88, 'tugas_6_88_1750269043.png', '2025-06-18 17:50:43', NULL, NULL, 'sudah', '2025-06-18 17:50:43', '2025-06-18 17:50:43');

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `id_tugas` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `judul_tugas` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `deadline` datetime NOT NULL,
  `file_tugas` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `nama_mapel` varchar(255) NOT NULL,
  `video` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tugas`
--

INSERT INTO `tugas` (`id_tugas`, `id_mapel`, `judul_tugas`, `deskripsi`, `kelas`, `deadline`, `file_tugas`, `created_at`, `updated_at`, `nama_mapel`, `video`) VALUES
(3, 3, 'Tugas Pertemuan 3', 'Latihan Quiz Materi Renang', '10 DKV 1', '2025-06-20 12:00:00', NULL, '2025-06-17 20:52:53', '2025-06-17 20:52:53', 'Pendidikan Jasmani', NULL),
(4, 3, 'Tugas Rangkuman', 'Rangkuman Materi Renang', '10 DKV 1', '2025-06-21 12:00:00', 'tugas_1750194117.png', '2025-06-17 21:01:57', '2025-06-17 21:01:57', 'Pendidikan Jasmani', NULL),
(5, 3, 'Tugas Pertemuan 4', 'Latihan Quiz Pertemuan 4', '10 DKV 1', '2025-06-20 12:00:00', NULL, '2025-06-18 05:45:19', '2025-06-18 05:45:19', 'Pendidikan Jasmani', NULL),
(6, 3, 'Tugas Pertemuan 4', 'Pahami materi yang sudah diberikan, lalu buatlah ringkasannya', '10 DKV 1', '2025-06-20 12:00:00', '6ae85dcbfa5bce47c7657f630ef9f04d.png', '2025-06-18 05:53:46', '2025-06-18 05:53:46', 'Pendidikan Jasmani', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`nip`),
  ADD KEY `fk_guru_mapel` (`id_mapel`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `kelas_id` (`id_kelas`),
  ADD KEY `nip` (`nip`),
  ADD KEY `materi_id` (`id_materi`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id_mapel`),
  ADD KEY `nip` (`nip`);

--
-- Indexes for table `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id_materi`),
  ADD KEY `nip` (`nip`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_mapel` (`id_mapel`),
  ADD KEY `id_siswa` (`id_siswa`);

--
-- Indexes for table `pengumpulan_tugas`
--
ALTER TABLE `pengumpulan_tugas`
  ADD PRIMARY KEY (`id_pengumpulan`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `id_tugas` (`id_tugas`);

--
-- Indexes for table `pilihan_jawaban`
--
ALTER TABLE `pilihan_jawaban`
  ADD PRIMARY KEY (`id_pilihan`),
  ADD KEY `id_soal` (`id_soal`);

--
-- Indexes for table `quiz_answers`
--
ALTER TABLE `quiz_answers`
  ADD PRIMARY KEY (`id_jawaban`),
  ADD KEY `id_submission_quiz` (`id_submission_quiz`),
  ADD KEY `id_soal` (`id_soal`);

--
-- Indexes for table `quiz_submissions`
--
ALTER TABLE `quiz_submissions`
  ADD PRIMARY KEY (`id_submission_quiz`),
  ADD KEY `id_tugas` (`id_tugas`),
  ADD KEY `id_siswa` (`id_siswa`);

--
-- Indexes for table `ruang_diskusi`
--
ALTER TABLE `ruang_diskusi`
  ADD PRIMARY KEY (`id_diskusi`),
  ADD KEY `id_materi` (`id_materi`),
  ADD KEY `nip` (`nip`),
  ADD KEY `id_siswa` (`id_siswa`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD KEY `fk_siswa_kelas` (`id_kelas`);

--
-- Indexes for table `soal_pilihan_ganda`
--
ALTER TABLE `soal_pilihan_ganda`
  ADD PRIMARY KEY (`id_soal`),
  ADD KEY `id_mapel` (`id_mapel`),
  ADD KEY `nip` (`nip`),
  ADD KEY `id_tugas` (`id_tugas`);

--
-- Indexes for table `submission_tugas`
--
ALTER TABLE `submission_tugas`
  ADD PRIMARY KEY (`id_submission`),
  ADD KEY `id_tugas` (`id_tugas`),
  ADD KEY `id_siswa` (`id_siswa`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id_tugas`),
  ADD KEY `id_mapel` (`id_mapel`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id_mapel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `materi`
--
ALTER TABLE `materi`
  MODIFY `id_materi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `pengumpulan_tugas`
--
ALTER TABLE `pengumpulan_tugas`
  MODIFY `id_pengumpulan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pilihan_jawaban`
--
ALTER TABLE `pilihan_jawaban`
  MODIFY `id_pilihan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `quiz_answers`
--
ALTER TABLE `quiz_answers`
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quiz_submissions`
--
ALTER TABLE `quiz_submissions`
  MODIFY `id_submission_quiz` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ruang_diskusi`
--
ALTER TABLE `ruang_diskusi`
  MODIFY `id_diskusi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=924;

--
-- AUTO_INCREMENT for table `soal_pilihan_ganda`
--
ALTER TABLE `soal_pilihan_ganda`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `submission_tugas`
--
ALTER TABLE `submission_tugas`
  MODIFY `id_submission` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id_tugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `guru`
--
ALTER TABLE `guru`
  ADD CONSTRAINT `fk_guru_mapel` FOREIGN KEY (`id_mapel`) REFERENCES `mapel` (`id_mapel`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_ibfk_2` FOREIGN KEY (`nip`) REFERENCES `guru` (`nip`) ON DELETE CASCADE,
  ADD CONSTRAINT `jadwal_ibfk_3` FOREIGN KEY (`id_materi`) REFERENCES `materi` (`id_materi`) ON DELETE CASCADE;

--
-- Constraints for table `mapel`
--
ALTER TABLE `mapel`
  ADD CONSTRAINT `mapel_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `guru` (`nip`);

--
-- Constraints for table `materi`
--
ALTER TABLE `materi`
  ADD CONSTRAINT `materi_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `guru` (`nip`),
  ADD CONSTRAINT `materi_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`),
  ADD CONSTRAINT `materi_ibfk_3` FOREIGN KEY (`id_mapel`) REFERENCES `mapel` (`id_mapel`),
  ADD CONSTRAINT `materi_ibfk_4` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`);

--
-- Constraints for table `pengumpulan_tugas`
--
ALTER TABLE `pengumpulan_tugas`
  ADD CONSTRAINT `pengumpulan_tugas_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`),
  ADD CONSTRAINT `pengumpulan_tugas_ibfk_2` FOREIGN KEY (`id_tugas`) REFERENCES `tugas` (`id_tugas`);

--
-- Constraints for table `pilihan_jawaban`
--
ALTER TABLE `pilihan_jawaban`
  ADD CONSTRAINT `pilihan_jawaban_ibfk_1` FOREIGN KEY (`id_soal`) REFERENCES `soal_pilihan_ganda` (`id_soal`);

--
-- Constraints for table `quiz_answers`
--
ALTER TABLE `quiz_answers`
  ADD CONSTRAINT `fk_quiz_answers_soal` FOREIGN KEY (`id_soal`) REFERENCES `soal_pilihan_ganda` (`id_soal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_quiz_answers_submission` FOREIGN KEY (`id_submission_quiz`) REFERENCES `quiz_submissions` (`id_submission_quiz`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quiz_submissions`
--
ALTER TABLE `quiz_submissions`
  ADD CONSTRAINT `fk_quiz_submissions_tugas` FOREIGN KEY (`id_tugas`) REFERENCES `tugas` (`id_tugas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `quiz_submissions_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`);

--
-- Constraints for table `ruang_diskusi`
--
ALTER TABLE `ruang_diskusi`
  ADD CONSTRAINT `ruang_diskusi_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `guru` (`nip`),
  ADD CONSTRAINT `ruang_diskusi_ibfk_2` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`);

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `fk_siswa_kelas` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE;

--
-- Constraints for table `soal_pilihan_ganda`
--
ALTER TABLE `soal_pilihan_ganda`
  ADD CONSTRAINT `fk_soal_pilihan_ganda_guru` FOREIGN KEY (`nip`) REFERENCES `guru` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_soal_pilihan_ganda_mapel` FOREIGN KEY (`id_mapel`) REFERENCES `mapel` (`id_mapel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_soal_pilihan_ganda_tugas` FOREIGN KEY (`id_tugas`) REFERENCES `tugas` (`id_tugas`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `submission_tugas`
--
ALTER TABLE `submission_tugas`
  ADD CONSTRAINT `submission_tugas_ibfk_1` FOREIGN KEY (`id_tugas`) REFERENCES `tugas` (`id_tugas`) ON DELETE CASCADE;

--
-- Constraints for table `tugas`
--
ALTER TABLE `tugas`
  ADD CONSTRAINT `tugas_ibfk_1` FOREIGN KEY (`id_mapel`) REFERENCES `mapel` (`id_mapel`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
