-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2023 at 01:38 PM
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
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `jk`, `tempat_lahir`, `tanggal_lahir`, `nohp`, `pict`, `alamat`, `username`, `password`) VALUES
(1, 'Ahmad Setiaji', 'L', 'Banjarmasin', '2000-09-23', '082148003994', '1674102631.jpg', 'Jl. Gambah RT. 06 No. 53', 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(2, 'Nadia Aulia ', 'P', 'Balangan', '2001-08-18', '082236790444', '1674102450.jpg', 'Jl. Paringin Selatan No. 12', 'nadia', 'a2e8cea3392da09d1d31be3fca68efed');

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
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `penduduk`
--

INSERT INTO `penduduk` (`id_user`, `nik`, `nama`, `tempat_lahir`, `tanggal_lahir`, `jk`, `id_agama`, `alamat`, `nohp`, `pict`, `username`, `password`) VALUES
(10, '6326160101810021', 'Agus Makmur', 'Tanjung', '19-07-2001', 'L', 1, 'Jl. Pembataan RT. 02', '081252542444', '1674087792.jpg', 'user1', '24c9e15e52afc47c225b757e7bee1f9d'),
(11, '6326160108060009', 'Fitri Wiriasari', 'Balangan', '08-03-1998', 'P', 1, ' Jl. Lingkar Timur No.KM. 1.7', '081384957099', '1674088093.jpg', 'user2', '7e58d63b60197ceb55a1c487989a3720'),
(12, '6326164107570382', 'David Salim ', 'Amuntai', '29-02-2004', 'L', 2, 'Jl. Empu Jatmika No. 214', '087876907543', '1674088285.jpg', 'user3', '92877af70a45fd6a2ed7fe81e1236b78'),
(13, '6226161812790001', 'Sri Solehah', 'Sampit', '01-09-2000', 'P', 1, 'Jl. MT Haryono No. 88 ', '081284429362', '1674088481.jpg', 'user4', '3f02ebe3d7929b091e3d8ccfde2f3bc6'),
(14, '6426160111080002', ' Merry Kristanti', 'Grogot', '28-11-1994', 'P', 2, 'Jl. Kapten Piere Tendean', '081270727288', '1674088591.jpg', 'user5', '0a791842f52a0acfbb3a783378c066b8'),
(15, '6326164511690002', 'Budiman Effendi', 'Kandangan', '26-10-2000', 'L', 3, 'Jl. Brigjen H. Hasan Basri', '085780091512', '1674089262.jpg', 'user6', 'affec3b64cf90492377a8114c86fc093'),
(16, '6326160108060101', 'Era Helvani', 'Barabai', '29-07-1999', 'P', 1, 'Jl. Pasar Murakata No. 20', '081289181917', '1674090187.jpg', 'user7', '3e0469fb134991f8f75a2760e409c6ed');

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
  `id_admin` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pengaduan`
--

INSERT INTO `pengaduan` (`id_pengaduan`, `nik`, `tanggal`, `nama_laporan`, `id_kategori`, `tempat`, `pict`, `status`, `id_admin`) VALUES
(29, '6326160101810021', '2023-01-19', 'Terjadi pembuangan Sampah sembarangan di sungai', 4, 'Sungai Pekapuran Raya', '1674091363.jpg', 2, 1),
(30, '6326160108060101', '2023-01-19', 'Sampah di tempat ku gak di ambil padahal yang lain di ambil', 2, 'Jl. Manggis No. 52', '1674091576.jpg', 2, 1),
(31, '6326160101810021', '2023-01-20', 'Karyawan DLH membuang sampah sembarang di jalan umum', 2, 'Jl. Veteran Gg. Muhajirin', '1674177768.jpg', 0, 1),
(32, '6226161812790001', '2023-01-20', 'Sulitnya menghubungi Bag. Pengawasan', 3, 'Dinas Lingkungan Hidup', '1674177862.png', 2, 1),
(33, '6426160111080002', '2023-01-21', 'Kumpulan bocah merusak spanduk “Dilarang Membuang  Sampah”', 5, 'Jl. Pramuka Simp. PDAM I No.56 ', '1674281731.jpeg', 0, 1),
(34, '6326160101810021', '2023-01-24', 'Penebangan pohon liar', 5, 'Jl. Dharma Praja, Pemurus Luar', '1674529970.jpg', 1, 1),
(35, '6326164511690002', '2023-01-24', 'Tolong dong bikin perlombaan kebersihan antar kampung', 6, 'Jl. Pramuka RT. 12 No.01', '1674530070.JPG', 2, 1),
(36, '6326160108060101', '2023-01-26', 'Pasar terlihat sangat berantakan dan banyak sampah berhamburan', 4, 'Pasar Lama  Jl. A.Yani Km. 3', '1674733047.jpg', 1, 1),
(37, '6326160108060009', '2023-01-26', 'ODGJ tiduran di tempat pejalan kaki dan membuat sampah  berhamburan', 2, 'Jl. Benua Anyar RT. 04 ', '1674733171.jpg', 2, 1),
(38, '6326160101810021', '2023-01-26', 'Pembagian bak sampah perkecamatan yang dulu sudah rusak', 2, 'Jl. Ratu Zaleha RT. 17', '1674743171.jpg', 1, 1);

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
  `hasil` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tindakan`
--

INSERT INTO `tindakan` (`id_tindakan`, `tanggal`, `id_pengaduan`, `bentuk_tindakan`, `tim_eksekutor`, `hasil`) VALUES
(8, '2023-01-20', 30, 'Diberikan peringatan pertama kepada \r\nTim Truk Sampah', 'Kabid Kebesihan', 'Sampah akan di ambil  kembali'),
(9, '2023-01-20', 29, 'Dibersihkan dan di lakukan pematau \r\npada pelaku pembuang sampah', 'DISTAKOBER', 'Pelaku pembuang sampah  diberikan denda'),
(10, '2023-01-22', 32, 'Dilakuakn banding dan evaluasi', 'Kabid Pengawasan', 'Sementara diberikan teguran'),
(11, '2023-01-24', 35, 'Dilakukan penampungan aspirasi dan di \r\nrapatkan', 'Kabid Tata Lingkungan', 'Lomba kebersihan akan  diadakan pada bulan ini'),
(12, '2023-01-26', 37, 'Dilakukan penjemputan dan segera di\r\ntertibkan', 'Satpol PP', 'Dikirimkan ke Dinas Sosial');

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
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `agama`
--
ALTER TABLE `agama`
  MODIFY `id_agama` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `penduduk`
--
ALTER TABLE `penduduk`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id_pengaduan` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tindakan`
--
ALTER TABLE `tindakan`
  MODIFY `id_tindakan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
