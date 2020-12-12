-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 12, 2020 lúc 07:53 AM
-- Phiên bản máy phục vụ: 10.4.14-MariaDB
-- Phiên bản PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `web`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `classroom`
--

CREATE TABLE `classroom` (
  `id` int(11) NOT NULL,
  `classname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `room` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `img` text COLLATE utf8_unicode_ci NOT NULL,
  `date_create` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `token` varchar(300) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `classroom`
--

INSERT INTO `classroom` (`id`, `classname`, `subject`, `room`, `email`, `img`, `date_create`, `token`) VALUES
(0, '123456', '123456', '123567', 'nguyentranquynhnhu25051999@gmail.com', 'images/img_read.jpg', '08-12-2020', '6ccb86d2a350880e09475a3fa94573ae'),
(0, '123', '2', '3444444343', 'blightmedison313@gmail.com', 'images/img_bookclub.jpg', '11-12-2020', '3add6d053424a587d130071fcfef6659'),
(0, 'sdasdasd', '321312312312', '3444444343', 'hungt2766@gmail.com', 'images/Honors.jpg', '11-12-2020', 'f848986d7019612d917d77b96e5ea0b8'),
(0, '543534', '435345', '543534', 'hungt2766@gmail.com', 'images/Honors.jpg', '11-12-2020', '69252677de5722e669d4b497498f410f'),
(0, '54353', '4546', '63463', 'hungt2766@gmail.com', 'images/LanguageArts.jpg', '11-12-2020', 'f65c5520658a1decfb0bf1fa4791a56c'),
(0, '97698', '796847', '56879', 'hungt2766@gmail.com', 'images/img_learnlanguage.jpg', '11-12-2020', '7c7d982a7b7bc3b962e46491c738c241'),
(0, '87fghfghfg', 'hfghfdhfdj', 'fjfdjdhfgh', 'hungt2766@gmail.com', 'images/img_violin2.jpg', '11-12-2020', '88033fe292f73de17c9d44403d00b389'),
(0, '453', 'gdshfgjnfd', 'ẹagjfgjkr', 'hungt2766@gmail.com', 'images/img_code.jpg', '11-12-2020', 'bb6174a1d4657cda5964fbec59836cfe'),
(0, '..,.n,vmvbm', 'g,g,hj,', ',gh,hff,mg', 'hungt2766@gmail.com', 'images/img_concert.jpg', '11-12-2020', '1f6687c1fe42afd5e87597c65b76d2ae'),
(0, '7\\\';op\'pô\\', 'p\'op\\\'op\'\\op\'', '\\op\'op\\\'op', 'hungt2766@gmail.com', 'images/img_read.jpg', '11-12-2020', '23fbbaad4a5eca3b54212efd908a92b5'),
(0, 'ghjgh5745', '54645fdgdfghd', '65756756fg', 'hungt2766@gmail.com', 'images/img_learnlanguage.jpg', '11-12-2020', 'd2ee649b754117cc6427d843802fb1e0'),
(0, '6575675', '75678567', '56756756', 'hungt2766@gmail.com', 'images/img_violin2.jpg', '11-12-2020', '02d50d76e68311ef23c29f2c4dfdc869'),
(0, '5679879', '789780', '934525', 'hungt2766@gmail.com', 'images/img_bookclub.jpg', '11-12-2020', '72902e77f3759e62adb42e74cf32ce0e'),
(0, '4535235432', '4412414', '2342354', 'hungt2766@gmail.com', 'images/img_breakfast.jpg', '11-12-2020', 'ad1fa70f4b8464eb038ab73d2c0486a7'),
(0, '634534', '43543', '112312`', 'hungt2766@gmail.com', 'images/img_concert.jpg', '11-12-2020', 'b9c3a9d8ef5db7d17f871a40c3a6a5ac'),
(0, 'HK1_2020_503040_Công nghệ phần mềm', '796847', '6876', 'hungt2766@gmail.com', 'images/img_violin2.jpg', '12-12-2020', 'b66b070100ec31a12122624984ac2373'),
(0, 'HK1_2020_503040_Phân tích và thiết kế giải thuật_N02_1', '796847', '568791', 'hungt2766@gmail.com', 'images/LanguageArts.jpg', '12-12-2020', '716892fb107997306b128512ef0c57ee'),
(0, 'HK1_2020_503040_Hệ thống thông tin trong quản lý quan hệ khách hàng_N02_1', '46243', '52423', 'hungt2766@gmail.com', 'images/img_learnlanguage.jpg', '12-12-2020', '06822b344e8b550bbb939af2b7997511');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comment`
--

CREATE TABLE `comment` (
  `id` int(10) NOT NULL,
  `post_id` int(10) NOT NULL,
  `content` text NOT NULL,
  `email` varchar(30) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news`
--

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
-- Đang đổ dữ liệu cho bảng `news`
--

INSERT INTO `news` (`id`, `user_email`, `title`, `content`, `file`, `type`, `date_created`, `token`) VALUES
(10, 'hoangvanle@gmail.com', 'gdf', 'gdfgfdgfdd', 'uploads/file_5fc7051c46e46', 2, '2020-12-02 17:59:19', '9901211752466b008b809382d37ba719'),
(11, 'hoangvanle@gmail.com', 'rfgd', 'fgfdgd', 'uploads/file_5fc705a39e9b0', 2, '2020-12-02 17:59:22', '9901211752466b008b809382d37ba719'),
(17, 'hoangvanle@gmail.com', 'fgdgdf', 'dfgfdg', 'uploads/file_5fc707aa31c08file_5fc7051c46e46.png', 0, '2020-12-02 17:59:24', '9901211752466b008b809382d37ba719'),
(18, 'hoangvanle@gmail.com', 'asdfasdf', 'asdfsadf', 'uploads/file_5fc7903fb8d88main.js (1).txt', 0, '2020-12-02 17:59:25', '9901211752466b008b809382d37ba719'),
(23, 'vungoctuan9a6dt@gmail.com', '12313211', 'fasdfasdfsdf s sdfsdf fdsfsdfs', 'uploads/file_5fc7debab25e4web (3).sql', 0, '2020-12-02 18:43:24', '9901211752466b008b809382d37ba719'),
(24, 'nguyentranquynhnhu25051999@gmail.com', 'file db', 'aluu alaa bakakaka', 'uploads/file_5fccfe77cc6dbweb.sql', 1, '2020-12-06 15:53:27', '9901211752466b008b809382d37ba719'),
(25, 'nguyentranquynhnhu25051999@gmail.com', 'demo', 'wakandaa', 'uploads/file_5fcd00ec8b350assignment.html', 0, '2020-12-06 16:03:56', '42bbeb61eb3d2636acaeaa8a6b4ca5a9'),
(26, 'nguyentranquynhnhu25051999@gmail.com', '1231', '123123123', 'uploads/file_5fcd04086591bassignment.html', 0, '2020-12-06 16:17:12', '623f458a975fbad5770e78226fcdb503'),
(28, 'hungt2766@gmail.com', '65', '656', 'uploads/file_5fd392df8a83fdatabase.sql', 1, '2020-12-11 15:40:15', 'f848986d7019612d917d77b96e5ea0b8'),
(29, 'hungt2766@gmail.com', '99', '999', 'uploads/file_5fd3930040d0cdatabase.sql', 2, '2020-12-11 15:40:48', 'f848986d7019612d917d77b96e5ea0b8'),
(30, 'hungt2766@gmail.com', 'hfdhdfghdfsh', 'gdsgshshdfh', 'uploads/file_5fd43fa786a85Lab08.pdf', 0, '2020-12-12 03:57:27', 'f848986d7019612d917d77b96e5ea0b8');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reset_token`
--

CREATE TABLE `reset_token` (
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `expire_on` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `reset_token`
--

INSERT INTO `reset_token` (`email`, `token`, `expire_on`) VALUES
('blightmedison313@gmail.com', '27003566b8e32588b9db5bc8026ef320', 1606623243);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

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
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`username`, `password`, `hoten`, `ngaysinh`, `email`, `sdt`, `token`, `permission`) VALUES
('hoanghung', '$2y$10$rF5xkMMitjYm4TgaVetxPO0LtFXhk2XNfVaTqUj5dhOosFkaL/hSS', 'Nguyễn Hoàng Hưng', '25/05/1999', 'blightmedison313@gmail.com', '0968030739', '8be9ccd0c29230bf228df8bdeed4d3d0', 1),
('dangdang', '$2y$10$/zwc5g9wH3reSMPgG3fUkeAPxbDKNI8Lz.PGdXc0TdB9b2yOvjXh2', 'Phạm Hồng Hải Đăng', '25/05/1999', 'dang1212asd@gmail.com', '0968030739', '00849a563cb4f25ea49f16243962ef0a', 2),
('minhhung', '$2y$10$xGN0gqSK5.3C34cxsN5YduRoS/P27/fkDAj8JO5nfmabDCeK0fYuy', 'Trương Minh Hưng', '25/05/1999', 'hungt2766@gmail.com', '0968030739', '058639030e4b651984247865b376fc1f', 1),
('nhunhu', '$2y$10$UutMppkzzN5gIERvvlwTKuKaAmnoLpclA8aZEgfgK9ZNikodXRxw.', 'Nguyễn Trần Quỳnh Như', '25/05/1999', 'nguyentranquynhnhu2505@gmail.com', '0968030739', '5835de49859f6b282e0719b2728416a9', 1),
('Admin', '$2y$10$S1nSU5SDYD4en8IaJ5NAxu5ImiJzd48HLfjO9Bs.muhwz7Iu7Y/im', 'Admin', '25/05/1999', 'nguyentranquynhnhu25051999@gmail.com', '0968030739', 'f636a6d959d8646220b4681a4cac4bdb', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_classroom`
--

CREATE TABLE `user_classroom` (
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user_classroom`
--

INSERT INTO `user_classroom` (`email`, `token`, `status`) VALUES
('blightmedison313@gmail.com', '3add6d053424a587d130071fcfef6659', ''),
('blightmedison313@gmail.com', '6ccb86d2a350880e09475a3fa94573ae', 'active'),
('hungt2766@gmail.com', '02d50d76e68311ef23c29f2c4dfdc869', ''),
('hungt2766@gmail.com', '06822b344e8b550bbb939af2b7997511', ''),
('hungt2766@gmail.com', '1f6687c1fe42afd5e87597c65b76d2ae', ''),
('hungt2766@gmail.com', '23fbbaad4a5eca3b54212efd908a92b5', ''),
('hungt2766@gmail.com', '69252677de5722e669d4b497498f410f', ''),
('hungt2766@gmail.com', '716892fb107997306b128512ef0c57ee', ''),
('hungt2766@gmail.com', '72902e77f3759e62adb42e74cf32ce0e', ''),
('hungt2766@gmail.com', '7c7d982a7b7bc3b962e46491c738c241', ''),
('hungt2766@gmail.com', '88033fe292f73de17c9d44403d00b389', ''),
('hungt2766@gmail.com', 'ad1fa70f4b8464eb038ab73d2c0486a7', ''),
('hungt2766@gmail.com', 'b66b070100ec31a12122624984ac2373', ''),
('hungt2766@gmail.com', 'b9c3a9d8ef5db7d17f871a40c3a6a5ac', ''),
('hungt2766@gmail.com', 'bb6174a1d4657cda5964fbec59836cfe', ''),
('hungt2766@gmail.com', 'd2ee649b754117cc6427d843802fb1e0', ''),
('hungt2766@gmail.com', 'f65c5520658a1decfb0bf1fa4791a56c', ''),
('hungt2766@gmail.com', 'f848986d7019612d917d77b96e5ea0b8', ''),
('nguyentranquynhnhu25051999@gmail.com', '6ccb86d2a350880e09475a3fa94573ae', '');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `reset_token`
--
ALTER TABLE `reset_token`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `user_classroom`
--
ALTER TABLE `user_classroom`
  ADD PRIMARY KEY (`email`,`token`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
