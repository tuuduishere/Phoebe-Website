-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2026 at 10:47 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clb_manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `ma_dinh_danh` char(6) NOT NULL,
  `ho_ten` varchar(100) NOT NULL,
  `gioi_tinh` enum('Nam','Nữ') NOT NULL,
  `ngay_sinh` date NOT NULL,
  `nam_sinh` year(4) NOT NULL,
  `ban` enum('Ban điều hành','Ban thi đấu','Ban truyền thông','Ban thiết kế','Cựu học sinh') NOT NULL,
  `gmail` varchar(100) DEFAULT NULL,
  `link_fb` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`ma_dinh_danh`, `ho_ten`, `gioi_tinh`, `ngay_sinh`, `nam_sinh`, `ban`, `gmail`, `link_fb`) VALUES
('050401', 'Võ Lê Chí Dũng', 'Nam', '2005-05-16', '2005', 'Cựu học sinh', 'volechidung@gmail.com', 'fb.com/chi.dung.1605'),
('060401', 'Nguyễn Cao Xuân Trung', 'Nam', '2006-04-27', '2006', 'Cựu học sinh', 'godhander274@gmail.com', 'https://www.facebook.com/xuantrung274/'),
('060402', 'Trần Thiên Phú', 'Nam', '2006-03-28', '2006', 'Cựu học sinh', 'Tranthienphu2803@gmail.com', 'https://www.facebook.com/Oken.283/'),
('060403', 'Phạm Phúc Thịnh', 'Nam', '2006-01-01', '2006', 'Cựu học sinh', 'thinhphamapt@gmail.com', 'https://www.facebook.com/thinhDI01'),
('060404', 'Nguyễn Minh Phúc', 'Nam', '2006-07-14', '2006', 'Cựu học sinh', 'manhduonglhp3@gmail.com', 'https://www.facebook.com/share/1AWRuZpr3j/?mibextid=wwXIfr'),
('060405', 'Doãn Bá Nhật', 'Nam', '2006-02-03', '2006', 'Cựu học sinh', 'doanbanhat0302@gmail.com', 'https://www.facebook.com/share/17Tey1LqYP/?mibextid=wwXIfr'),
('070401', 'Trương Thái Khang Duy', 'Nam', '2007-03-06', '2007', 'Cựu học sinh', 'khangduytruong1@gmail.com', 'https://www.facebook.com/share/1AoAzC5dHx/'),
('070402', 'Trương Thái Kha Duy', 'Nam', '2007-03-06', '2007', 'Cựu học sinh', 'khaduytruong207@gmail.com', 'https://www.facebook.com/share/17WdWLYcbM/'),
('070403', 'Nguyễn Bảo Long', 'Nam', '2007-11-17', '2007', 'Cựu học sinh', 'noir171127@gmail.com', 'https://www.facebook.com/longnguyen171127'),
('080101', 'Doãn Bá Trí', 'Nam', '2008-07-15', '2008', 'Ban thi đấu', 'doanbatri.it@gmail.com', 'https://www.facebook.com/tridev157'),
('080102', 'Nguyễn Thị Kim Ngân', 'Nữ', '2008-08-19', '2008', 'Ban thi đấu', 'ngkngan1908@gmail.com', 'https://www.facebook.com/share/176D1ypFY4/'),
('080103', 'Phạm Hải Đăng', 'Nam', '2008-12-16', '2008', 'Ban thi đấu', 'dangpham.161208@gmail.com', 'https://www.facebook.com/ankdenbien12/'),
('080104', 'Võ Minh Khánh', 'Nam', '2008-06-01', '2008', 'Ban thi đấu', 'minhkhanh070640@gmail.com', 'https://www.facebook.com/share/17uZEkT6HQ/'),
('080105', 'Phan Nguyễn Như Ngọc', 'Nữ', '2008-09-30', '2008', 'Ban thi đấu', 'nhungoc300908@gmail.com', 'https://www.facebook.com/share/17iZpbDmYw/'),
('080201', 'Phan Thị Thảo My', 'Nữ', '2008-08-07', '2008', 'Ban truyền thông', 'myphan7878@gmail.com', 'https://www.facebook.com/share/1brVGntGwf/'),
('080301', 'Nguyễn Ngọc Thảo Như', 'Nữ', '2008-10-09', '2008', 'Ban thiết kế', 'nguyenngocthaonhu910@gmail.com', 'https://www.facebook.com/ba.nhat.meta.682524'),
('090001', 'Nguyễn Ngọc Lữ Duyên', 'Nữ', '2009-11-11', '2009', 'Ban điều hành', 'luduyen841@gmail.com', 'https://www.facebook.com/share/1DfmP5XEb3/'),
('090002', 'Lê Quốc Vinh', 'Nam', '2009-04-14', '2009', 'Ban điều hành', 'lequocvinh14042009@gmail.com', 'https://www.facebook.com/le.quoc.vinh.493584/about'),
('090101', 'Đoàn Ngọc An Thi', 'Nam', '2009-01-02', '2009', 'Ban thi đấu', 'hoanggaylord@gmail.com', 'fb.com/notadumpsimp'),
('090102', 'Nguyễn Thị Hà Phương', 'Nữ', '2009-01-21', '2009', 'Ban thi đấu', 'nguyenthiphuong123456@gmail.com', 'https://www.facebook.com/phuong.nguyenthiha.948'),
('090103', 'Hoàng Trương Ngọc Tuấn', 'Nam', '2009-02-05', '2009', 'Ban thi đấu', 'tuantk2009@gmail.com', 'https://www.facebook.com/tuan.hoangtruongngoc.3'),
('090104', 'Trịnh Anh Khoa', 'Nam', '2009-11-08', '2009', 'Ban thi đấu', 'trinhanhkhoa08112009@gmail.com', 'https://www.facebook.com/share/19wpdyCHR/'),
('100101', 'Bùi Anh Khoa', 'Nam', '2010-01-05', '2010', 'Ban thi đấu', 'buianhkhoa051110@gmail.com', 'https://www.facebook.com/share/1EfrcgDAk/'),
('100102', 'Doãn Bá Minh Khôi', 'Nam', '2010-05-12', '2010', 'Ban thi đấu', 'khoihere118@gmail.com', 'Minh Khôi'),
('100201', 'Lê Trọng Khang', 'Nam', '2010-04-16', '2010', 'Ban truyền thông', 'antk232323@gmail.com', 'https://www.facebook.com/share/1C5ijmdpD/'),
('100202', 'Nguyễn Trung Chinh', 'Nam', '2010-11-28', '2010', 'Ban truyền thông', 'chinhne.28112010@gmail.com', 'https://www.facebook.com/share/1McCJYjYn/'),
('100203', 'Nguyễn Anh Kiệt', 'Nam', '2010-06-01', '2010', 'Ban truyền thông', 'nguyenakiet16210@gmail.com', 'https://www.facebook.com/share/1ADP5kC2dM/'),
('100204', 'Nguyễn Ngọc Thiên Ngân', 'Nữ', '2010-02-08', '2010', 'Ban truyền thông', 'nguyenngocthienngan.vn@gmail.com', 'https://www.facebook.com/share/1CqWDFsbm2/');

--
-- Triggers `members`
--
DELIMITER $$
CREATE TRIGGER `trg_generate_ma_dinh_danh` BEFORE INSERT ON `members` FOR EACH ROW BEGIN
    DECLARE yy CHAR(2);
    DECLARE bb CHAR(2);
    DECLARE nn INT;

    SET yy = RIGHT(NEW.nam_sinh, 2);

    SET bb = CASE NEW.ban
        WHEN 'Ban điều hành' THEN '00'
        WHEN 'Ban thi đấu' THEN '01'
        WHEN 'Ban truyền thông' THEN '02'
        WHEN 'Ban thiết kế' THEN '03'
        WHEN 'Cựu học sinh' THEN '04'
    END;

    SELECT IFNULL(MAX(CAST(RIGHT(ma_dinh_danh,2) AS UNSIGNED)),0) + 1
    INTO nn
    FROM members
    WHERE LEFT(ma_dinh_danh,4) = CONCAT(yy, bb);

    SET NEW.ma_dinh_danh = CONCAT(yy, bb, LPAD(nn,2,'0'));
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`ma_dinh_danh`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
