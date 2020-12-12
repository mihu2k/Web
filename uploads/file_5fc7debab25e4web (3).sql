-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 02, 2020 lúc 07:20 PM
-- Phiên bản máy phục vụ: 10.1.38-MariaDB
-- Phiên bản PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
  `classname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `room` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `img` text COLLATE utf8_unicode_ci NOT NULL,
  `date_create` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `token` varchar(300) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `classroom`
--

INSERT INTO `classroom` (`id`, `classname`, `subject`, `room`, `email`, `img`, `date_create`, `token`) VALUES
(1, 'Lap trinh web t4c3', 'Lap trinh web', 'C401', 'hhung@gmail.com', '/img.png', '27-11-2020', '84afc38080c24e9c6fa22f799470586d'),
(2, 'Cong nghe phan mem t2c2', 'CNPM', 'C601', 'blightmedison313@gmail.com', 'images/img_violin2.jpg', '27-11-2020', '9901211752466b008b809382d37ba719'),
(3, 'Công nghệ phần mềm n2tt2', 'Công nghệ phần mềm', 'C202', 'blightmedison313@gmail.com', 'images/img_learnlanguage.jpg', '28-11-2020', '623f458a975fbad5770e78226fcdb503');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comment`
--

CREATE TABLE `comment` (
  `id` int(10) NOT NULL,
  `post_id` int(10) NOT NULL,
  `content` text NOT NULL,
  `email` varchar(30) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
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
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `token` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `news`
--

INSERT INTO `news` (`id`, `user_email`, `title`, `content`, `file`, `type`, `date_created`, `token`) VALUES
(10, 'hoangvanle@gmail.com', 'gdf', 'gdfgfdgfdd', 'uploads/file_5fc7051c46e46', 2, '2020-12-02 17:59:19', '9901211752466b008b809382d37ba719'),
(11, 'hoangvanle@gmail.com', 'rfgd', 'fgfdgd', 'uploads/file_5fc705a39e9b0', 2, '2020-12-02 17:59:22', '9901211752466b008b809382d37ba719'),
(17, 'hoangvanle@gmail.com', 'fgdgdf', 'dfgfdg', 'uploads/file_5fc707aa31c08file_5fc7051c46e46.png', 0, '2020-12-02 17:59:24', '9901211752466b008b809382d37ba719'),
(18, 'hoangvanle@gmail.com', 'asdfasdf', 'asdfsadf', 'uploads/file_5fc7903fb8d88main.js (1).txt', 0, '2020-12-02 17:59:25', '9901211752466b008b809382d37ba719');

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
('admin1', '$2y$10$lH2DA4pNECid/1zvQFyTq.zu4ASNvGvehnjDvUMIngB.u0UsFmhn2', 'Admin', '01/01/2000', 'admin@gmail.com', '0909090908', 'd05629be150ee366b795477f5f4bf54a', 0),
('hhung2', '$2y$10$m6RDI/8oc2B6HXukvWyNFu4GhFAPKnFCCSnK0boYD4yh3aAtZO9Iu', 'Hung Nguyen', '27/05/2000', 'blightmedison313@gmail.com', '0908020105', 'd8f97b25b2db70bf9af13131b78509bc', 1),
('hoang', '$2y$10$Yt0Lijg3Xm9Z34m/zm3tK.CRf.rn.eGVOwlotx8lu6Yjg8yOYzTmS', 'LE VAN HOANG', '01/02/1999', 'hoangvanle@gmail.com', '0329474118', '0c6b2b58b5e9d5ba161ccab89d098290', 0),
('abcdef', '$2y$10$dEDV7MVdw6nXlKw9Zr/uTOdMYaof7vA3E2ZfrV1uEqtkvHu1cznCC', 'Nguyen', '01/01/2000', 'nhh3103@gmail.co', '0908050604', '639a6f68e9917c536ce4f1bf185309d0', 2),
('hhung', '$2y$10$Fx3KnAxw7Oad4UY73d0zOuqTlUh347FAheY546CEwQkCVygCGSbM2', 'Hung Nguyen', '01/02/1999', 'nhh3103@gmail.com', '0908030205', '3381c4d253165929fcbff2327b4ae368', 2),
('Kuren', '$2y$10$x0EiEE0SqnHcWhSv9zCRJOCX1qDvjPQ.bBbFya.SK0/dqfw6DdKaK', 'Hung Nguyen', '01/01/2000', 'nhh313@gmail.com', '0908050601', '497b5c663b217aa784fa7d7734a1479c', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_classroom`
--

CREATE TABLE `user_classroom` (
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `status` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user_classroom`
--

INSERT INTO `user_classroom` (`email`, `token`, `status`) VALUES
('blightmedison313@gmail.com', '9901211752466b008b809382d37ba719', 'active'),
('dsfsd@gmail.com', '84afc38080c24e9c6fa22f799470586d', 'confirm'),
('fgf@gmail.com', '84afc38080c24e9c6fa22f799470586d', 'confirm'),
('hhung@gmail.com', '84afc38080c24e9c6fa22f799470586d', 'active'),
('hhung@gmail.com', '9901211752466b008b809382d37ba719', 'active'),
('hoangvanle@gmail.com', '84afc38080c24e9c6fa22f799470586d', 'confirm'),
('levanhoang310799@gmail.com', '84afc38080c24e9c6fa22f799470586d', 'active'),
('sadf@gmail.com', '84afc38080c24e9c6fa22f799470586d', 'confirm');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `classroom`
--
ALTER TABLE `classroom`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`type`);

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
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
