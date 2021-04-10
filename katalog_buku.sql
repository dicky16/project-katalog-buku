-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 09, 2021 at 01:12 PM
-- Server version: 5.7.26
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `katalog_buku`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

DROP TABLE IF EXISTS `blog`;
CREATE TABLE IF NOT EXISTS `blog` (
  `id_blog` int(11) NOT NULL AUTO_INCREMENT,
  `id_kategori_blog` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `tanggal` date NOT NULL DEFAULT '1999-01-01',
  `judul` varchar(255) DEFAULT NULL,
  `isi` text,
  PRIMARY KEY (`id_blog`),
  KEY `kategori_blog` (`id_kategori_blog`),
  KEY `user_blog` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id_blog`, `id_kategori_blog`, `id_user`, `tanggal`, `judul`, `isi`) VALUES
(1, 1, 1, '2021-02-24', 'Teknologi Terkini', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.'),
(2, 3, 1, '2021-02-24', 'Versi Terbaru Android Studio', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.'),
(4, 3, 3, '2021-03-24', 'Pemgoraman Kotlin', '<p>cek</p>\r\n'),
(6, 3, 3, '2021-03-23', 'android', '<p>ini android</p>\r\n'),
(8, 1, 3, '2021-03-24', 'aku teknologi', '<p>kok</p>\r\n'),
(10, 2, 3, '2021-03-24', 'aku edit', '<p>oke a</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

DROP TABLE IF EXISTS `buku`;
CREATE TABLE IF NOT EXISTS `buku` (
  `id_buku` int(11) NOT NULL AUTO_INCREMENT,
  `id_kategori_buku` int(11) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `pengarang` varchar(255) DEFAULT NULL,
  `id_penerbit` int(11) DEFAULT NULL,
  `tahun_terbit` int(11) DEFAULT NULL,
  `sinopsis` text,
  `cover` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_buku`) USING BTREE,
  KEY `kategori_buku` (`id_kategori_buku`),
  KEY `penerbit_buku` (`id_penerbit`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `id_kategori_buku`, `judul`, `pengarang`, `id_penerbit`, `tahun_terbit`, `sinopsis`, `cover`) VALUES
