-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2025 at 09:15 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

CREATE DATABASE IF NOT EXISTS `phoebedb`;
USE `phoebedb`;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Cấu hình bộ ký tự
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
 /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
 /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 /*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------
-- Table structure for table `thanh_vien`
-- --------------------------------------------------------

CREATE TABLE `thanh_vien` (
  `id` varchar(6) NOT NULL,
  `hoten` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `role` tinyint(4) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Dumping data for table `thanh_vien`
-- --------------------------------------------------------

INSERT INTO `thanh_vien` (`id`, `hoten`, `password`, `email`, `role`) VALUES
('000000', 'Tester', '000000', 'abc@gmail.com', 2),
('000001', 'TuuDu', '160505', 'chidung12479@gmail.com', 1);

-- --------------------------------------------------------
-- Indexes for table `thanh_vien`
-- --------------------------------------------------------

ALTER TABLE `thanh_vien`
  ADD PRIMARY KEY (`id`);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
 /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
 /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
