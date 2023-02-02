-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 15, 2022 lúc 01:38 PM
-- Phiên bản máy phục vụ: 10.4.25-MariaDB
-- Phiên bản PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `webservice`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `food` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255),
 `img` varchar(255),
 `price` int(20),
 `description` varchar(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `food` VALUES
(1, 'Gà quay', '1.jpg', 50000, ''),
(2, 'Gà nướng', '2.jpg', 60000, 'Gà nướng ngon'),
(3, 'Sườn xào chua ngọt', '3.jpg', 50000, ''),
(4, 'Bún đậu mắm tôm', '4.jpg', 40000, '');

CREATE TABLE `donhang` (
  `donhang_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `price` int(11)
);


