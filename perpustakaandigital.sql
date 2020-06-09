-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 03, 2013 at 04:59 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `perpustakaandigital`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE IF NOT EXISTS `buku` (
  `id_buku` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `id_penerbit` int(11) NOT NULL,
  `nama_pengarang` varchar(255) NOT NULL,
  `tahun` year(4) NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  PRIMARY KEY (`id_buku`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `judul`, `id_kategori`, `id_jenis`, `id_penerbit`, `nama_pengarang`, `tahun`, `nama_file`, `deskripsi`) VALUES
(7, 'PHP', 1, 3, 5, '--', 0000, 'PHP5.pdf', 'Paesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy euismod tincidunt ut laoreet.\r\n\r\nPaesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy euismod tincidunt ut laoreet.'),
(8, 'PostgreSql', 3, 2, 6, 'Rofiq Yuliardi', 0000, 'PostgreSQL.pdf', 'Pada Intinya Perintah Dasar SQL Termasuk Administrasi Database PostgreSQL Adalah Identik, Tetapi Untuk GUI dan Perintah Lanjut Buku Pada Buku Ini Mungkin Tidak Kompatibel Lagi Dengan Versi Database Terbaru atau versi yang Anda Gunakan.'),
(9, 'Introduction to SQL', 3, 3, 5, 'James Hoffman', 2001, 'sql_intro.pdf', 'This page is a introductory tutorial of the Structured Query Language (also known as SQL) and is a pioneering effort on the World Wide Web, as this is the first comprehensive SQL tutorial available on the Internet. SQL allows users to access data in relational database management systems, such as Oracle, Sybase, Informix, Microsoft SQL Server, Access, and others, by allowing users to describe the data the user wishes to see. SQL also allows users to define the data in a database, and manipulate that data. This page will describe how to use SQL, and give examples. The SQL used in this document is "ANSI", or standard SQL, and no SQL features of specific database management systems will be discussed until the "Nonstandard SQL" section. It is recommended that you print this page, so that you can easily refer back to previous examples. Also, you may be interested in joining the new SQL Club on Yahoo!, where you can read or enter messages in a SQL forum.'),
(10, 'Tutorial SQL', 3, 3, 5, 'Unknown', 0000, 'tutorial-sql-structured-query-language.pdf', 'Paesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy euismod tincidunt ut laoreet.\r\n\r\nPaesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy euismod tincidunt ut laoreet.'),
(11, 'Konsep Dasar Python', 1, 3, 5, 'Dini Triasanti', 0000, 'KONSEP DASAR PYTHON.pdf', 'Pada awalnya, motivasi pembuatan bahasa pemrograman ini adalah untuk bahasa skrip tingkat tinggi pada sistem operasi terdistribusi Amoeba. Bahasa pemrograman ini menjadi umum digunakan untuk kalangan engineer seluruh dunia dalam pembuatan perangkat lunaknya, bahkan beberapa perusahaan menggunakan python sebagai pembuat perangkat lunak komersial. Python merupakan bahasa pemrograman yang freeware atau perangkat bebas dalam arti sebenarnya, tidak ada batasan dalam penyalinannya atau mendistribusikannya. Lengkap dengan source codenya, debugger dan profiler, antarmuka yang terkandung di dalamnya untuk pelayanan antarmuka, fungsi sistem, GUI (antarmuka pengguna grafis), dan basis datanya.'),
(12, 'Programming in C 3rd Edition', 1, 2, 7, 'Stephen G. Kochan', 0000, 'Programming_in_C_3rd_Edition.pdf', 'Stephen Kochan has been developing software with the C programming language for over 20 years. He is the author and coauthor of several bestselling titles on the Clanguage, including Programming in C, Programming in ANSI C, and Topics in C Programming, and several Unix titles, including Exploring the Unix System, Unix Shell Programming, and Unix System Security. Mr. Kochanâ€™s most recent title, Programming in Objective-C, is a tutorial on an object-oriented programming language that is based on C.'),
(13, 'How Stuff Works : C Programming', 1, 3, 2, 'Marshall Brain', 2000, 'HowStuffWorks _The Basics of C Programming_.pdf', 'The C programming language is a popular and widely used programming language for creating computer programs. Programmers around the world embrace C because it gives maximum control and efficiency to the programmer.'),
(14, 'Easy PHP Websites with ZendFramework', 1, 2, 4, 'W. Jason Gilmore', 2010, 'Easy PHP Websites with the Zend Framework (W. Jason Gilmore) (2011)(T).pdf', 'This book introduces several of the most commonly used features of the Zend Framework,\r\norganizing these topics into the following twelve chapters:\r\nChapter 1. Introducing Framework-Driven Development\r\nChapter 2. Creating Your First Zend Framework Project\r\nChapter 3. Managing Layouts, Views, CSS, Images, and JavaScript\r\nChapter 4. Managing Configuration Data\r\nChapter 5. Creating Web Forms with Zend_Form\r\nChapter 6. Talking to the Database with Zend_Db\r\nChapter 7. Integrating Doctrine 2\r\nChapter 8. Managing User Accounts\r\nChapter 9. Creating Rich User Interfaces with JavaScript and Ajax\r\nChapter 10. Integrating Web Services\r\nChapter 11. Unit Testing Your Zend Framework Application\r\nChapter 12. Deploying Your Website with Capistrano'),
(15, 'Ajax for Dummies', 1, 2, 3, 'Steve Holzner', 2011, 'Ajax  for Dummies.pdf', 'This book gives you the whole Ajax story, from soup to nuts. It starts with a tour of how Ajax is used today, taking a look at some cutting-edge applica-tions (as well as some games). \r\n\r\nThen, because Ajax is based on using\r\nJavaScript in the browser, thereâ€™s a chapter on how to use JavaScript (if you\r\nalready know JavaScript, feel free to skip that material).\r\n\r\nThen the book plunges into Ajax itself, creating Ajax applications from scratch, from the beginning level to the most advanced. And youâ€™ll see how\r\nto put many of the free Ajax frameworks, which do the programming for you, to work. Because Ajax also often involves using XML, Cascading Style Sheets (CSS), and server-side programming (using PHP in this book), thereâ€™s also a chapter on each of these topics.\r\n\r\nYou can also leaf through this book as you like, rather than having to read it\r\nfrom beginning to end. Like other For Dummies books, this one has been designed to let you skip around as much as possible. You donâ€™t have to read\r\nthe chapters in order if you donâ€™t want to. This is your book, and Ajax is your\r\noyster.'),
(16, 'Programming Ruby', 1, 2, 3, 'Rubies', 2010, 'Programming.Ruby.-.The.Pragmatic.Programmer_S.Guide.pdf', 'Paesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy euismod tincidunt ut laoreet.\r\n\r\nPaesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy euismod tincidunt ut laoreet.'),
(17, 'Easy PHP Website', 1, 2, 4, 'W. Jason Gilmore', 2009, 'easy php websites.pdf', 'Jumpstart your web developtment career using pupolar technologies includeing PHP, and MySQL, Ajax, RSS, PayPal, Facebook Platform, Amazon Web Service, The Google Maps API, the Google Analytics web analytics services, the Google Adsense, and Google Adwords advertising services, and more.');

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
--

CREATE TABLE IF NOT EXISTS `jenis` (
  `id_jenis` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jenis` varchar(255) NOT NULL,
  PRIMARY KEY (`id_jenis`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `jenis`
--

INSERT INTO `jenis` (`id_jenis`, `nama_jenis`) VALUES
(2, 'Cetak'),
(3, 'Paper');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(255) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Pemrograman'),
(3, 'Database');

-- --------------------------------------------------------

--
-- Table structure for table `penerbit`
--

CREATE TABLE IF NOT EXISTS `penerbit` (
  `id_penerbit` int(11) NOT NULL AUTO_INCREMENT,
  `nama_penerbit` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `kota` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telp` varchar(255) NOT NULL,
  PRIMARY KEY (`id_penerbit`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `penerbit`
--

INSERT INTO `penerbit` (`id_penerbit`, `nama_penerbit`, `alamat`, `kota`, `email`, `telp`) VALUES
(2, 'HowStuffWorks', 'aaaa', 'aaa', 'aaa', 'aaa'),
(3, 'Wiley Production', '--', '--', '--', '--'),
(4, 'W. Jason Gilmore', '--', '--', '--', '--'),
(5, 'Unknown', '-', '-', '-', '-'),
(6, 'Rofiq Yuliardi', '--', '--', '--', '--'),
(7, 'Sams Publishing', '--', '--', '--', '--');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `nama_lengkap`, `password`) VALUES
(1, 'admin', 'Administrator', '21232f297a57a5a743894a0e4a801fc3');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
