-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2020 at 04:38 PM
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
CREATE DATABASE IF NOT EXISTS `id15678224_web` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `id15678224_web`;

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
(1, 'Web', 'Web', 'Web12', 'nguyentranquynhnhu25051999@gmail.com', 'images/img_read.jpg', '11-12-2020', '897d0729a8f2026064e4cab7fb771fca'),
(3, '123456', '123456', '123', 'hungt2766@gmail.com', 'images/img_code.jpg', '11-12-2020', 'e13e1b5d7993f348d4ed729718131f8f'),
(5, '123122', '3123123', '1231323', 'blightmedison313@gmail.com', 'images/Honors.jpg', '13-12-2020', '8a16feedc1385dcee2967b91813c870a');

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
(35, 'hungt2766@gmail.com', '1231231231', '12312312', 'uploads/file_5fd39696ad740web.sql', 0, '2020-12-11 15:56:06', 'e13e1b5d7993f348d4ed729718131f8f'),
(36, 'blightmedison313@gmail.com', '12231', '1231', 'uploads/file_5fd63be319c3bweb.sql', 0, '2020-12-13 16:05:55', '03d198cab272e3aae762070c78bdecab'),
(37, 'blightmedison313@gmail.com', '12', '12312', 'uploads/file_5fd63bec46f5fweb.sql', 1, '2020-12-13 16:06:04', '03d198cab272e3aae762070c78bdecab'),
(38, 'blightmedison313@gmail.com', 'asdas', 'assdasd', 'uploads/file_5fd63bf7e9929web.sql', 2, '2020-12-13 16:06:15', '03d198cab272e3aae762070c78bdecab'),
(39, 'blightmedison313@gmail.com', 'Project', 'Alelelele', 'uploads/file_5fd6e2519e7eaweb.sql', 2, '2020-12-14 03:56:01', '8a16feedc1385dcee2967b91813c870a'),
(40, 'blightmedison313@gmail.com', 'tets', 'demooooooaaa', 'uploads/file_5fd7020cdc721web.sql', 0, '2020-12-14 14:27:54', '8a16feedc1385dcee2967b91813c870a');

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
('minhhung', '$2y$10$xGN0gqSK5.3C34cxsN5YduRoS/P27/fkDAj8JO5nfmabDCeK0fYuy', 'Trương Minh Hưng', '25/05/1999', 'hungt2766@gmail.com', '0968030739', '058639030e4b651984247865b376fc1f', 1),
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
('blightmedison313@gmail.com', '8a16feedc1385dcee2967b91813c870a', ''),
('hungt2766@gmail.com', 'e13e1b5d7993f348d4ed729718131f8f', ''),
('nguyentranquynhnhu25051999@gmail.com', '897d0729a8f2026064e4cab7fb771fca', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classroom`
--
ALTER TABLE `classroom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

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

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classroom`
--
ALTER TABLE `classroom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
