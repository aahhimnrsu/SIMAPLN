-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2024 at 08:39 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_simapln`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_absensi`
--

CREATE TABLE `tb_absensi` (
  `id` int(11) NOT NULL,
  `idpeserta` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `instansi` varchar(50) NOT NULL,
  `tim` varchar(30) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `waktukehadiran` varchar(20) DEFAULT NULL,
  `lokasikehadiran` text DEFAULT NULL,
  `fotokehadiran` text DEFAULT NULL,
  `waktukepulangan` varchar(20) DEFAULT NULL,
  `fotokepulangan` text DEFAULT NULL,
  `lokasikepulangan` text DEFAULT NULL,
  `fotoeviden` text DEFAULT NULL,
  `keteranganeviden` text DEFAULT NULL,
  `suratsakit` text DEFAULT NULL,
  `keteranganizin` text DEFAULT NULL,
  `statuskehadiran` enum('Hadir','Izin','Sakit','Terlambat','Alfa','Menunggu Validasi','Belum Absen') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_absensi`
--

INSERT INTO `tb_absensi` (`id`, `idpeserta`, `nama`, `instansi`, `tim`, `tanggal`, `waktukehadiran`, `lokasikehadiran`, `fotokehadiran`, `waktukepulangan`, `fotokepulangan`, `lokasikepulangan`, `fotoeviden`, `keteranganeviden`, `suratsakit`, `keteranganizin`, `statuskehadiran`) VALUES
(367, 12, 'Amanda Ihsanan Putri', 'Politeknik Negeri Sriwijaya', 'PA', '2024-01-24', '-', '-', '-', '-', '-', '-', '-', '-', NULL, 'Izin bimbingan', 'Izin'),
(368, 13, 'Muhammad Raihan', 'Politeknik Negeri Sriwijaya', 'PA', '2024-01-24', '12:55:34', '-2.9795221,104.7319074', '65b0a661e169e.png', '16:56:51', '65b0def448edd.png', '-2.9795285,104.7319037', NULL, NULL, NULL, NULL, 'Terlambat'),
(369, 14, 'Ayu Sekar Ningrum', 'Politeknik Negeri Sriwijaya', 'TE', '2024-01-24', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(370, 15, 'Adelia Ayu Reina', 'Politeknik Negeri Sriwijaya', 'TE', '2024-01-24', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(371, 16, 'Cherry Junita Sari Ferras', 'Politeknik Negeri Sriwijaya', 'TE', '2024-01-24', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(372, 17, 'Putri Nabila Ayatullah', 'Politeknik Negeri Sriwijaya', 'TE', '2024-01-24', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(373, 18, 'Raihanny Dhea Slasita', 'Politeknik Negeri Sriwijaya', 'TE', '2024-01-24', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(374, 19, 'M. Robian Hadi', 'Politeknik Negeri Sriwijaya', 'TE', '2024-01-24', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(375, 20, 'M. Hartandiansyah Doornik', 'Politeknik Negeri Sriwijaya', 'Yantek', '2024-01-24', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(376, 21, 'Patricia Aulia Damayanti', 'Politeknik Negeri Sriwijaya', 'TE', '2024-01-24', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(377, 22, 'Frista Primodiali Santi Br Manullang', 'Politeknik Negeri Sriwijaya', 'PA', '2024-01-24', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(378, 12, 'Amanda Ihsanan Putri', 'Politeknik Negeri Sriwijaya', 'PA', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(379, 12, 'Amanda Ihsanan Putri', 'Politeknik Negeri Sriwijaya', 'PA', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(380, 12, 'Amanda Ihsanan Putri', 'Politeknik Negeri Sriwijaya', 'PA', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(381, 13, 'Muhammad Raihan', 'Politeknik Negeri Sriwijaya', 'PA', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(382, 13, 'Muhammad Raihan', 'Politeknik Negeri Sriwijaya', 'PA', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(383, 13, 'Muhammad Raihan', 'Politeknik Negeri Sriwijaya', 'PA', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(384, 14, 'Ayu Sekar Ningrum', 'Politeknik Negeri Sriwijaya', 'TE', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(385, 14, 'Ayu Sekar Ningrum', 'Politeknik Negeri Sriwijaya', 'TE', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(386, 12, 'Amanda Ihsanan Putri', 'Politeknik Negeri Sriwijaya', 'PA', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(387, 12, 'Amanda Ihsanan Putri', 'Politeknik Negeri Sriwijaya', 'PA', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(388, 12, 'Amanda Ihsanan Putri', 'Politeknik Negeri Sriwijaya', 'PA', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(389, 14, 'Ayu Sekar Ningrum', 'Politeknik Negeri Sriwijaya', 'TE', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(390, 15, 'Adelia Ayu Reina', 'Politeknik Negeri Sriwijaya', 'TE', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(391, 13, 'Muhammad Raihan', 'Politeknik Negeri Sriwijaya', 'PA', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(392, 15, 'Adelia Ayu Reina', 'Politeknik Negeri Sriwijaya', 'TE', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(393, 12, 'Amanda Ihsanan Putri', 'Politeknik Negeri Sriwijaya', 'PA', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(394, 13, 'Muhammad Raihan', 'Politeknik Negeri Sriwijaya', 'PA', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(395, 13, 'Muhammad Raihan', 'Politeknik Negeri Sriwijaya', 'PA', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(396, 16, 'Cherry Junita Sari Ferras', 'Politeknik Negeri Sriwijaya', 'TE', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(397, 15, 'Adelia Ayu Reina', 'Politeknik Negeri Sriwijaya', 'TE', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(398, 14, 'Ayu Sekar Ningrum', 'Politeknik Negeri Sriwijaya', 'TE', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(399, 16, 'Cherry Junita Sari Ferras', 'Politeknik Negeri Sriwijaya', 'TE', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(400, 13, 'Muhammad Raihan', 'Politeknik Negeri Sriwijaya', 'PA', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(401, 14, 'Ayu Sekar Ningrum', 'Politeknik Negeri Sriwijaya', 'TE', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(402, 14, 'Ayu Sekar Ningrum', 'Politeknik Negeri Sriwijaya', 'TE', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(403, 17, 'Putri Nabila Ayatullah', 'Politeknik Negeri Sriwijaya', 'TE', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(404, 17, 'Putri Nabila Ayatullah', 'Politeknik Negeri Sriwijaya', 'TE', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(405, 16, 'Cherry Junita Sari Ferras', 'Politeknik Negeri Sriwijaya', 'TE', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(406, 15, 'Adelia Ayu Reina', 'Politeknik Negeri Sriwijaya', 'TE', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(407, 14, 'Ayu Sekar Ningrum', 'Politeknik Negeri Sriwijaya', 'TE', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(408, 15, 'Adelia Ayu Reina', 'Politeknik Negeri Sriwijaya', 'TE', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(409, 18, 'Raihanny Dhea Slasita', 'Politeknik Negeri Sriwijaya', 'TE', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(410, 15, 'Adelia Ayu Reina', 'Politeknik Negeri Sriwijaya', 'TE', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(411, 18, 'Raihanny Dhea Slasita', 'Politeknik Negeri Sriwijaya', 'TE', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(412, 19, 'M. Robian Hadi', 'Politeknik Negeri Sriwijaya', 'TE', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(413, 17, 'Putri Nabila Ayatullah', 'Politeknik Negeri Sriwijaya', 'TE', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(414, 16, 'Cherry Junita Sari Ferras', 'Politeknik Negeri Sriwijaya', 'TE', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(415, 16, 'Cherry Junita Sari Ferras', 'Politeknik Negeri Sriwijaya', 'TE', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(416, 15, 'Adelia Ayu Reina', 'Politeknik Negeri Sriwijaya', 'TE', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(417, 16, 'Cherry Junita Sari Ferras', 'Politeknik Negeri Sriwijaya', 'TE', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(418, 18, 'Raihanny Dhea Slasita', 'Politeknik Negeri Sriwijaya', 'TE', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(419, 19, 'M. Robian Hadi', 'Politeknik Negeri Sriwijaya', 'TE', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(420, 17, 'Putri Nabila Ayatullah', 'Politeknik Negeri Sriwijaya', 'TE', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(421, 20, 'M. Hartandiansyah Doornik', 'Politeknik Negeri Sriwijaya', 'Yantek', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(422, 16, 'Cherry Junita Sari Ferras', 'Politeknik Negeri Sriwijaya', 'TE', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(423, 17, 'Putri Nabila Ayatullah', 'Politeknik Negeri Sriwijaya', 'TE', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(424, 17, 'Putri Nabila Ayatullah', 'Politeknik Negeri Sriwijaya', 'TE', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(425, 20, 'M. Hartandiansyah Doornik', 'Politeknik Negeri Sriwijaya', 'Yantek', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(426, 17, 'Putri Nabila Ayatullah', 'Politeknik Negeri Sriwijaya', 'TE', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(427, 18, 'Raihanny Dhea Slasita', 'Politeknik Negeri Sriwijaya', 'TE', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(428, 19, 'M. Robian Hadi', 'Politeknik Negeri Sriwijaya', 'TE', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(429, 21, 'Patricia Aulia Damayanti', 'Politeknik Negeri Sriwijaya', 'TE', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(430, 18, 'Raihanny Dhea Slasita', 'Politeknik Negeri Sriwijaya', 'TE', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(431, 18, 'Raihanny Dhea Slasita', 'Politeknik Negeri Sriwijaya', 'TE', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(432, 19, 'M. Robian Hadi', 'Politeknik Negeri Sriwijaya', 'TE', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(433, 21, 'Patricia Aulia Damayanti', 'Politeknik Negeri Sriwijaya', 'TE', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(434, 18, 'Raihanny Dhea Slasita', 'Politeknik Negeri Sriwijaya', 'TE', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(435, 20, 'M. Hartandiansyah Doornik', 'Politeknik Negeri Sriwijaya', 'Yantek', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(436, 19, 'M. Robian Hadi', 'Politeknik Negeri Sriwijaya', 'TE', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(437, 22, 'Frista Primodiali Santi Br Manullang', 'Politeknik Negeri Sriwijaya', 'PA', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(438, 19, 'M. Robian Hadi', 'Politeknik Negeri Sriwijaya', 'TE', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(439, 22, 'Frista Primodiali Santi Br Manullang', 'Politeknik Negeri Sriwijaya', 'PA', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(440, 20, 'M. Hartandiansyah Doornik', 'Politeknik Negeri Sriwijaya', 'Yantek', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(441, 21, 'Patricia Aulia Damayanti', 'Politeknik Negeri Sriwijaya', 'TE', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(442, 19, 'M. Robian Hadi', 'Politeknik Negeri Sriwijaya', 'TE', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(443, 20, 'M. Hartandiansyah Doornik', 'Politeknik Negeri Sriwijaya', 'Yantek', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(444, 20, 'M. Hartandiansyah Doornik', 'Politeknik Negeri Sriwijaya', 'Yantek', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(445, 22, 'Frista Primodiali Santi Br Manullang', 'Politeknik Negeri Sriwijaya', 'PA', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(446, 20, 'M. Hartandiansyah Doornik', 'Politeknik Negeri Sriwijaya', 'Yantek', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(447, 21, 'Patricia Aulia Damayanti', 'Politeknik Negeri Sriwijaya', 'TE', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(448, 21, 'Patricia Aulia Damayanti', 'Politeknik Negeri Sriwijaya', 'TE', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(449, 21, 'Patricia Aulia Damayanti', 'Politeknik Negeri Sriwijaya', 'TE', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(450, 21, 'Patricia Aulia Damayanti', 'Politeknik Negeri Sriwijaya', 'TE', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(451, 22, 'Frista Primodiali Santi Br Manullang', 'Politeknik Negeri Sriwijaya', 'PA', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(452, 22, 'Frista Primodiali Santi Br Manullang', 'Politeknik Negeri Sriwijaya', 'PA', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(453, 22, 'Frista Primodiali Santi Br Manullang', 'Politeknik Negeri Sriwijaya', 'PA', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa'),
(454, 22, 'Frista Primodiali Santi Br Manullang', 'Politeknik Negeri Sriwijaya', 'PA', '2024-02-25', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, 'Alfa');

-- --------------------------------------------------------

--
-- Table structure for table `tb_notifikasi`
--

CREATE TABLE `tb_notifikasi` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_penerima` int(11) NOT NULL,
  `notifikasi` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('Read','Unread') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_notifikasi`
--

INSERT INTO `tb_notifikasi` (`id`, `id_user`, `id_penerima`, `notifikasi`, `timestamp`, `status`) VALUES
(40, 2, 2, 'Kamu Berhasil Melakukan Absensi Kehadiran Pada Tanggal 2024-01-24 12:55:34', '2024-01-24 05:55:45', 'Unread'),
(41, 2, 3, 'Muhammad Raihan Berhasil Melakukan Absensi Kehadiran Pada Tanggal 2024-01-24 12:55:34', '2024-01-24 05:55:45', 'Unread'),
(42, 2, 2, 'Kamu Berhasil Melakukan Absensi Kepulangan Pada Tanggal 2024-01-24 16:56:51', '2024-01-24 09:57:08', 'Unread'),
(43, 2, 3, 'Muhammad Raihan Berhasil Melakukan Absensi Kepulangan Pada Tanggal 2024-01-24 16:56:51', '2024-01-24 09:57:08', 'Unread'),
(44, 4, 4, 'Kamu Berhasil Mengajukan Izin Pada Tanggal 2024-01-24  Silahkan Menunggu Validasi Admin', '2024-01-24 06:00:27', 'Unread'),
(45, 4, 3, 'Amanda Ihsanan Putri Mengajukan Izin Pada Tanggal 2024-01-24 ', '2024-01-24 06:00:27', 'Unread'),
(46, 4, 1, 'Amanda Ihsanan Putri Mengajukan Izin Pada Tanggal 2024-01-24 ', '2024-01-24 06:00:27', 'Unread'),
(47, 1, 4, 'Pengajuan Izin Kamu telah Di Validasi Oleh Admin Pada Tanggal 2024-01-24', '2024-01-24 06:01:02', 'Unread');

-- --------------------------------------------------------

--
-- Table structure for table `tb_peserta`
--

CREATE TABLE `tb_peserta` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_pembimbing` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `instansi` varchar(50) NOT NULL,
  `tglmasuk` date NOT NULL,
  `tglkeluar` date NOT NULL,
  `tim` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_peserta`
--

INSERT INTO `tb_peserta` (`id`, `id_user`, `id_pembimbing`, `nama`, `instansi`, `tglmasuk`, `tglkeluar`, `tim`) VALUES
(12, 4, 3, 'Amanda Ihsanan Putri', 'Politeknik Negeri Sriwijaya', '2023-08-21', '2024-01-10', 'PA'),
(13, 2, 3, 'Muhammad Raihan', 'Politeknik Negeri Sriwijaya', '2023-08-21', '2024-01-10', 'PA'),
(14, 14, 5, 'Ayu Sekar Ningrum', 'Politeknik Negeri Sriwijaya', '2023-08-01', '2023-11-01', 'TE'),
(15, 13, 5, 'Adelia Ayu Reina', 'Politeknik Negeri Sriwijaya', '2023-08-01', '2023-11-01', 'TE'),
(16, 15, 5, 'Cherry Junita Sari Ferras', 'Politeknik Negeri Sriwijaya', '2023-08-01', '2023-11-01', 'TE'),
(17, 16, 5, 'Putri Nabila Ayatullah', 'Politeknik Negeri Sriwijaya', '2023-08-01', '2023-11-01', 'TE'),
(18, 6, 17, 'Raihanny Dhea Slasita', 'Politeknik Negeri Sriwijaya', '2023-08-01', '2023-11-01', 'TE'),
(19, 7, 17, 'M. Robian Hadi', 'Politeknik Negeri Sriwijaya', '2023-08-01', '2023-11-01', 'TE'),
(20, 8, 17, 'M. Hartandiansyah Doornik', 'Politeknik Negeri Sriwijaya', '2023-08-01', '2023-11-01', 'Yantek'),
(21, 12, 18, 'Patricia Aulia Damayanti', 'Politeknik Negeri Sriwijaya', '2023-08-01', '2023-12-01', 'TE'),
(22, 20, 19, 'Frista Primodiali Santi Br Manullang', 'Politeknik Negeri Sriwijaya', '2023-08-14', '2023-11-14', 'PA');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `qrcode` text NOT NULL,
  `role` enum('Admin','Dosen/Guru','Peserta') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `nama`, `username`, `password`, `qrcode`, `role`) VALUES
(1, 'admin', 'admin', '123', '/assets/uploads/qrcode/qrcode1.png', 'Admin'),
(2, 'Muhammad Raihan', 'muhraihans_', '123', '/assets/uploads/qrcode/qrcode2.png', 'Peserta'),
(3, 'Dr. Indri Ariyanti S.E., M.Si.', 'indri', '123', '/assets/uploads/qrcode/qrcode3.png', 'Dosen/Guru'),
(4, 'Amanda Ihsanan Putri', 'manda', '123', '/assets/uploads/qrcode/qrcode4.png', 'Peserta'),
(5, 'Fithri Selva Jumeila, S.Kom., M.T.I.', 'Fithri', '123', '/assets/uploads/qrcode/qrcode5.png', 'Dosen/Guru'),
(6, 'Raihanny Dhea Slasita', 'dhea', '123', '/assets/uploads/qrcode/qrcode6.png', 'Peserta'),
(7, 'M. Robian Hadi', 'Bian', '123', '/assets/uploads/qrcode/qrcode7.png', 'Peserta'),
(8, 'M. Hartandiansyah Doornik', 'Hartan', '123', '/assets/uploads/qrcode/qrcode8.png', 'Peserta'),
(9, 'Daffa Sayyidina', 'Daffa', '123', '/assets/uploads/qrcode/qrcode9.png', 'Peserta'),
(10, 'M. Bagas Prasetyo', 'Bagas', '123', '/assets/uploads/qrcode/qrcode10.png', 'Peserta'),
(11, 'Nabil Falah Ramadhan', 'nabil', '123', '/assets/uploads/qrcode/qrcode11.png', 'Peserta'),
(12, 'Patricia Aulia Damayanti', 'Cia', '123', '/assets/uploads/qrcode/qrcode12.png', 'Peserta'),
(13, 'Adelia Ayu Reina', 'Adel', '123', '/assets/uploads/qrcode/qrcode13.png', 'Peserta'),
(14, 'Ayu Sekar Ningrum', 'ayusekar', '123', '/assets/uploads/qrcode/qrcode14.png', 'Peserta'),
(15, 'Cherry Junita Sari Ferras', 'Cherry', '123', '/assets/uploads/qrcode/qrcode15.png', 'Peserta'),
(16, 'Putri Nabila Ayatullah', 'Putri', '123', '/assets/uploads/qrcode/qrcode16.png', 'Peserta'),
(17, 'Rumiasih, S.T., M.T', 'Rumiasih', '123', '/assets/uploads/qrcode/qrcode17.png', 'Dosen/Guru'),
(18, 'Yessi Marniati, S.T., M.T.', 'Yessi', '123', '/assets/uploads/qrcode/qrcode18.png', 'Dosen/Guru'),
(19, 'Jovan Febriantoko, S.E., AK., M.Acc', 'jovan', '123', '/assets/uploads/qrcode/qrcode19.png', 'Dosen/Guru'),
(20, 'Frista Primodiali Santi Br Manullang', 'frista', '123', '/assets/uploads/qrcode/qrcode20.png', 'Peserta');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_absensi`
--
ALTER TABLE `tb_absensi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_notifikasi`
--
ALTER TABLE `tb_notifikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_peserta`
--
ALTER TABLE `tb_peserta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_absensi`
--
ALTER TABLE `tb_absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=455;

--
-- AUTO_INCREMENT for table `tb_notifikasi`
--
ALTER TABLE `tb_notifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `tb_peserta`
--
ALTER TABLE `tb_peserta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
