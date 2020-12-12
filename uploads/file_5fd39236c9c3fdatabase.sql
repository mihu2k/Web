-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2020 at 02:27 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web`
--
CREATE DATABASE IF NOT EXISTS `web` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `web`;

-- --------------------------------------------------------

--
-- Table structure for table `classroom`
--

DROP TABLE IF EXISTS `classroom`;
CREATE TABLE `classroom` (
  `id` int(11) NOT NULL,
  `classname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `room` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `img` text COLLATE utf8_unicode_ci NOT NULL,
  `date_create` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `token` varchar(300) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `classroom`
--

INSERT INTO `classroom` (`id`, `classname`, `subject`, `room`, `email`, `img`, `date_create`, `token`) VALUES
(0, '123456', '123456', '123567', 'nguyentranquynhnhu25051999@gmail.com', 'images/img_read.jpg', '08-12-2020', '6ccb86d2a350880e09475a3fa94573ae');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(10) NOT NULL,
  `post_id` int(10) NOT NULL,
  `content` text NOT NULL,
  `email` varchar(30) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `post_id`, `content`, `email`, `date_created`) VALUES
(0, 0, 'ronaldooooo', 'nguyentranquynhnhu25051999@gma', '2020-12-06 16:05:06');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `user_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(1) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `token` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `user_email`, `title`, `content`, `file`, `type`, `date_created`, `token`) VALUES
(10, 'hoangvanle@gmail.com', 'gdf', 'gdfgfdgfdd', 'uploads/file_5fc7051c46e46', 2, '2020-12-02 17:59:19', '9901211752466b008b809382d37ba719'),
(11, 'hoangvanle@gmail.com', 'rfgd', 'fgfdgd', 'uploads/file_5fc705a39e9b0', 2, '2020-12-02 17:59:22', '9901211752466b008b809382d37ba719'),
(17, 'hoangvanle@gmail.com', 'fgdgdf', 'dfgfdg', 'uploads/file_5fc707aa31c08file_5fc7051c46e46.png', 0, '2020-12-02 17:59:24', '9901211752466b008b809382d37ba719'),
(18, 'hoangvanle@gmail.com', 'asdfasdf', 'asdfsadf', 'uploads/file_5fc7903fb8d88main.js (1).txt', 0, '2020-12-02 17:59:25', '9901211752466b008b809382d37ba719'),
(23, 'vungoctuan9a6dt@gmail.com', '12313211', 'fasdfasdfsdf s sdfsdf fdsfsdfs', 'uploads/file_5fc7debab25e4web (3).sql', 0, '2020-12-02 18:43:24', '9901211752466b008b809382d37ba719'),
(0, 'nguyentranquynhnhu25051999@gmail.com', 'file db', 'aluu alaa bakakaka', 'uploads/file_5fccfe77cc6dbweb.sql', 1, '2020-12-06 15:53:27', '9901211752466b008b809382d37ba719'),
(0, 'nguyentranquynhnhu25051999@gmail.com', 'demo', 'wakandaa', 'uploads/file_5fcd00ec8b350assignment.html', 0, '2020-12-06 16:03:56', '42bbeb61eb3d2636acaeaa8a6b4ca5a9'),
(0, 'nguyentranquynhnhu25051999@gmail.com', '1231', '123123123', 'uploads/file_5fcd04086591bassignment.html', 0, '2020-12-06 16:17:12', '623f458a975fbad5770e78226fcdb503');

-- --------------------------------------------------------

--
-- Table structure for table `reset_token`
--

DROP TABLE IF EXISTS `reset_token`;
CREATE TABLE `reset_token` (
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `expire_on` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `reset_token`
--

INSERT INTO `reset_token` (`email`, `token`, `expire_on`) VALUES
('blightmedison313@gmail.com', '27003566b8e32588b9db5bc8026ef320', 1606623243);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `username` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hoten` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngaysinh` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sdt` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `permission` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `hoten`, `ngaysinh`, `email`, `sdt`, `token`, `permission`) VALUES
('hoanghung', '$2y$10$rF5xkMMitjYm4TgaVetxPO0LtFXhk2XNfVaTqUj5dhOosFkaL/hSS', 'Nguyễn Hoàng Hưng', '25/05/1999', 'blightmedison313@gmail.com', '0968030739', '8be9ccd0c29230bf228df8bdeed4d3d0', 1),
('dangdang', '$2y$10$/zwc5g9wH3reSMPgG3fUkeAPxbDKNI8Lz.PGdXc0TdB9b2yOvjXh2', 'Phạm Hồng Hải Đăng', '25/05/1999', 'dang1212asd@gmail.com', '0968030739', '00849a563cb4f25ea49f16243962ef0a', 2),
('minhhung', '$2y$10$xGN0gqSK5.3C34cxsN5YduRoS/P27/fkDAj8JO5nfmabDCeK0fYuy', 'Trương Minh Hưng', '25/05/1999', 'hungt2766@gmail.com', '0968030739', '058639030e4b651984247865b376fc1f', 2),
('nhunhu', '$2y$10$UutMppkzzN5gIERvvlwTKuKaAmnoLpclA8aZEgfgK9ZNikodXRxw.', 'Nguyễn Trần Quỳnh Như', '25/05/1999', 'nguyentranquynhnhu2505@gmail.com', '0968030739', '5835de49859f6b282e0719b2728416a9', 1),
('Admin', '$2y$10$S1nSU5SDYD4en8IaJ5NAxu5ImiJzd48HLfjO9Bs.muhwz7Iu7Y/im', 'Admin', '25/05/1999', 'nguyentranquynhnhu25051999@gmail.com', '0968030739', 'f636a6d959d8646220b4681a4cac4bdb', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_classroom`
--

DROP TABLE IF EXISTS `user_classroom`;
CREATE TABLE `user_classroom` (
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_classroom`
--

INSERT INTO `user_classroom` (`email`, `token`, `status`) VALUES
('blightmedison313@gmail.com', '6ccb86d2a350880e09475a3fa94573ae', 'active'),
('nguyentranquynhnhu25051999@gmail.com', '6ccb86d2a350880e09475a3fa94573ae', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reset_token`
--
ALTER TABLE `reset_token`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `user_classroom`
--
ALTER TABLE `user_classroom`
  ADD PRIMARY KEY (`email`,`token`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
