-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 01, 2023 at 10:45 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_SapangMIS`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_accessControl`
--

CREATE TABLE `tbl_accessControl` (
  `userName` varchar(100) NOT NULL,
  `residents` tinyint(1) NOT NULL,
  `employees` tinyint(1) NOT NULL,
  `services` tinyint(1) NOT NULL,
  `inventory` tinyint(1) NOT NULL,
  `events` tinyint(1) NOT NULL,
  `announcements` tinyint(1) NOT NULL,
  `incidents` tinyint(1) NOT NULL,
  `attendance` tinyint(1) NOT NULL,
  `reports` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_accessControl`
--

INSERT INTO `tbl_accessControl` (`userName`, `residents`, `employees`, `services`, `inventory`, `events`, `announcements`, `incidents`, `attendance`, `reports`) VALUES
('@JeremiahPunzalanCancino', 1, 1, 0, 0, 0, 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_accessControl`
--
ALTER TABLE `tbl_accessControl`
  ADD PRIMARY KEY (`userName`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
