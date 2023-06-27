-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2023 at 03:37 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app_pengaduan`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(100) NOT NULL,
  `jk` varchar(1) NOT NULL,
  `tempat_lahir` varchar(20) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `nohp` varchar(15) NOT NULL,
  `pict` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level_admin` varchar(50) DEFAULT 'admin',
  `eksekutor` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `jk`, `tempat_lahir`, `tanggal_lahir`, `nohp`, `pict`, `alamat`, `username`, `password`, `level_admin`, `eksekutor`) VALUES
(1, 'Ahmad Setiaji', 'L', 'Banjarmasin', '2000-09-23', '082148003994', '1674102631.jpg', 'Jl. Gambah RT. 06 No. 53', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 1),
(2, 'Nadia Aulia ', 'P', 'Balangan', '2001-08-18', '082236790444', '1674102450.jpg', 'Jl. Paringin Selatan No. 12', 'nadia', 'a2e8cea3392da09d1d31be3fca68efed', 'admin', 1),
(9, 'Al Ghifari', 'L', 'Malang', '2023-06-15', '085546112267', '', 'Jl Malang', 'petugas', '202cb962ac59075b964b07152d234b70', 'petugas', 3),
(11, 'Yolan', 'L', 'Malang', '2023-06-11', '083456742847', '1686187212.jpg', 'Jl Malang', 'kepala', '202cb962ac59075b964b07152d234b70', 'kepala', 1),
(12, 'Al', 'L', 'Malang', '2023-06-22', '083456742847', '1686192766.jpg', 'Jl Malang', 'satpol', '202cb962ac59075b964b07152d234b70', 'petugas', 2),
(13, 'Ghifa', 'L', 'Malang', '2023-06-08', '083456742847', '1686192966.png', 'Jl Malang', 'kepaladinas', '202cb962ac59075b964b07152d234b70', 'kepala', 1);

-- --------------------------------------------------------

--
-- Table structure for table `agama`
--