(1, 1, 'Pemrograman Web dengan PHP 7', 'Betha Sidik', 4, 2019, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'cover_php7.jpg'),
(2, 4, 'Machine Learning Tingkat Dasar dan Lanjut', 'Suyanto', 4, 2020, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'cover_machine_learning.jpg'),
(4, 7, 'Logika Fuzzy', 'Sri Kusuma Dewi', 1, 2017, 'cover_fuzzyLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'cover_fuzzy.jpg'),
(12, 4, 'Python', 'Aku', 4, 2021, '<p>sdsd sdsdsds</p>\r\n', '164517-IMG_7682.JPG'),
(14, 5, 'aku tambah judul', 'ok pengrang', 3, 2021, '<p>ok sinop</p>\r\n\r\n<p>&nbsp;</p>\r\n', '142401-master card.png'),
(15, 5, 'aku tambah judul', 'ok pengrang', 3, 2021, '<p>ok sinop</p>\r\n\r\n<p>&nbsp;</p>\r\n', '142441-2020-12-26 (1).png');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_blog`
--

DROP TABLE IF EXISTS `kategori_blog`;
CREATE TABLE IF NOT EXISTS `kategori_blog` (
  `id_kategori_blog` int(11) NOT NULL AUTO_INCREMENT,
  `kategori_blog` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_kategori_blog`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_blog`
--

INSERT INTO `kategori_blog` (`id_kategori_blog`, `kategori_blog`) VALUES
(1, 'Teknologi'),
(2, 'Pemrograman'),
(3, 'Android'),
(4, 'IoT');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_buku`
--

DROP TABLE IF EXISTS `kategori_buku`;
CREATE TABLE IF NOT EXISTS `kategori_buku` (
  `id_kategori_buku` int(11) NOT NULL AUTO_INCREMENT,
  `kategori_buku` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_kategori_buku`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_buku`
--

INSERT INTO `kategori_buku` (`id_kategori_buku`, `kategori_buku`) VALUES
(1, 'Website'),
(3, 'Desain'),
(4, 'Machine Learning'),
(5, 'Pemrograman'),
(6, 'Database'),
(7, 'Artificial Intelligence'),
(8, 'Software Enginering'),
(9, 'Development'),
(10, 'Mobile'),
(15, 'Ates edit'),
(21, 'tes tambah');

-- --------------------------------------------------------

--
-- Table structure for table `konten`
--

DROP TABLE IF EXISTS `konten`;
CREATE TABLE IF NOT EXISTS `konten` (
  `id_konten` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) DEFAULT NULL,
  `isi` text,
  `tanggal` date NOT NULL DEFAULT '1999-01-01',
  PRIMARY KEY (`id_konten`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `konten`
--

INSERT INTO `konten` (`id_konten`, `judul`, `isi`, `tanggal`) VALUES
(1, 'Buku adalah gudang ilmu', '<p>&nbsp;&quot;Berbagi buku tentang kehidupan dan pengalaman dengan orang lain. Itu adalah catatan seumur hidup untuk semua generasi.&quot;</p>\r\n', '2021-04-09'),
(2, 'ABOUT US', '<p>Dengan konsep one stop shopping untuk semua produk buku, <strong>KATALOG BUKU</strong>&nbsp;menyediakan berbagai koleksi berkualitas untuk bacaan Ilmu Pengetahuan, Artikel, Jurnal, Skripsi, Dan Lain-Lain. <strong>KATALOG BUKU</strong> menyediakan beragam gaya dan desain terbaru untuk memenuhi kebutuhan pelanggan terhadap buku bacaan berkualitas.<br />\r\nSekarang, <strong>KATALOG BUKU&nbsp;</strong>mengembangkan konsep terbaru &ldquo;desain inovatif dan tahan lama dengan harga terjangkau&rdquo;.</p>\r\n', '2021-04-09');

-- --------------------------------------------------------

--
-- Table structure for table `penerbit`
--

DROP TABLE IF EXISTS `penerbit`;
CREATE TABLE IF NOT EXISTS `penerbit` (
  `id_penerbit` int(11) NOT NULL AUTO_INCREMENT,
  `penerbit` varchar(100) DEFAULT NULL,
  `alamat` text,
  PRIMARY KEY (`id_penerbit`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penerbit`
--

INSERT INTO `penerbit` (`id_penerbit`, `penerbit`, `alamat`) VALUES
(1, 'Graha Ilmu', 'Candi Gebang Permai Blok R-6 Yogyakarta'),
(2, 'Andi', 'JL Beo 38-40 Yogyakarta'),
(3, 'Lokomedia', 'JL. Jambon, Perum. Persona Alam Hijau Kav 2. B-4, Kricak Yogyakarta'),
(4, 'Informatika', 'Pasar Buku Palasari No. 82 Bandung'),
(5, 'Elek Media Komputindo', 'Jakarta'),
(6, 'Graha Media', 'Jakarta'),
(9, 'aku edit', '<p>aku</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
CREATE TABLE IF NOT EXISTS `tag` (
  `id_tag` int(11) NOT NULL AUTO_INCREMENT,
  `tag` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_tag`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`id_tag`, `tag`) VALUES
(1, 'PHP'),
(2, 'MySQL'),
(3, 'Android'),
(4, 'Javascript'),
(5, 'Phyton'),
(6, 'UML'),
(7, 'Bahasa Inggris'),
(8, 'Bahasa Jepang'),
(10, 'Oracle'),
(11, 'HTML'),
(12, 'CSS'),
(13, 'Deep Learning'),
(14, 'Frontend'),
(15, 'Framework'),
(16, 'Fuzzy'),
(17, 'Neural Network');

-- --------------------------------------------------------

--
-- Table structure for table `tag_buku`
--

DROP TABLE IF EXISTS `tag_buku`;
CREATE TABLE IF NOT EXISTS `tag_buku` (
  `id_tag_buku` int(11) NOT NULL AUTO_INCREMENT,
  `id_buku` int(11) DEFAULT NULL,
  `id_tag` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_tag_buku`),
  KEY `tag_tag` (`id_tag`),
  KEY `buku_buku` (`id_buku`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tag_buku`
--

INSERT INTO `tag_buku` (`id_tag_buku`, `id_buku`, `id_tag`) VALUES
(3, 2, 13),
(4, 2, 5),
(5, 4, 16),
(6, 1, 1),
(7, 1, 2),
(8, 12, 5),
(11, 14, 7),
(12, 15, 7);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `level` varchar(30) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `email`, `username`, `password`, `level`, `foto`) VALUES
(1, 'Salnan Ratih', 'salnanratih88@gmail.com', 'salnan', '1b2cef635fc0f78859747845f3de06bb', 'Superadmin', 'salnan.jpg'),
(2, 'Arif Agung', 'arif44@gmail.com', 'arif', '0ff6c3ace16359e41e37d40b8301d67f', 'Admin', 'master card.png'),
(3, 'dikky setiawan', 'setyawandicky88@gmail.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Superadmin', '12.jpg'),
(4, 'admin', 'admin@gmail.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Superadmin', 'master card.png');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog`
--
ALTER TABLE `blog`
  ADD CONSTRAINT `blog_ibfk_1` FOREIGN KEY (`id_kategori_blog`) REFERENCES `kategori_blog` (`id_kategori_blog`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `blog_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`id_kategori_buku`) REFERENCES `kategori_buku` (`id_kategori_buku`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `buku_ibfk_2` FOREIGN KEY (`id_penerbit`) REFERENCES `penerbit` (`id_penerbit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tag_buku`
--
ALTER TABLE `tag_buku`
  ADD CONSTRAINT `tag_buku_ibfk_1` FOREIGN KEY (`id_tag`) REFERENCES `tag` (`id_tag`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tag_buku_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