CREATE TABLE `agama` (
  `id_agama` int(11) NOT NULL,
  `nama_agama` varchar(30) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `agama`
--

INSERT INTO `agama` (`id_agama`, `nama_agama`, `status`) VALUES
(1, 'Islam', 1),
(2, 'Kristen', 1),
(3, 'Katholik', 1),
(4, 'Hindu', 1),
(7, 'Khonghucu', 1);

-- --------------------------------------------------------

--
-- Table structure for table `eksekutor`
--

CREATE TABLE `eksekutor` (
  `id_eksekutor` int(11) NOT NULL,
  `nama_eksekutor` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eksekutor`
--

INSERT INTO `eksekutor` (`id_eksekutor`, `nama_eksekutor`) VALUES
(1, 'Admin'),
(2, 'Satpol PP'),
(3, 'Dinas Kebersihan');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(2, 'Pengaduan'),
(3, 'Pelayanan'),
(4, 'Pencemaran'),
(5, 'Perusakan'),
(6, 'Penyaranan');

-- --------------------------------------------------------

--
-- Table structure for table `penduduk`
--

CREATE TABLE `penduduk` (
  `id_user` int(11) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` varchar(10) DEFAULT NULL,
  `jk` enum('L','P') DEFAULT NULL,
  `id_agama` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `nohp` varchar(20) NOT NULL,
  `pict` varchar(100) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `penduduk`
--

INSERT INTO `penduduk` (`id_user`, `nik`, `nama`, `tempat_lahir`, `tanggal_lahir`, `jk`, `id_agama`, `alamat`, `nohp`, `pict`, `username`, `password`, `is_active`) VALUES
(10, '6326160101810021', 'Agus Makmur', 'Tanjung', '19-07-2001', 'L', 1, 'Jl. Pembataan RT. 02', '081252542444', '1674087792.jpg', 'user1', '24c9e15e52afc47c225b757e7bee1f9d', 1),
(11, '6326160108060009', 'Fitri Wiriasari', 'Balangan', '08-03-1998', 'P', 1, ' Jl. Lingkar Timur No.KM. 1.7', '081384957099', '1674088093.jpg', 'user2', '7e58d63b60197ceb55a1c487989a3720', 0),
(12, '6326164107570382', 'David Salim ', 'Amuntai', '29-02-2004', 'L', 2, 'Jl. Empu Jatmika No. 214', '087876907543', '1674088285.jpg', 'user3', '92877af70a45fd6a2ed7fe81e1236b78', 0),
(13, '6226161812790001', 'Sri Solehah', 'Sampit', '01-09-2000', 'P', 1, 'Jl. MT Haryono No. 88 ', '081284429362', '1674088481.jpg', 'user4', '3f02ebe3d7929b091e3d8ccfde2f3bc6', 0),
(14, '6426160111080002', ' Merry Kristanti', 'Grogot', '28-11-1994', 'P', 2, 'Jl. Kapten Piere Tendean', '081270727288', '1674088591.jpg', 'user5', '0a791842f52a0acfbb3a783378c066b8', 0),
(15, '6326164511690002', 'Budiman Effendi', 'Kandangan', '26-10-2000', 'L', 3, 'Jl. Brigjen H. Hasan Basri', '085780091512', '1674089262.jpg', 'user6', 'affec3b64cf90492377a8114c86fc093', 0),
(16, '6326160108060101', 'Era Helvani', 'Barabai', '29-07-1999', 'P', 1, 'Jl. Pasar Murakata No. 20', '081289181917', '1674090187.jpg', 'user7', '3e0469fb134991f8f75a2760e409c6ed', 0),
(17, '124123', 'Al Ghifari Anwar', 'Malang', '14-06-2023', 'L', 1, 'Jl Tlogo Suryo', '085546112267', '1686144511.jpg', 'ghifa', '202cb962ac59075b964b07152d234b70', 1),
(18, '3573052203020001', 'Al Ghifari Anwar', 'Malang', '10-06-2023', 'L', 1, 'Jl Tlogo Suryo', '085546112267', '1686191998.JPG', 'alghifari', '202cb962ac59075b964b07152d234b70', 1),
(19, '123456', 'Muhammad Ghaziy Al Ghifari Anwar', 'Malang', '17-06-2023', 'L', 1, 'Jl Kemantren III No. 37', '085546112267', '1686634866.JPG', 'alghifari_anwar', '202cb962ac59075b964b07152d234b70', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id_pengaduan` int(30) NOT NULL,
  `nik` varchar(30) NOT NULL,
  `tanggal` date NOT NULL,
  `nama_laporan` varchar(200) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `tempat` varchar(100) NOT NULL,
  `pict` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL DEFAULT 1,
  `lat` text NOT NULL,
  `long` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pengaduan`
--

INSERT INTO `pengaduan` (`id_pengaduan`, `nik`, `tanggal`, `nama_laporan`, `id_kategori`, `tempat`, `pict`, `status`, `id_admin`, `lat`, `long`) VALUES
(29, '6326160101810021', '2023-01-19', 'Terjadi pembuangan Sampah sembarangan di sungai', 4, 'Sungai Pekapuran Raya', '1674091363.jpg', 2, 1, '', ''),
(30, '6326160108060101', '2023-01-19', 'Sampah di tempat ku gak di ambil padahal yang lain di ambil', 2, 'Jl. Manggis No. 52', '1674091576.jpg', 2, 1, '', ''),
(31, '6326160101810021', '2023-01-20', 'Karyawan DLH membuang sampah sembarang di jalan umum', 2, 'Jl. Veteran Gg. Muhajirin', '1674177768.jpg', 0, 1, '', ''),
(32, '6226161812790001', '2023-01-20', 'Sulitnya menghubungi Bag. Pengawasan', 3, 'Dinas Lingkungan Hidup', '1674177862.png', 2, 1, '', ''),
(33, '6426160111080002', '2023-01-21', 'Kumpulan bocah merusak spanduk “Dilarang Membuang  Sampah”', 5, 'Jl. Pramuka Simp. PDAM I No.56 ', '1674281731.jpeg', 0, 1, '', ''),
(34, '6326160101810021', '2023-01-24', 'Penebangan pohon liar', 5, 'Jl. Dharma Praja, Pemurus Luar', '1674529970.jpg', 1, 1, '', ''),
(35, '6326164511690002', '2023-01-24', 'Tolong dong bikin perlombaan kebersihan antar kampung', 6, 'Jl. Pramuka RT. 12 No.01', '1674530070.JPG', 2, 1, '', ''),
(36, '6326160108060101', '2023-01-26', 'Pasar terlihat sangat berantakan dan banyak sampah berhamburan', 4, 'Pasar Lama  Jl. A.Yani Km. 3', '1674733047.jpg', 1, 1, '', ''),
(37, '6326160108060009', '2023-01-26', 'ODGJ tiduran di tempat pejalan kaki dan membuat sampah  berhamburan', 2, 'Jl. Benua Anyar RT. 04 ', '1674733171.jpg', 2, 1, '', ''),
(38, '6326160101810021', '2023-01-26', 'Pembagian bak sampah perkecamatan yang dulu sudah rusak', 2, 'Jl. Ratu Zaleha RT. 17', '1674743171.jpg', 0, 1, '', ''),
(39, '124123', '2023-06-07', 'Sampah Berserakan', 2, 'Pasar', '1686144557.jpg', 2, 1, '', ''),
(40, '3573052203020001', '2023-06-08', 'Selokan tersumbat', 2, 'Perumahan Griya Asri', '1686192412.jpg', 2, 1, '', ''),
(41, '124123', '2023-06-10', 'Preman', 2, 'Pasar', '1686397959.jpg', 2, 1, '', ''),
(42, '124123', '2023-06-10', 'Cek Latlong', 2, 'Pasar', '1686399868.jpg', 2, 1, '-3.286228569117712', '114.63283054843752'),
(43, '123456', '2023-06-13', 'Pungli', 2, 'Perempatan Balai Kota', '1686635035.JPG', 2, 1, '-3.2802182903044255', '114.60124485507815');

-- --------------------------------------------------------

--
-- Table structure for table `surat`
--

CREATE TABLE `surat` (
  `id_surat` int(11) NOT NULL,
  `nomor_surat` varchar(50) NOT NULL,
  `jenis_surat` varchar(50) NOT NULL,
  `tujuan` varchar(50) NOT NULL,
  `objek` varchar(50) NOT NULL,
  `tanggal_surat` date NOT NULL,
  `status_surat` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surat`
--

INSERT INTO `surat` (`id_surat`, `nomor_surat`, `jenis_surat`, `tujuan`, `objek`, `tanggal_surat`, `status_surat`) VALUES
(1, '2023/XII/001', 'pengantar', 'Peminjaman', 'Satpol PP', '2023-06-08', 1),
(2, '122/XII/2023', 'peringatan', 'Sampah yang berserakan', 'Dinas Kebersihan', '2023-06-08', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tindakan`
--

CREATE TABLE `tindakan` (
  `id_tindakan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `id_pengaduan` int(11) NOT NULL,
  `bentuk_tindakan` text NOT NULL,
  `tim_eksekutor` varchar(150) NOT NULL,
  `hasil` varchar(150) NOT NULL,
  `penjadwalan` date NOT NULL DEFAULT current_timestamp(),
  `bukti` varchar(255) DEFAULT NULL,
  `lat` text NOT NULL,
  `long` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tindakan`
--

INSERT INTO `tindakan` (`id_tindakan`, `tanggal`, `id_pengaduan`, `bentuk_tindakan`, `tim_eksekutor`, `hasil`, `penjadwalan`, `bukti`, `lat`, `long`) VALUES
(8, '2023-01-20', 30, 'Diberikan peringatan pertama kepada \r\nTim Truk Sampah', 'Kabid Kebesihan', 'Sampah akan di ambil  kembali', '2023-06-08', NULL, '', ''),
(9, '2023-01-20', 29, 'Dibersihkan dan di lakukan pematau \r\npada pelaku pembuang sampah', 'DISTAKOBER', 'Pelaku pembuang sampah  diberikan denda', '2023-06-08', NULL, '', ''),
(10, '2023-01-22', 32, 'Dilakuakn banding dan evaluasi', 'Kabid Pengawasan', 'Sementara diberikan teguran', '2023-06-08', NULL, '', ''),
(11, '2023-01-24', 35, 'Dilakukan penampungan aspirasi dan di \r\nrapatkan', 'Kabid Tata Lingkungan', 'Lomba kebersihan akan  diadakan pada bulan ini', '2023-06-08', NULL, '', ''),
(12, '2023-01-26', 37, 'Dilakukan penjemputan dan segera di\r\ntertibkan', 'Satpol PP', 'Dikirimkan ke Dinas Sosial', '2023-06-08', NULL, '', ''),
(15, '2023-06-08', 39, 'Pembersihan', 'Dinas Kebersihan', 'Sudah Bersih', '2023-06-09', 'kisspng-coffee-starbucks-frappuccino-drink-gift-card-starbuck-card-5b4ebf9adc5ff8_1954815315318875149027.jpg', '', ''),
(16, '2023-06-08', 40, 'Pembersihan selokan', 'Dinas Kebersihan', 'Sudah tidak tersumbat', '2023-06-09', 'DSC_6929.JPG', '', ''),
(17, '2023-06-10', 41, '', '2', '', '2023-06-11', NULL, '', ''),
(18, '2023-06-10', 42, '', '2', '', '2023-06-16', NULL, '-3.286228569117712', '114.63283054843752'),
(19, '2023-06-13', 43, '', '2', '', '2023-06-14', NULL, '-3.2802182903044255', '114.60124485507815');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `agama`
--
ALTER TABLE `agama`
  ADD PRIMARY KEY (`id_agama`);

--
-- Indexes for table `eksekutor`
--
ALTER TABLE `eksekutor`
  ADD PRIMARY KEY (`id_eksekutor`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `penduduk`
--
ALTER TABLE `penduduk`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `penduduk` (`id_agama`);

--
-- Indexes for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id_pengaduan`);

--
-- Indexes for table `surat`
--
ALTER TABLE `surat`
  ADD PRIMARY KEY (`id_surat`);

--
-- Indexes for table `tindakan`
--
ALTER TABLE `tindakan`
  ADD PRIMARY KEY (`id_tindakan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `agama`
--
ALTER TABLE `agama`
  MODIFY `id_agama` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `eksekutor`
--
ALTER TABLE `eksekutor`
  MODIFY `id_eksekutor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `penduduk`
--
ALTER TABLE `penduduk`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id_pengaduan` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `surat`
--
ALTER TABLE `surat`
  MODIFY `id_surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tindakan`
--
ALTER TABLE `tindakan`
  MODIFY `id_tindakan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
